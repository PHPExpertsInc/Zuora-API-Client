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
use PHPExperts\ZuoraClient\DTOs\Request\AccountDTO;
use PHPExperts\ZuoraClient\DTOs\Response\AccountDTO as AccountResponseDTO;
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

    public function fetch(string $zuoraGUID): AccountResponseDTO
    {
        $response = $this->api->get('v1/accounts/' . $zuoraGUID);
        $this->processResponse($response);

        return new AccountResponseDTO((array) $response);
    }

    public function update(string $zuoraGUID, AccountDTO $accountDTO)
    {
        $response = $this->api->put('v1/accounts/' . $zuoraGUID, [
            'json' => $accountDTO->toArray(),
        ]);

        return $this->processResponse($response);
    }

    /**
     * @param string $zuoraGUID
     * @return bool
     */
    public function destroy(string $zuoraGUID): bool
    {
        $response = $this->api->delete('v1/object/account/' . $zuoraGUID);

        if ($this->api->getLastStatusCode() === 404) {
            return true;
        }

        $response = $this->processResponse($response);

        return $response->success === true;
    }
}
