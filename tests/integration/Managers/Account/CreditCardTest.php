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

namespace PHPExperts\ZuoraClient\Tests\Integration\Managers\Account;

use PHPExperts\ZuoraClient\DTOs\Read;
use PHPExperts\ZuoraClient\DTOs\Response\PaymentMethodCreatedDTO;
use PHPExperts\ZuoraClient\DTOs\Write\PaymentMethods\CardHolderInfoDTO;
use PHPExperts\ZuoraClient\Tests\Integration\Managers\AccountTest;
use PHPExperts\ZuoraClient\Tests\Integration\Managers\PaymentMethodTest;
use PHPExperts\ZuoraClient\Tests\TestCase;

class CreditCardTest extends TestCase
{
    /** @testdox Can view an account's credit cards */
    public function testCanViewAnAccountsCreditCards()
    {
        $zuoraId = '';
        $setup = function () use (&$zuoraId): PaymentMethodCreatedDTO {
            // Build a test account.
            $accountCreatedDTO = AccountTest::addAccount();
            $zuoraId = $accountCreatedDTO->accountId;

            if ($this->isDebugOn()) {
                echo "--> Zuora ID: $zuoraId <--\n";
            }

            // Attach a credit card.
            return PaymentMethodTest::addCreditCardPaymentMethod($zuoraId);
        };

        $setup();

        $creditCards = $this->api->account->id($zuoraId)
            ->creditCard->fetch();

        self::assertInstanceOf(Read\CreditCardsDTO::class, $creditCards);
        self::assertIsArray($creditCards->creditCards);
        self::assertNotEmpty($creditCards->creditCards);
        self::assertInstanceOf(Read\CreditCardDTO::class, $creditCards->creditCards[0]);
        self::assertInstanceOf(CardHolderInfoDTO::class, $creditCards->creditCards[0]->cardHolderInfo);
        self::assertEquals('Test User', $creditCards->creditCards[0]->cardHolderInfo->cardHolderName);
        self::assertEquals('Visa', $creditCards->creditCards[0]->cardType);
        self::assertEquals('************1111', $creditCards->creditCards[0]->cardNumber);
        self::assertSame(7, $creditCards->creditCards[0]->expirationMonth);
        self::assertSame(2027, $creditCards->creditCards[0]->expirationYear);
    }
}
