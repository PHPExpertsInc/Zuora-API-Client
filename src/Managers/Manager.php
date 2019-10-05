<?php declare(strict_types=1);

/**
 * This file is part of the Zuora PHP API Client, a PHP Experts, Inc., Project.
 *
 * Copyright © 2019 PHP Experts, Inc.
 * Author: Theodore R. Smith <theodore@phpexperts.pro>
 *  GPG Fingerprint: 4BF8 2613 1C34 87AC D28F  2AD8 EB24 A91D D612 5690
 *  https://www.phpexperts.pro/
 *  https://github.com/phpexpertsinc/Zuora-API-Client
 *
 * This file is licensed under the MIT License.
 */

namespace PHPExperts\ZuoraClient\Managers;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use LogicException;
use PHPExperts\RESTSpeaker\RESTSpeaker;
use PHPExperts\ZuoraClient\Exceptions\ResourceNotFoundException;
use PHPExperts\ZuoraClient\Exceptions\ZuoraAPIException;
use PHPExperts\ZuoraClient\ZuoraClient;
use ReflectionClass;

abstract class Manager
{
    /** @var RESTSpeaker */
    protected $api;

    /** @var ZuoraClient */
    protected $zuora;

    /** @var string */
    protected $id;

    public function __construct(ZuoraClient $zuora, RESTSpeaker $api)
    {
        $this->zuora = $zuora;
        $this->api = $api;
    }

    public function query(string $zosql)
    {
        $info = $this->api->post('v1/action/query', [
            'json' => [
                'queryString' => $zosql,
            ],
        ]);

        $this->processResponse($info);
        $records = $info->records ?? null;

        if (is_array($records) && !empty($records) && property_exists($records[0], 'CreatedDate')) {
            usort($records, function ($a, $b) {
                return Carbon::createFromDate($b->CreatedDate) > Carbon::createFromDate($a->CreatedDate);
            });
        }

        return $records;
    }

    /**
     * @param $response
     * @param string $action
     * @return Response|\stdClass
     * @throws ZuoraAPIException
     *xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
     *xxxxxxx AAA AAA AAA AAA xxxxxxxx
     *xxxxxx AAA x A x A x AAA xxxxxxx
     *xxxxx A x AAA x x AAA x A xxxxxx
     *xxxx AAA AAA x x x AAA AAA xxxxx
     *xxx A x A x AAA AAA x A x A xxxx
     *xx AAA AAA AAA x AAA AAA AAA xxx
     *x A x A x A x AAA x A x A x A xx
     * AAA AAA AAA AAAAA AAA AAA AAA x
     * vvv vvv vvv vvvvv vvv vvv vvv x
     *x v x v x v x vvv x v x v x v xx
     *xx vvv x x vvv x vvv x x vvv xxx
     *xxx v x x x vvv vvv x x x v xxxx
     *xxxx vvv vvv x x x vvv vvv xxxxx
     *xxxxx v x vvv x x vvv x v xxxxxx
     *xxxxxx vvv x v x v x vvv xxxxxxx
     *xxxxxxx vvv vvv vvv vvv xxxxxxxx
     *xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
     *
     * @todo: Fix $action so that it doesn't need a default value. Make $item mandatory, too.
     */
    protected function processResponse($response, string $action = null, string $item = null, $itemId = null)
    {
        if ($this->api->getLastStatusCode() !== 200 || ($response->success ?? null) === false) {
            $this->handleBadRequest($response, [
                'action' => $action ?? 'Updating the Account',
                'item'   => $item ?? 'Unknown',
                'itemId' => $itemId ?? $this->id,
            ]);
        }

        return $response;
    }

    /**
     * @param $response
     * @param array $actionInfo
     * @throws ZuoraAPIException
     */
    protected function handleBadRequest($response, array $actionInfo)
    {
        ['action' => $action, 'item' => $item, 'itemId' => $itemId] = $actionInfo;
        if (!$response instanceof \stdClass || !property_exists($response, 'success')) {
            throw new ZuoraAPIException("$action was unsuccessful: Malformed API response:" . json_encode($response));
        } elseif ($response->success !== true) {
            $gatherFailureReasons = function ($response): string {
                $messages = [];
                foreach ($response->reasons as $reason) {
                    $messages[] = $reason->message;
                }

                return implode("\n", $messages);
            };

            $reason = $gatherFailureReasons($response);
            if (substr($reason, 0, 26) === 'Cannot find entity by key:') {
                throw new ResourceNotFoundException("$item with ID '$itemId'");
            }

            throw new ZuoraAPIException("$action was unsuccessful: " . $reason);
        }
    }

    /**
     * @param string $zuoraGUID
     * @return static
     */
    public function id(string $zuoraGUID): self
    {
        $this->id = $zuoraGUID;

        return $this;
    }

    protected function assertHasId()
    {
        if ($this->id === null) {
            throw new LogicException('An ID must be set for ' . static::class . '.');
        }
    }

    public function destroy(string $uri): bool
    {
        $this->assertHasId();
        $response = $this->api->delete($uri . $this->id);
        if ($this->api->getLastStatusCode() === 400 && $response->errors[0]->Code === 'INVALID_ID') {
            return true;
        }

        $response = $this->processResponse($response, 'Deleting the ' . (new ReflectionClass($this))->getShortName());

        return $response->success === true;
    }
}
