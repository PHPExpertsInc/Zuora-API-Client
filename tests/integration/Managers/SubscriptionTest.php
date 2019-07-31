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
use PHPExperts\ZuoraClient\DTOs\Response\SubscriptionCreatedDTO;
use PHPExperts\ZuoraClient\DTOs\Read;
use PHPExperts\ZuoraClient\Tests\TestCase;
use PHPExperts\ZuoraClient\Tests\unit\Mocks\MockDTOs;

class SubscriptionTest extends TestCase
{
    /** @todo: Extract these test helpers into library helpers to aid end developers. */
    public static function buildTestSubscription(string $zuoraId): SubscriptionCreatedDTO
    {
        // @FIXME: Before release, this method needs to create a subscription dynamically.
        $response = MockDTOs::createSubscriptionCreatedDTO([
            'subscriptionId'     => '2c92c0f96c2d540e016c4246aa292a01',
            'subscriptionNumber' => 'A-S00104559',
        ]);

        return $response;
    }

    public function testCanFetchSubscriptionDetails()
    {
        $createdDTO = $createdDTO ?? $this->buildTestSubscription('');

        try {
            $response = $this->api->subscription->id($createdDTO->subscriptionId)->fetch();
        } catch (InvalidDataTypeException $e) {
            dd([$e->getMessage(), $e->getReasons()]);
        }

        self::assertInstanceOf(Read\SubscriptionDTO::class, $response);
        self::assertTrue($response->success);
        self::assertEquals($createdDTO->subscriptionId, $response->id);
        self::assertEquals($createdDTO->subscriptionNumber, $response->subscriptionNumber);
    }
}
