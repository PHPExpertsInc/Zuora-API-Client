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

use PHPExperts\ZuoraClient\DTOs\Response\PaymentMethodCreatedDTO;
use PHPExperts\ZuoraClient\DTOs\Write;
use PHPExperts\ZuoraClient\DTOs\Write\PaymentMethods\CreditCardPaymentMethodDTO;
use PHPExperts\ZuoraClient\Tests\TestCase;

class PaymentMethodTest extends TestCase
{
    /** @todo: Extract these test helpers into library helpers to aid end developers. */
    public static function addCreditCardPaymentMethod(string $zuoraId, array $data = null): PaymentMethodCreatedDTO
    {
        $cardHolderInfo = new Write\PaymentMethods\CardHolderInfoDTO([
            'cardHolderName' => $data['cardHolderName'] ?? 'Test User',
        ]);

        $creditCardDTO = new CreditCardPaymentMethodDTO([
            'cardHolderInfo' => $cardHolderInfo,
        ]);

        $creditCardDTO->accountKey       = $zuoraId;
        $creditCardDTO->creditCardType   = $data['creditCardType']   ?? 'Visa';
        $creditCardDTO->creditCardNumber = $data['creditCardNumber'] ?? '4111111111111111';
        $creditCardDTO->expirationMonth  = $data['expirationMonth']  ?? '12';
        $creditCardDTO->expirationYear   = $data['expirationYear']   ?? '27';
        $creditCardDTO->securityCode     = $data['securityCode']     ?? '555';

        $zuora = self::buildZuoraClient();
        return $zuora->paymentMethod->storeCreditCard($creditCardDTO);
    }

    public function testCanCreatePaymentMethod(): PaymentMethodCreatedDTO
    {
        // Build a test account.
        $accountCreatedDTO = AccountTest::addAccount();
        $zuoraId = $accountCreatedDTO->accountId;

        $response = self::addCreditCardPaymentMethod($zuoraId);

        self::assertInstanceOf(PaymentMethodCreatedDTO::class, $response);
        self::assertTrue($response->success);
        self::assertIsString($response->paymentMethodId);

        return $response;
    }
}
