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

use PHPExperts\ZuoraClient\DTOs\Read;
use PHPExperts\ZuoraClient\Tests\TestCase;

class PaymentGatewayTest extends TestCase
{
    public function testCanFetchPaymentGateways()
    {
        $response = $this->api->paymentGateway->all();

        self::assertInstanceOf(Read\PaymentGatewaysDTO::class, $response);
        self::assertTrue($response->success);

        self::assertIsArray($response->paymentgateways);
        self::assertNotEmpty($response->paymentgateways);

        self::assertInstanceOf(Read\PaymentGatewayDTO::class, $response->paymentgateways[0]);
        self::assertIsString($response->paymentgateways[0]->id);
    }
}
