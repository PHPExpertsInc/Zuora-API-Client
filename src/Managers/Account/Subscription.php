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

namespace PHPExperts\ZuoraClient\Managers\Account;

use InvalidArgumentException;
use PHPExperts\ZuoraClient\DTOs\NextChargedDateDTO;
use PHPExperts\ZuoraClient\Managers\Subscription as BaseSubscription;
use RuntimeException;
use Throwable;

class Subscription extends BaseSubscription
{
    public function fetch()
    {
        $this->assertHasId();
        $zuoraGUID = $this->id;
        $response = $this->api->get('v1/accounts/' . $zuoraGUID . '/summary');
        if ($response && $response->success === false) {
            throw new InvalidArgumentException("Could not find a subscription for Zuora ID '$zuoraGUID'.");
        }

        if (!$response || !property_exists($response, 'subscriptions')) {
            throw new RuntimeException('Malformed Zuora API call.');
        }

        return $response->subscriptions;
    }

    public function fetchNextChargeDate(): NextChargedDateDTO
    {
        $this->assertHasId();
        $zuoraGUID = $this->id;
        $subscriptions = $this->fetch();

        $subscriptionId = '';
        $chargedDate = null;
        // Find the latest rate Plan.
        foreach ($subscriptions as $subscription) {
            if ($subscription->status === 'Active') {
                $subscriptionId = $subscription->id;
                $subscription = null;
            }
        }

        if (!$subscriptionId) {
            throw new InvalidArgumentException(
                'Could not find an active subscription for ' . $zuoraGUID
            );
        }

        $subscriptionDetails = $this->zuora->subscription->fetch();

        if (empty($subscriptionDetails->ratePlans)) {
            throw new InvalidArgumentException(
                "The Zuora Account $zuoraGUID does not have an active payment plan."
            );
        }

        foreach ($subscriptionDetails->ratePlans as $subRatePlan) {
            if (empty($subRatePlan)) {
                continue;
            }

            if (empty($subRatePlan->ratePlanCharges)) {
                continue;
            }

            try {
                // There can only be one ratePlanCharge, using Zuora the way USLS does.
                $chargedDate = $subRatePlan->ratePlanCharges[0]->chargedThroughDate;
                break;
            } catch (Throwable $e) {
                throw new RuntimeException('It looks like either Zuora API or USLS usage of Zuora has changed and broken the fetching of charge dates.');
            }
        }

        if (!$chargedDate) {
            $errorMessage = "Could not find a NextChargedDate for {$subscriptionId} on {$zuoraGUID}.";
            error_log($errorMessage);
            throw new \LogicException($errorMessage);
        }

        return new NextChargedDateDTO([
            'zuoraGUID'       => $zuoraGUID,
            'subscriptionId'  => $subscriptionId,
            'nextChargeDate'  => $chargedDate,
        ]);
    }
}
