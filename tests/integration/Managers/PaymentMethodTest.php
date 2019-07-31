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
use PHPExperts\ZuoraClient\Tests\TestCase;

class PaymentMethodTest extends TestCase
{
    public function testCanCreatePaymentMethod(): PaymentMethodCreatedDTO
    {
//        $accountInfo = AccountTest::buildTestAccount();
//        $accountInfo->accountId

        $cardHolderInfo = new Write\PaymentMethods\CardHolderInfoDTO([
             'cardHolderName' => 'Theodore R. Smith',
        ]);

        $creditCardInfoDTO = new Write\PaymentMethods\CreditCardPaymentMethodDTO([
            'cardHolderInfo' => $cardHolderInfo,
        ]);
        $creditCardInfoDTO->cardType = 'Visa';
        $creditCardInfoDTO->cardNumber = '4111111111111111';
        $creditCardInfoDTO->expirationMonth = '12';
        $creditCardInfoDTO->expirationYear = '27';
        $creditCardInfoDTO->securityCode = '555';

        $response = $this->api->paymentMethod->store($creditCardInfoDTO);
        dd($response);
    }
}
