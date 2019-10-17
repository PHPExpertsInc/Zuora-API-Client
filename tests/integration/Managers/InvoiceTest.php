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

use PHPExperts\ZuoraClient\DTOs\Response;
use PHPExperts\ZuoraClient\Tests\TestCase;

final class InvoiceTest extends TestCase
{
    /** @var Response\AccountCreatedDTO */
    private static $accountDTO;

    /** @var Response\InvoiceDTO */
    private static $invoiceDTO;

    public function setUp(): void
    {
        parent::setUp();

        $accountCreatedDTO = AccountTest::addAccount();
        self::$accountDTO = $accountCreatedDTO;

        $subscriptionCreatedDTO = SubscriptionTest::addSubscription($accountCreatedDTO->accountId);
        $invoiceId = $subscriptionCreatedDTO->invoiceId;

        self::$invoiceDTO = $this->api->invoice->id($invoiceId)->fetch();
    }

    public function testCanFetchASummaryOfTheInvoices()
    {
        $zuoraId = self::$accountDTO->accountId;
        $response = $this->api->account->id($zuoraId)->invoice->fetchSummary();

        self::assertIsArray($response);
        self::assertNotEmpty($response);
        self::assertInstanceOf(Response\ZAC\InvoiceSummaryDTO::class, $response[0]);
    }

    public function testCanFetchInvoiceDetails()
    {
        $response = self::$invoiceDTO;

        self::assertInstanceOf(Response\InvoiceDTO::class, $response);
        self::assertTrue($response->IncludesRecurring);
        self::assertEquals('Posted', $response->Status);
        self::assertNotEmpty($response->Body, 'A PDF was not attached to the invoice.');
        self::assertIsFloat($response->Amount);
        self::assertIsFloat($response->Balance);
    }
}
