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
use PHPExperts\DataTypeValidator\InvalidDataTypeException;
use PHPExperts\ZuoraClient\DTOs\Read;
use PHPExperts\ZuoraClient\Exceptions\ZuoraAPIException;
use PHPExperts\ZuoraClient\Managers\Manager;
use PHPExperts\ZuoraClient\DTOs\Update;

class CreditCard extends Manager
{
    public function fetch(): Read\CreditCardsDTO
    {
        $this->assertHasId();
        $zuoraGUID = $this->id;
        $response = $this->api->get('v1/payment-methods/credit-cards/accounts/' . $zuoraGUID);

        if ($response && $response->success === false) {
            throw new InvalidArgumentException("Could not find any invoices for Zuora ID '$zuoraGUID'.");
        }

        if (!$response || !property_exists($response, 'creditCards')) {
            throw new ZuoraAPIException('Malformed Zuora API call.');
        }

        try {
            return new Read\CreditCardsDTO((array) $response);
        } catch (InvalidDataTypeException $e) {
            throw new ZuoraAPIException(json_encode($e->getReasons()));
        }
    }

    public function update(Update\CreditCardDTO $creditCardDTO)
    {
        $this->assertHasId();
        $paymentMethodId = $this->id;
        $response = $this->api->put('v1/payment-methods/credit-cards/' . $paymentMethodId, [
            'json' => $creditCardDTO,
        ]);

        if ($response && $response->success !== true) {
            throw new InvalidArgumentException("The payment method you are requesting cannot be found. ID: '$paymentMethodId'.");
        }

        if (!$response || !property_exists($response, 'paymentMethodId')) {
            throw new ZuoraAPIException('Malformed Zuora API call.');
        }

        return $this->processResponse($response);
    }
}
