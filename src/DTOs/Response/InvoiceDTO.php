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

namespace PHPExperts\ZuoraClient\DTOs\Response;

use Carbon\Carbon;
use PHPExperts\DataTypeValidator\DataTypeValidator;
use PHPExperts\DataTypeValidator\IsAFuzzyDataType;
use PHPExperts\SimpleDTO\SimpleDTO;

/**
 * https://www.zuora.com/developer/api-reference/#operation/Object_GETInvoice
 *
 * @property-read float      $AdjustmentAmount
 * @property-read string     $Id
 * @property-read Carbon     $UpdatedDate
 * @property-read float      $CreditBalanceAdjustmentAmount
 * @property-read string     $AccountId
 * @property-read bool       $IncludesOneTime
 * @property-read string     $InvoiceNumber
 * @property-read float      $PaymentAmount
 * @property-read Carbon     $InvoiceDate
 * @property-read bool       $IncludesUsage
 * @property-read Carbon     $DueDate
 * @property-read string     $CreatedById
 * @property-read Carbon     $CreatedDate
 * @property-read string     $Body
 * @property-read Carbon     $PostedDate
 * @property-read float      $Amount
 * @property-read float      $Balance
 * @property-read bool       $IncludesRecurring
 * @property-read string     $PostedBy
 * @property-read float      $RefundAmount
 * @property-read string     $Status
 * @property-read string     $UpdatedById
 * @property-read Carbon     $TargetDate
 * @property-read null|float $TaxExemptAmount
 * @property-read null|float $TaxAmount
 * @property-read null|float $AmountWithoutTax
 **/
class InvoiceDTO extends SimpleDTO
{
    public function __construct(array $input, array $options = [], DataTypeValidator $validator = null)
    {
        if (!$validator) {
            $validator = new DataTypeValidator(new IsAFuzzyDataType());
        }

        parent::__construct($input, $options, $validator);
    }
}
