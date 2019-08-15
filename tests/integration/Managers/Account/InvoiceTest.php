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

namespace PHPExperts\ZuoraClient\Tests\Integration\Managers\Account;

use PHPExperts\ZuoraClient\DTOs\Read;
use PHPExperts\ZuoraClient\Tests\Integration\Managers\AccountTest;
use PHPExperts\ZuoraClient\Tests\Integration\Managers\SubscriptionTest;
use PHPExperts\ZuoraClient\Tests\TestCase;
use PHPExperts\ZuoraClient\ZuoraClient;

class InvoiceTest extends TestCase
{
    public function testCanViewInvoices()
    {
        // Build a test account.
        $accountCreatedDTO = AccountTest::addAccount();
        $zuoraId = $accountCreatedDTO->accountId;

        if ($this->isDebugOn()) {
            echo "--> Zuora ID: $zuoraId <--\n";
        }

        // Attach a subscription to it to create an invoice.
        SubscriptionTest::addSubscription($zuoraId);

        /** @var ZuoraClient $zuora */
        $invoices = $this->api->account->id($zuoraId)
            ->invoice->fetch();

        self::assertInstanceOf(Read\InvoicesDTO::class, $invoices);
        self::assertIsArray($invoices->invoices);
        self::assertNotEmpty($invoices->invoices);
        self::assertInstanceOf(Read\InvoiceDTO::class, $invoices->invoices[0]);
        self::assertEquals($zuoraId, $invoices->invoices[0]->accountId);
        self::assertEquals('Test User', $invoices->invoices[0]->accountName);
    }
}
