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

namespace PHPExperts\ZuoraClient\DTOs\Write\PaymentMethods;

use PHPExperts\DataTypeValidator\InvalidDataTypeException;
use PHPExperts\SimpleDTO\WriteOnce;
use PHPExperts\ZuoraClient\DTOs\Write\PaymentMethodDTO;

/**
 * Taken from https://www.zuora.com/developer/api-reference/#operation/POST_PaymentMethods
 *
 * @property null|CardHolderInfoDTO $cardHolderInfo
 * @property string            $cardType
 * @property string            $cardNumber
 * @property string            $expirationMonth
 * @property string            $expirationYear
 * @property null|string       $securityCode     The CVV or CVV2 security code of the credit card.
 * @property null|string       $mitProfileAction If you set this field, Zuora creates a stored credential profile within
 *                                               the payment method.
 * @property null|string       $mitConsentAgreementRef
 * @property null|string       $mitConsentAgreementSrc
 * @property null|string       $mitNetworkTransactionId
 * @property null|string       $mitProfileType
 * @property null|string       $mitProfileAgreedOn
 */
class CreditCardPaymentMethodDTO extends PaymentMethodDTO
{
    use WriteOnce {
        __set as __writeOnceSet;
    }

    public function __construct(array $input = [])
    {
        $DTOs = [
            'cardHolderInfo' => CardHolderInfoDTO::class,
        ];

        $input['type'] = self::PAYMENT_TYPE_CREDIT_CARD;

        parent::__construct($input, $DTOs);
    }

    public function __set(string $property, $value): void
    {
        if ($property === 'expirationYear' && strlen($value) === 2) {
            $value = '20' . $value;
        }

        $this->__writeOnceSet($property, $value);
    }

    public function extraValidation(array $input)
    {
        if (!empty($input['expirationYear']) && strlen($input['expirationYear']) < 4) {
            throw new InvalidDataTypeException("'expirationYear' must be between 1980 and 2500");
        }
    }
}
