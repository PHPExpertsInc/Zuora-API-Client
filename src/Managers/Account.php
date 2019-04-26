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

    public function update(string $zuoraGUID, array $fields)
    {
        $response = $this->api->put('v1/accounts/' . $zuoraGUID, [
            'json' => $fields,
        ]);

        if (!$response instanceof \stdClass || !property_exists($response, 'success')) {
            throw new \RuntimeException('Updating the Account was unsuccessful: Malformed API response.');
        } elseif ($response->success !== true) {
            $gatherFailureReasons = function ($response): string {
                $messages = [];
                foreach ($response->reasons as $reason) {
                    $messages[] = $reason->message;
                }

                return implode("\n", $messages);
            };

            throw new \RuntimeException(
                'Updating the Account was unsuccessful: ' . $gatherFailureReasons($response)
            );
        }

        return $response;
    }

    public function destroy(string $zuoraGUID)
    {
        $response = $this->api->delete('v1/accounts/' . $zuoraGUID);
    }
}
