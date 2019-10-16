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
use PHPExperts\ZuoraClient\DTOs\Response\SubscriptionCreatedDTO;
use PHPExperts\ZuoraClient\DTOs\Write;
use PHPExperts\ZuoraClient\DTOs\Read;
use PHPExperts\ZuoraClient\Tests\TestCase;

class SubscriptionTest extends TestCase
{
    /** @todo: Extract these test helpers into library helpers to aid end developers. */
    public static function addSubscription(string $zuoraId): SubscriptionCreatedDTO
    {
        try {
            $subscriptionDTO = new Write\SubscriptionDTO();
            $subscriptionDTO->runBilling = true;
            $subscriptionDTO->collect = false;
            $subscriptionDTO->autoRenew = false;
            $subscriptionDTO->initialTerm = 1;
            $subscriptionDTO->accountKey = $zuoraId;
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

        try {
            $zuora = self::buildZuoraClient();
            return $zuora->subscription->store($subscriptionDTO);
        } catch (InvalidDataTypeException $e) {
            dd($e->getReasons());
        }
    }

    public function testCanCreateASubscription(): SubscriptionCreatedDTO
    {
        $accountCreatedDTO = AccountTest::addAccount();

        $response = $this->addSubscription($accountCreatedDTO->accountId);

        self::assertInstanceOf(SubscriptionCreatedDTO::class, $response);
        self::assertTrue($response->success);
        self::assertIsString($response->subscriptionId);
        self::assertIsString($response->subscriptionNumber);

        return $response;
    }

    /** @depends testCanCreateASubscription */
    public function testCanFetchSubscriptionDetails(SubscriptionCreatedDTO $createdDTO = null)
    {
        $createdDTO = $createdDTO ?? $this->addSubscription('');

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

    public function testCanCreatePreviewSubscriptions()
    {
        $today = Carbon::now()->toDateString();
        $ratePlan = new Write\RatePlans\RatePlanDTO([
            'productRatePlanId' => '2c92c0f94f687b05014f6bf34cc67422',
        ]);

        $previewDTO = new Write\SubscriptionPreviewDTO([
            'contractEffectiveDate' => $today,
            'initialTerm'           => 12,
            'initialTermPeriodType' => Write\SubscriptionPreviewDTO::TERM_PERIOD_MONTH,
            'previewAccountInfo'    => new Write\Account\PreviewAccountDTO([
                'billCycleDay'  => 31,
                'currency'      => 'USD',
                'billToContact' => new Write\ContactDTO([
                    'city'    => 'Houston',
                    'state'   => 'Texas',
                    'zipCode' => '77058',
                    'country' => 'United States',
                ]),
            ]),
            'termType' => Write\SubscriptionPreviewDTO::TERM_TYPE_TERMED,
            'subscribeToRatePlans' => [$ratePlan],
        ]);

        $response = $this->api->subscription->preview($previewDTO);

        self::assertTrue($response->success);
        self::assertEquals(10.95, $response->contractedMrr);
        self::assertEquals($today, $response->targetDate->toDateString());
    }
}
