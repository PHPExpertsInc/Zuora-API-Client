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

use Koriym\HttpConstants\StatusCode as HTTP;
use PHPExperts\SimpleDTO\SimpleDTO;
use PHPExperts\ZuoraClient\DTOs\Response\DetailedCreditCardDTO;
use PHPExperts\ZuoraClient\DTOs\Response\PaymentMethodCreatedDTO;
use PHPExperts\ZuoraClient\DTOs\Write;
use PHPExperts\ZuoraClient\DTOs\Write\PaymentMethods\CreditCardPaymentMethodDTO;
use PHPExperts\ZuoraClient\Exceptions\ZuoraAPIException;
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
        $creditCardDTO->expirationMonth  = $data['expirationMonth']  ?? '07';
        $creditCardDTO->expirationYear   = $data['expirationYear']   ?? '27';
        $creditCardDTO->securityCode     = $data['securityCode']     ?? '555';

        $zuora = self::buildZuoraClient();
        return $zuora->paymentMethod->storeCreditCard($creditCardDTO);
    }

    public function testCanCreateAPaymentMethod(string $zuoraId = null): array
    {
        if (!$zuoraId) {
            // Build a test account.
            $accountCreatedDTO = AccountTest::addAccount();
            $zuoraId = $accountCreatedDTO->accountId;
        }

        $response = self::addCreditCardPaymentMethod($zuoraId);

        self::assertInstanceOf(PaymentMethodCreatedDTO::class, $response);
        self::assertTrue($response->success);
        self::assertIsString($response->paymentMethodId);

        return [$zuoraId, $response];
    }

    /** @depends testCanCreateAPaymentMethod */
    public function testCanFetchAPaymentMethod(array $paymentInfoPair)
    {
        /**
         * @var string                  $zuoraId
         * @var PaymentMethodCreatedDTO $paymentInfo
         */
        [$zuoraId, $paymentInfo] = $paymentInfoPair;
        $paymentMethodId = $paymentInfo->paymentMethodId;

        $response = $this->api->paymentMethod->id($paymentMethodId)->fetch();

        self::assertInstanceOf(DetailedCreditCardDTO::class, $response);
        self::assertEquals($paymentMethodId, $response->Id);
        self::assertEquals($zuoraId, $response->AccountId);
        self::assertEquals('************1111', $response->CreditCardMaskNumber);
        self::assertEquals('411111', $response->BankIdentificationNumber);
        self::assertTrue($response->UseDefaultRetryRule);
    }

    /** @depends testCanCreateAPaymentMethod */
    public function testCannotDeleteTheDefaultPaymentMethod(array $paymentInfoPair)
    {
        [, $paymentInfo] = $paymentInfoPair;
        $paymentMethodId = $paymentInfo->paymentMethodId;

        try {
            $this->api->paymentMethod->id($paymentMethodId)->destroy();
            $this->fail('[API Break] Deleted the primary payment method. ');
        } catch (ZuoraAPIException $zae) {
            self::assertEquals(
                'Deleting the PaymentMethod was unsuccessful: Cannot delete default payment method.',
                $zae->getMessage()
            );
        }
    }

    /** @depends testCanCreateAPaymentMethod */
    public function testCanDeleteAPaymentMethod(array $paymentInfoPair)
    {
        // Add two payment methods (Can't delete Default  Card).
        /**
         * @var string                  $zuoraId
         * @var PaymentMethodCreatedDTO $paymentInfo
         */
        [$zuoraId, $paymentInfo] = $paymentInfoPair;
        $this->testCanCreateAPaymentMethod($zuoraId);

        $paymentMethodId = $paymentInfo->paymentMethodId;

        /** @var SimpleDTO $response */
        $response = $this->api->paymentMethod->id($paymentMethodId)->destroy();
        self::assertTrue($response);
        self::assertEquals(HTTP::OK, $this->api->getApiClient()->getLastStatusCode());

        $rawResponse = (string) $this->api->getApiClient()->getLastResponse()->getBody();
        self::assertNotEmpty($rawResponse);
        self::assertIsString($rawResponse);
        self::assertEquals(['success' => true], json_decode($rawResponse, true));
    }
}
