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

use Carbon\Carbon;
use PHPExperts\DataTypeValidator\InvalidDataTypeException;
use PHPExperts\ZuoraClient\DTOs\Response\AccountCreatedDTO;
use PHPExperts\ZuoraClient\DTOs\Response\SubscriptionCreatedDTO;
use PHPExperts\ZuoraClient\DTOs\Write;
use PHPExperts\ZuoraClient\DTOs\Read;
use PHPExperts\ZuoraClient\Exceptions\ZuoraAPIException;
use PHPExperts\ZuoraClient\Tests\TestCase;
use PHPExperts\ZuoraClient\Tests\unit\Mocks\MockDTOs;

class SubscriptionTest extends TestCase
{
    /** @todo: Extract these test helpers into library helpers to aid end developers. */
    public static function createTestSubscription(string $zuoraId): SubscriptionCreatedDTO
    {
//        try {
//            $zuora = self::buildZuoraClient();
//            $response = $zuora->account->store($accountDTO);
//        } catch (InvalidDataTypeException $e) {
//            dd($e->getReasons());
//        }

        // @FIXME: Before release, this method needs to create a subscription dynamically.
        $response = MockDTOs::createSubscriptionCreatedDTO([
            'subscriptionId'     => '2c92c0f96c2d540e016c4246aa292a01',
            'subscriptionNumber' => 'A-S00104559',
        ]);

        return $response;
    }

    public function testCanCreateASubscription()
    {
        try {
            $subscriptionDTO = new Write\SubscriptionDTO();
            $subscriptionDTO->invoiceCollect = true;
            $subscriptionDTO->autoRenew = false;
            $subscriptionDTO->initialTerm = 1;
            $subscriptionDTO->accountKey = '2c92c0fa6c2d46b6016c45450a603d36';
            $subscriptionDTO->contractEffectiveDate = Carbon::today();
            $subscriptionDTO->termStartDate = Carbon::today();
            $subscriptionDTO->renewalTerm = 1;
            $subscriptionDTO->renewalTermPeriodType = Write\SubscriptionDTO::TERM_PERIOD_MONTH;
            $subscriptionDTO->termType = Write\SubscriptionDTO::TERM_TYPE_TERMED;

            $ratePlan = new Write\RatePlans\RatePlanDTO();
            $ratePlan->productRatePlanId = '2c92c0f94f687b05014f6bf34cc67422';
            $subscriptionDTO->subscribeToRatePlans = [$ratePlan];
        } catch (InvalidDataTypeException $e) {
            dd($e->getReasons());
        }

        $response = $this->api->subscription->store($subscriptionDTO);
        dd($response);

        self::assertInstanceOf(SubscriptionCreatedDTO::class, $response);
        self::assertTrue($response->success);
        self::assertIsString($response->subscriptionId);
        self::assertIsString($response->subscriptionNumber);

        return $response;
    }

//    /** @depends testCanCreateAnAccount */
    public function testCanFetchSubscriptionDetails(SubscriptionCreatedDTO $createdDTO = null)
    {
        $this->markTestIncomplete();
        $createdDTO = $createdDTO ?? $this->createTestSubscription('');

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
