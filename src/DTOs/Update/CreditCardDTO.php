<?php declare(strict_types=1);

namespace PHPExperts\ZuoraClient\DTOs\Update;

use PHPExperts\DataTypeValidator\DataTypeValidator;
use PHPExperts\SimpleDTO\SimpleDTO;
use PHPExperts\SimpleDTO\WriteOnce;

/**
 * Taken from https://www.zuora.com/developer/api-reference/#operation/PUT_PaymentMethodsCreditCard
 *
 * @property null|string      $addressLine1
 * @property null|string      $addressLine2
 * @property null|string      $cardHolderName
 * @property null|string      $city
 * @property null|string      $country
 * @property null|bool        $defaultPaymentMethod
 * @property null|string      $email
 * @property null|string      $expirationMonth
 * @property null|string      $expirationYear
 * @property null|int         $numConsecutiveFailures
 * @property null|string      $phone
 * @property null|string      $securityCode
 * @property null|string      $state
 * @property null|string      $zipCode
 *
 */
class CreditCardDTO extends SimpleDTO
{
    use WriteOnce;

    public function __construct(array $input = [], array $options = [], DataTypeValidator $validator = null)
    {
        parent::__construct($input, $options, $validator);
    }
}