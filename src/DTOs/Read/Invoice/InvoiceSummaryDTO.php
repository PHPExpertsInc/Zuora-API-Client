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

namespace PHPExperts\ZuoraClient\DTOs\Read\Invoice;

use Carbon\Carbon;
use PHPExperts\SimpleDTO\SimpleDTO;

/**
 * This is an extended DTO provided by the Zuora PHP API Client project.
 *
 * @property int    $seq
 * @property string $accountId
 * @property string $accountName
 * @property string $status
 * @property string $invoiceDate
 * @property string $dueDate
 * @property string $renewDate
 * @property float  $amount
 * @property float  $balance
 * @property float  $creditBalance
 */
class InvoiceSummaryDTO extends SimpleDTO
{
}
