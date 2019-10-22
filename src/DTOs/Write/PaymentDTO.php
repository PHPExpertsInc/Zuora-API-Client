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

namespace PHPExperts\ZuoraClient\DTOs\Write;

use PHPExperts\DataTypeValidator\DataTypeValidator;
use PHPExperts\DataTypeValidator\IsAFuzzyDataType;
use PHPExperts\SimpleDTO\NestedDTO;
use PHPExperts\SimpleDTO\WriteOnce;
use PHPExperts\ZuoraClient\DTOs\Write\Invoice\InvoicePaymentDataDTO;

/**
 * See https://www.zuora.com/developer/api-reference/#operation/Object_POSTPayment
 *
 * @property null|string           $AccountId
 * @property float                 $Amount
 * @property float                 $AppliedCreditBalanceAmount
 * @property float                 $AppliedInvoiceAmount
 * @property string                $AccountingCode
 * @property string                $Type
 * @property string                $Gateway
 * @property string                $GatewayOrderId
 * @property string                $InvoiceId
 * @property string                $InvoiceNumber
 * @property string                $Status
 * @property string                $EffectiveDate
 * @property InvoicePaymentDataDTO $InvoicePaymentData
 * @property null|string           $PaymentMethodId
 */
class PaymentDTO extends NestedDTO
{
    use WriteOnce;

    public const PAYMENT_TYPE_ELECTRONIC = 'Electronic';
    public const PAYMENT_TYPE_EXTERNAL = 'External';

    public function __construct(array $input = [], array $DTOs = [], array $options = null, DataTypeValidator $validator = null)
    {
        if (!$validator) {
            $validator = new DataTypeValidator(new IsAFuzzyDataType());
        }

        $DTOs = [
            'InvoicePaymentData' => InvoicePaymentDataDTO::class,
        ];

        $DTOs = array_intersect_key($input, $DTOs);

        parent::__construct($input, $DTOs, $options, $validator);
    }
}
