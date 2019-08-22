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
use PHPExperts\ZuoraClient\DTOs\Response;
use PHPExperts\ZuoraClient\Managers\Account\Invoice;
use PHPExperts\ZuoraClient\Managers\Account\Payment as AccountPayment;
use PHPExperts\ZuoraClient\Managers\Account\Subscription as AccountSubscription;
use PHPExperts\ZuoraClient\ZuoraClient;

class Account extends Manager
{
    /** @var AccountPayment */
    public $payment;

    /** @var AccountSubscription */
    public $subscription;

    /** @var Invoice */
    public $invoice;

    public function __construct(ZuoraClient $zuora, RESTSpeaker $apiClient)
    {
        $this->payment = new AccountPayment($zuora, $apiClient);
        $this->subscription = new AccountSubscription($zuora, $apiClient);
        $this->invoice = new Invoice($zuora, $apiClient);

        parent::__construct($zuora, $apiClient);
    }

    /**
     * @param string $zuoraGUID
     * @return static
     */
    public function id(string $zuoraGUID): Manager
    {
        parent::id($zuoraGUID);

        $this->invoice->id($zuoraGUID);

        return $this;
    }

    public function fetch(): Read\AccountDTO
    {
        $this->assertHasId();
        $response = $this->api->get('v1/accounts/' . $this->id);
        $this->processResponse($response, 'Fetching an account', 'Account');

        return new Read\AccountDTO((array) $response);
    }

    public function store(Write\AccountDTO $accountDTO): Response\AccountCreatedDTO
    {
        $response = $this->api->post('v1/accounts', [
            'json' => $accountDTO,
        ]);

        $response = $this->processResponse($response);
        $response = new Response\AccountCreatedDTO((array) $response);

        $this->id = $response->accountId;

        return $response;
    }

    public function update(Write\AccountDTO $accountDTO)
    {
        $this->assertHasId();
        $response = $this->api->put('v1/accounts/' . $this->id, [
            'json' => $accountDTO,
        ]);

        return $this->processResponse($response);
    }

    public function destroy(string $uri = ''): bool
    {
        return parent::destroy('v1/object/account/');
    }

    // @todo move all the other methods to an API Driver class via composition.
    public function findByName(string $name)
    {
        return $this->query("select Id, Name, CreatedDate from Account where Name='$name'");
    }
}
