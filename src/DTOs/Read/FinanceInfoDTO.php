<?php declare(strict_types=1);

namespace PHPExperts\ZuoraClient\DTOs\Read;

use PHPExperts\SimpleDTO\SimpleDTO;

/**
 * https://www.zuora.com/developer/api-reference/#operation/GET_Payment
 *
 * @property string $bankAccountAccountingCode
 * @property string $bankAccountAccountingCodeType
 * @property string $transferredToAccounting
 * @property string $unappliedPaymentAccountingCode
 * @property string $unappliedPaymentAccountingCodeType
 */
class FinanceInfoDTO extends SimpleDTO
{
}
