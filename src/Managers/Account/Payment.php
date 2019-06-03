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
use PHPExperts\ZuoraClient\DTOs\Read;
use PHPExperts\ZuoraClient\Managers\Payment as BasePayment;
use RuntimeException;

class Payment extends BasePayment
{
    public function fetch(): Read\PaymentDTO
    {
        $this->assertHasId();
        $zuoraGUID = $this->id;
        $response = $this->api->get('v1/payments?account_id=' . $zuoraGUID);
        if ($response && $response->success === false) {
            throw new InvalidArgumentException("Could not find a payment for Zuora ID '$zuoraGUID'.");
        }

        if (!$response || !property_exists($response, 'payments')) {
            throw new RuntimeException('Malformed Zuora API call.');
        }

        return $response->subscriptions;
    }
}
