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
use PHPExperts\RESTSpeaker\RESTSpeaker;
use PHPExperts\ZuoraClient\ZuoraClient;

class Account extends Manager
{
    /** @var AccountSubscription */
    public $subscription;

    public function __construct(ZuoraClient $zuora, RESTSpeaker $apiClient)
    {
        $this->subscription = new AccountSubscription($zuora, $apiClient);

        parent::__construct($zuora, $apiClient);
    }

    public function fetch(string $zuoraGUID)
    {
        $response = $this->api->get('v1/accounts/' . $zuoraGUID);

        return $response;
    }

    protected function handleBadRequest($response, string $action)
    {
        if (!$response instanceof \stdClass || !property_exists($response, 'success')) {
            throw new \RuntimeException("$action was unsuccessful: Malformed API response.");
        } elseif ($response->success !== true) {
            $gatherFailureReasons = function ($response): string {
                $messages = [];
                foreach ($response->reasons as $reason) {
                    $messages[] = $reason->message;
                }

                return implode("\n", $messages);
            };

            throw new \RuntimeException(
                "$action was unsuccessful: " . $gatherFailureReasons($response)
            );
        }
    }

    public function update(string $zuoraGUID, array $fields)
    {
        $response = $this->api->put('v1/object/account/' . $zuoraGUID, [
            'json' => $fields,
        ]);

        if ($this->api->getLastStatusCode() !== 200) {
            $this->handleBadRequest($response, 'Updating the Account');
        }

        return $response;
    }

    public function destroy(string $zuoraGUID)
    {
        $response = $this->api->delete('v1/object/account/' . $zuoraGUID);

        if ($this->api->getLastStatusCode() !== 200) {
            $this->handleBadRequest($response, 'Updating the Account');
        }

        return $response;
    }

    public function query(string $zosql)
    {
        $info = $this->api->post('v1/action/query', [
            'json' => [
                'queryString' => $zosql,
            ],
        ]);

        $accounts = $info->records;

        usort($accounts, function ($a, $b) {
            return Carbon::createFromDate($b->CreatedDate) > Carbon::createFromDate($a->CreatedDate);
        });

        return $accounts;
    }
}
