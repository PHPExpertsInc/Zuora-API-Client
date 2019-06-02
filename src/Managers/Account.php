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
use PHPExperts\ZuoraClient\DTOs\Write;
use PHPExperts\ZuoraClient\DTOs\Read;
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

    public function fetch(): Read\AccountDTO
    {
        $this->assertHasId();
        $response = $this->api->get('v1/accounts/' . $this->id);
        $this->processResponse($response);

        return new Read\AccountDTO((array) $response);
    }

    public function update(Write\AccountDTO $accountDTO)
    {
        $this->assertHasId();
        $response = $this->api->put('v1/accounts/' . $this->id, [
            'json' => $accountDTO->toArray(),
        ]);

        return $this->processResponse($response);
    }

    public function destroy(): bool
    {
        $this->assertHasId();
        $response = $this->api->delete('v1/object/account/' . $this->id);

        if ($this->api->getLastStatusCode() === 404) {
            return true;
        } elseif ($this->api->getLastStatusCode() === 400 && $response->errors[0]->Code === 'INVALID_ID') {
            return true;
        }

        $response = $this->processResponse($response);

        return $response->success === true;
    }
}
