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

namespace PHPExperts\ZuoraClient\DTOs\Read;

use Carbon\Carbon;
use PHPExperts\SimpleDTO\SimpleDTO;

/**
 * See https://www.zuora.com/developer/api-reference/#operation/GET_TransactionInvoice
 *
 * @property string $id
 * @property string $subscriptionName
 * @property string $subscriptionId
 * @property Carbon $serviceStartDate
 * @property Carbon $serviceEndDate
 * @property float  $chargeAmount
 * @property string $chargeDescription
 * @property string $chargeName
 * @property string $chargeId
 * @property string $productName
 * @property float  $quantity
 * @property float  $taxAmount
 * @property string $unitOfMeasure
 * @property Carbon $chargeDate
 * @property string $chargeType
 * @property string $processingType
 * @property bool   $appliedToItemId
 */
class InvoiceItemDTO extends SimpleDTO
{
}
