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

class InvoiceTest extends TestCase
{
    public function testCanFetchInvoiceDetails()
    {
        $accountCreatedDTO = AccountTest::addAccount();

        $subscriptionCreatedDTO = SubscriptionTest::addSubscription($accountCreatedDTO->accountId);
        $invoiceId = $subscriptionCreatedDTO->invoiceId;

        $response = $this->api->invoice->id($invoiceId)->fetch();

        self::assertInstanceOf(Response\InvoiceDTO::class, $response);
        self::assertTrue($response->IncludesRecurring);
        self::assertEquals('Posted', $response->Status);
        self::assertNotEmpty($response->Body, 'A PDF was not attached to the invoice.');
        self::assertIsFloat($response->Amount);
        self::assertIsFloat($response->Balance);
    }
}
