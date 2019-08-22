<?php declare(strict_types=1);

namespace PHPExperts\ZuoraClient\DTOs\Response;

use PHPExperts\SimpleDTO\SimpleDTO;

/**
 * @property-read string        $creditBalanceAdjustmentId              The Internal ID of the credit balance adjustment that was created.
 * @property-read bool          $success         Indicates whether the call succeeded.
 * @property-read null|string[] $reasons         The reasons why creating the credit balance adjustment failed.
 */
class CreditBalanceAdjustmentCreated extends SimpleDTO
{
}
