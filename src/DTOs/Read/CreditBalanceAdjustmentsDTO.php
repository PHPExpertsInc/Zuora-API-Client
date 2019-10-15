<?php declare(strict_types=1);

namespace PHPExperts\ZuoraClient\DTOs\Read;

use PHPExperts\SimpleDTO\SimpleDTO;

/**
 * https://www.zuora.com/developer/api-reference/#operation/Object_GETCreditBalanceAdjustment
 *
 * @property null|string $AccountingCode
 * @property float       $Amount
 * @property null|string $Comment
 * @property null|string $ReasonCode
 * @property null|string $ReferenceId
 * @property null|string $SourceTransactionId
 * @property null|string $SourceTransactionNumber
 * @property string      $Type
 */
class CreditBalanceAdjustmentsDTO extends SimpleDTO
{
}
