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
use PHPExperts\ZuoraClient\DTOs\Read;
use PHPExperts\ZuoraClient\DTOs\Write;

class Payment extends Manager
{
    public function fetch(): Read\PaymentDTO
    {
        $this->assertHasId();
        $response = $this->api->get('v1/payments/' . $this->id);

        if (!$response || $response->success !== true) {
            throw new InvalidArgumentException("Could not find a subscription with the ID '{$this->id}'.");
        }

        return new Read\PaymentDTO((array) $response);
    }

    public function store(Write\PaymentDTO $paymentDTO): Read\PaymentDTO
    {
        $this->assertHasId();
        $response = $this->api->post('v1/payments/' . $this->id, [
            'json' => $paymentDTO,
        ]);

        $response = $this->processResponse($response);

        return new Read\PaymentDTO((array) $response);
    }
}
