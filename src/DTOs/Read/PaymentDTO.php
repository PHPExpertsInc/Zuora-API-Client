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
use PHPExperts\DataTypeValidator\DataTypeValidator;
use PHPExperts\DataTypeValidator\IsAFuzzyDataType;
use PHPExperts\SimpleDTO\SimpleDTO;

/**
 * See https://www.zuora.com/developer/api-reference/#operation/GET_Payment
 *
 * @property string         $Id
 * @property string         $AccountId
 * @property string         $AccountingCode
 * @property float          $Amount
 * @property float          $AppliedCreditBalanceAmount
 * @property string         $BankIdentificationNumber
 * @property string         $Comment
 * @property string         $Gateway
 * @property string         $GatewayResponse
 * @property string         $GatewayResponseCode
 * @property string         $GatewayState
 * @property string         $PaymentNumber
 * @property string         $PaymentMethodId
 * @property string         $PaymentMethodSnapshotId
 * @property null|string    $ReferenceId
 * @property float          $RefundAmount
 * @property null|Carbon    $SubmittedOn
 * @property string         $Source
 * @property string         $Status
 * @property string         $Type
 * @property string         $CreatedById
 * @property string         $UpdatedById
 * @property Carbon         $UpdatedDate
 * @property Carbon         $CreatedDate
 * @property Carbon         $EffectiveDate
 */
class PaymentDTO extends SimpleDTO
{
    public function __construct(array $input, DataTypeValidator $validator = null)
    {
        if (!$validator) {
            $validator = new DataTypeValidator(new IsAFuzzyDataType());
        }

        parent::__construct($input, [self::PERMISSIVE], $validator);
    }
}
