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

use PHPExperts\DataTypeValidator\InvalidDataTypeException;
use PHPExperts\ZuoraClient\DTOs\Response\AccountCreatedDTO;
use PHPExperts\ZuoraClient\DTOs\Write;
use PHPExperts\ZuoraClient\DTOs\Read;
use PHPExperts\ZuoraClient\DTOs\Response;
use PHPExperts\ZuoraClient\Exceptions\ZuoraAPIException;
use PHPExperts\ZuoraClient\Tests\TestCase;

class AccountTest extends TestCase
{
    /** @todo: Extract these test helpers into library helpers to aid end developers. */
    public static function addAccount(): AccountCreatedDTO
    {
        $billingContact = new Write\ContactDTO();
        $billingContact->firstName = 'Test';
        $billingContact->lastName  = 'User';
        $billingContact->city      = 'Houston';
        $billingContact->country   = 'US';

        $accountDTO = new Write\AccountDTO();
        $accountDTO->autoPay = false;
        $accountDTO->name = 'Test User';
        $accountDTO->billToContact = $billingContact;
        $accountDTO->soldToContact = $billingContact;
        $accountDTO->currency      = 'USD';
        $accountDTO->billCycleDay  = 7;

        try {
            $zuora = self::buildZuoraClient();
            $response = $zuora->account->store($accountDTO);
        } catch (InvalidDataTypeException $e) {
            dd($e->getReasons());
        }

        return $response;
    }

    public function testCanCreateAnAccount(): AccountCreatedDTO
    {
        $response = self::addAccount();

        self::assertInstanceOf(AccountCreatedDTO::class, $response);
        self::assertTrue($response->success);
        self::assertIsString($response->accountId);

        return $response;
    }

    /** @depends testCanCreateAnAccount */
    public function testCanFetchAccountDetails(AccountCreatedDTO $createdDTO)
    {
        $response = $this->api->account->id($createdDTO->accountId)->fetch();

        self::assertInstanceOf(Read\AccountDTO::class, $response);
        self::assertTrue($response->success);
        self::assertSame($createdDTO->accountId, $response->basicInfo->id);
    }

    /** @depends testCanCreateAnAccount */
    public function testCanGetAccountDetails(AccountCreatedDTO $createdDTO)
    {
        try {
            $response = $this->api->account->id($createdDTO->accountId)->get();
        } catch (InvalidDataTypeException $e) {
            dd($e->getReasons());
        }
        self::assertInstanceOf(Response\AccountDTO::class, $response);
        self::assertSame($createdDTO->accountId, $response->Id);
    }

    /** @depends testCanCreateAnAccount */
    public function testCanUpdateAccountDetails(AccountCreatedDTO $createdDTO)
    {
        $nonce = date('Y-m-d') . '-' . uniqid();
        try {
            $response = $this->api->account->id($createdDTO->accountId)->update(new Write\AccountDTO([
                'salesRep' => $nonce,
            ]));
        } catch (ZuoraAPIException $e) {
            dd((string) $this->api->getApiClient()->getLastResponse()->getBody());
        }

        self::assertTrue($response->success);

        $account = $this->api->account->id($createdDTO->accountId)->fetch();
        self::assertEquals($nonce, $account->basicInfo->salesRep);
    }

    /** @depends testCanCreateAnAccount */
    public function testCanSearchAccounts(AccountCreatedDTO $createdDTO)
    {
//        $this->markTestIncomplete('Needs a Laurapay implementation.');
        $name = 'Test User';
        $accounts = $this->api->account->query("select Id, Name, CreatedDate from Account where Name='$name'");

        self::assertGreaterThan(0, count($accounts));
        self::assertEquals($createdDTO->accountId, $accounts[0]->Id);
        self::assertEquals($name, $accounts[0]->Name);
    }

    /** @depends testCanCreateAnAccount */
    public function testCanDeleteAccounts(AccountCreatedDTO $createdDTO)
    {
        $accountId = $createdDTO->accountId;
        $status = $this->api->account->id($accountId)->destroy();
        self::assertTrue($status, "Couldn't delete Zuora account $accountId.");
    }

    public function testDeleteTestAccounts()
    {
//        $this->markTestIncomplete('Needs query implementation for Laurapay.');
        $this->addAccount();

        $zuora = self::buildZuoraClient();
        $records = $zuora->account->query("select id from Account where Name='Test User'");

        foreach ($records as $record) {
            $accountId = $record->Id;
            $status = $zuora->account->id($accountId)->destroy();
            self::assertTrue($status, "Couldn't delete Zuora account $accountId.");
        }

        // Wait a second for Zuora to catch up.
        sleep(1);

        // Will ignore previously deleted accounts.
        $status = $zuora->account->id($accountId)->destroy();
        self::assertTrue($status);
    }
}
