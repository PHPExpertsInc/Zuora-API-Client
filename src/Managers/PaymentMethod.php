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

use PHPExperts\ZuoraClient\DTOs\Response;
use PHPExperts\ZuoraClient\DTOs\Write\PaymentMethods\CreditCardPaymentMethodDTO;

class PaymentMethod extends Manager
{
    public function fetch(): Response\DetailedCreditCardDTO
    {
        $this->assertHasId();
        $response = $this->api->get('v1/object/payment-method/' . $this->id);

        $response = $this->processResponse($response, 'Fetching a Payment Method');

        return new Response\DetailedCreditCardDTO((array) $response);
    }

    public function storeCreditCard(CreditCardPaymentMethodDTO $paymentMethodDTO): Response\PaymentMethodCreatedDTO
    {
        $response = $this->api->post('v1/payment-methods/credit-cards', [
            'json' => $paymentMethodDTO,
        ]);

        $response = $this->processResponse($response, 'Creating a Payment Method');

        return new Response\PaymentMethodCreatedDTO((array) $response);
    }

    public function destroy(string $uri = ''): bool
    {
        return parent::destroy('/v1/payment-methods/');
    }
}
