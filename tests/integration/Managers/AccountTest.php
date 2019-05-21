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

namespace PHPExperts\ZuoraClient\Tests\Integration\Managers;

use Mockery\Exception\RuntimeException;
use PHPExperts\DataTypeValidator\InvalidDataTypeException;
use PHPExperts\SimpleDTO\SimpleDTO;
use PHPExperts\ZuoraClient\DTOs\Request\AccountDTO;
use PHPExperts\ZuoraClient\DTOs\Response\AccountDTO as AccountResponseDTO;
use PHPExperts\ZuoraClient\RESTAuthStrat as RESTAuth;
use PHPExperts\ZuoraClient\Tests\TestCase;
use PHPExperts\ZuoraClient\ZuoraClient;

class AccountTest extends TestCase
{
    public const ZUORA_ID = '2c92c0f952301900015235c55cc4255a';

    /** @var ZuoraClient */
    protected $api;

    public function setUp(): void
    {
        parent::setUp();

        $restAuth = new RESTAuth(RESTAuth::AUTH_MODE_PASSKEY);

        $this->api = new ZuoraClient($restAuth, env('ZUORA_API_HOST'));
        $restAuth->setApiClient($this->api->getApiClient());
    }

    public function testCanFetchAccountDetails()
    {
        $response = $this->api->account->fetch(self::ZUORA_ID);

        self::assertInstanceOf(AccountResponseDTO::class, $response);
        self::assertTrue($response->success);
        self::assertSame(self::ZUORA_ID, $response->basicInfo->id);
    }

    public function testCanUpdateAccountDetails()
    {
        $nonce = date('Y-m-d') . '-' . uniqid();
        try {
            $response = $this->api->account->update(self::ZUORA_ID, new AccountDTO([
                'salesRep' => $nonce,
            ], []));
        } catch (InvalidDataTypeException $e) {
            dd($e->getReasons());
        } catch (\RuntimeException $e) {
            dd((string) $this->api->getApiClient()->getLastResponse()->getBody());
        }

        self::assertTrue($response->success);

        $account = $this->api->account->fetch(self::ZUORA_ID);
        self::assertEquals($nonce, $account->basicInfo->salesRep);
    }

    public function testCanSearchAccounts()
    {
        $name = 'Wayne Foster';
        $accounts = $this->api->account->query("select Id, Name, CreatedDate from Account where Name='$name'");

        self::assertCount(1, $accounts);
        self::assertEquals(self::ZUORA_ID, $accounts[0]->Id);
        self::assertEquals($name, $accounts[0]->Name);
    }
}
