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
use PHPExperts\ZuoraClient\DTOs\Write\Invoice\InvoicePaymentDataDTO;
use PHPExperts\ZuoraClient\DTOs\Write\Invoice\InvoicePaymentDTO;
use PHPExperts\ZuoraClient\DTOs\Write\PaymentDTO;
use PHPExperts\ZuoraClient\Tests\TestCase;

class PaymentTest extends TestCase
{
    public function testCanFetchPaymentGateways()
    {
        $accountCreatedDTO = AccountTest::addAccount();

        $subscriptionCreatedDTO = SubscriptionTest::addSubscription($accountCreatedDTO->accountId);

        $creditCardDTO = PaymentMethodTest::addCreditCardPaymentMethod($accountCreatedDTO->accountId);

        $paymentDTO = new PaymentDTO();
        $paymentDTO->AccountId = $accountCreatedDTO->accountId;

        $invoicePayment = new InvoicePaymentDTO();
        $invoicePayment->Amount = 10.0;
        $invoicePayment->InvoiceId = $subscriptionCreatedDTO->invoiceId;

        $invoicePaymentData = new InvoicePaymentDataDTO([
            'InvoicePayment' => [$invoicePayment],
        ]);

        $paymentDTO->InvoicePaymentData = $invoicePaymentData;

        $paymentDTO->PaymentMethodId = $creditCardDTO->paymentMethodId;
        $paymentDTO->Amount = 10.0;
        $paymentDTO->Type = 'Electronic';
        $paymentDTO->EffectiveDate = Carbon::today()->toDateString();
        $paymentDTO->Status = 'Processed';

        $zuoraId = $accountCreatedDTO->accountId;
        if (self::isDebugOn()) {
            echo "\n\n --> ZuoraID: $zuoraId <-- \n\n";
        }

        $response = $this->api->payment->store($paymentDTO);
        dd($response);
    }
}
