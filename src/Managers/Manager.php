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
use PHPExperts\RESTSpeaker\RESTSpeaker;
use PHPExperts\ZuoraClient\ZuoraClient;
use RuntimeException;

abstract class Manager
{
    /** @var RESTSpeaker */
    protected $api;

    /** @var ZuoraClient */
    protected $zuora;

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
        $accounts = $info->records;

        usort($accounts, function ($a, $b) {
            return Carbon::createFromDate($b->CreatedDate) > Carbon::createFromDate($a->CreatedDate);
        });

        return $accounts;
    }

    /**
     * @param $response
     * @return Response|\stdClass
     * @throws \RuntimeException
     */
    protected function processResponse($response)
    {
        if ($this->api->getLastStatusCode() !== 200) {
            $this->handleBadRequest($response, 'Updating the Account');
        }

        return $response;
    }

    /**
     * @param $response
     * @param string $action
     * @throws RuntimeException
     */
    protected function handleBadRequest($response, string $action)
    {
        if (!$response instanceof \stdClass || !property_exists($response, 'success')) {
            throw new RuntimeException("$action was unsuccessful: Malformed API response:" . json_encode($response));
        } elseif ($response->success !== true) {
            $gatherFailureReasons = function ($response): string {
                $messages = [];
                foreach ($response->reasons as $reason) {
                    $messages[] = $reason->message;
                }

                return implode("\n", $messages);
            };

            throw new RuntimeException(
                "$action was unsuccessful: " . $gatherFailureReasons($response)
            );
        }
    }
}
