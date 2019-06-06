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

namespace PHPExperts\ZuoraClient\Managers;

use InvalidArgumentException;

class Subscription extends Manager
{
    public function fetch(string $subscriptionId)
    {
        // /subscriptions/{account-key}
        $response = $this->api->get('v1/subscriptions/' . $subscriptionId);

        if (!$response || $response->success !== true) {
            throw new InvalidArgumentException("Could not find a subscription for Zuora ID '$zuoraGUID'.");
        }

        return $response;
    }
}
