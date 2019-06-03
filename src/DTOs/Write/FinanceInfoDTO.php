<?php declare(strict_types=1);

namespace PHPExperts\ZuoraClient\DTOs\Write;

use PHPExperts\SimpleDTO\SimpleDTO;
use PHPExperts\SimpleDTO\WriteOnce;

/**
 * https://www.zuora.com/developer/api-reference/#operation/POST_CreatePayment
 *
 * @property string $bankAccountAccountingCode
 * @property string $transferredToAccounting
 * @property string $unappliedPaymentAccountingCode
 */
class FinanceInfoDTO extends SimpleDTO
{
    use WriteOnce;
}
