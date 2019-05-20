<?php declare(strict_types=1);

namespace PHPExperts\ZuoraClient\DTOs\Response\Account;

use PHPExperts\SimpleDTO\SimpleDTO;

/**
 * See https://www.zuora.com/developer/api-reference/#operation/GET_Account
 *
 * @property float $balance
 * @property float $totalInvoiceBalance
 * @property float $creditBalance
 * @property float $contractedMrr
 */
class MetricsDTO extends SimpleDTO
{
}
