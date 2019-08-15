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

use PHPExperts\SimpleDTO\SimpleDTO;
use PHPExperts\ZuoraClient\DTOs\Read;
use PHPExperts\ZuoraClient\DTOs\Response\AccountCreatedDTO;
use PHPExperts\ZuoraClient\DTOs\Write;
use PHPExperts\ZuoraClient\Exceptions\ResourceNotFoundException;
use PHPExperts\ZuoraClient\Tests\TestCase;

class ContactTest extends TestCase
{
    public function testCanCreateContact(): AccountCreatedDTO
    {
        $accountInfo = AccountTest::addAccount();

        $contactDTO = new Write\ContactDTO();
        $contactDTO->accountId = $accountInfo->accountId;
        $contactDTO->firstName = 'Third';
        $contactDTO->lastName  = 'Name';
        $contactDTO->country = 'US';

        $response = $this->api->contact->store($contactDTO);
        self::assertTrue($response->success);
        self::assertIsString($response->id);

        $accountInfo = new AccountCreatedDTO(
            $accountInfo->toArray() + [
                'thirdContactId' => $response->id,
            ],
            [SimpleDTO::PERMISSIVE],
        );

        return $accountInfo;
    }

    /** @depends testCanCreateContact */
    public function testCanFetchAContact(AccountCreatedDTO $accountInfo)
    {
        $fetchedDTO = $this->api->contact
            ->id($accountInfo->billToContactId)
            ->fetch();

        self::assertInstanceOf(Read\ContactDTO::class, $fetchedDTO);
        self::assertEquals($accountInfo->billToContactId, $fetchedDTO->id);
        self::assertEquals($accountInfo->accountId, $fetchedDTO->accountId);
    }

    /** @depends testCanCreateContact */
    public function testCanUpdateAContact(AccountCreatedDTO $accountInfo)
    {
        $contactDTO = new Write\ContactDTO();
        $contactDTO->state = 'TX';

        $response = $this->api->contact
            ->id($accountInfo->billToContactId)
            ->update($contactDTO);

        self::assertTrue($response->success);
        self::assertIsString($response->id);

        $fetchedDTO = $this->api->contact
            ->id($response->id)
            ->fetch();

        self::assertEquals('Texas', $fetchedDTO->state);
    }

    /** @depends testCanCreateContact */
    public function testCanDeleteAContact(AccountCreatedDTO $accountInfo)
    {
        $status = $this->api->contact->id($accountInfo->thirdContactId)
            ->destroy();
        self::assertTrue($status);

        // Make sure that it is, in fact, deleted.
        try {
            $this->api->contact->fetch();
            $this->fail('Fetched a supposedly deleted contact.');
        } catch (ResourceNotFoundException $e) {
            self::assertEmpty($e->getMessage());
        }
    }
}
