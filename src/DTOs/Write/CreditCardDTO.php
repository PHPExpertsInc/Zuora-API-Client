<?php declare(strict_types=1);

namespace PHPExperts\ZuoraClient\DTOs\Write;

use PHPExperts\SimpleDTO\SimpleDTO;
use PHPExperts\SimpleDTO\WriteOnce;

/**
 * @property string $cardHolderInfo
 * @property string $cardNumber
 * @property string $cardType Visa, MasterCard, AmericanExpress, Discover, JCB, and Diners
 * @property string $expirationMonth Two-digit expiration month (01-12).
 * @property string $expirationYear Four-digit expiration year.
 * @property string $securityCode
 */
class CreditCardDTO extends SimpleDTO
{
    use WriteOnce;
}
