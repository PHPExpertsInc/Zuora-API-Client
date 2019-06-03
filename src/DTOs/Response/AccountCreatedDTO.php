<?php declare(strict_types=1);

namespace PHPExperts\ZuoraClient\DTOs\Response;

use PHPExperts\SimpleDTO\SimpleDTO;

/**
 * @property-read bool   $success
 * @property-read string $accountId
 * @property-read string $accountNumber
 * @property-read string $billToContactId
 * @property-read string $soldToContactId
 */
class AccountCreatedDTO extends SimpleDTO
{
}
