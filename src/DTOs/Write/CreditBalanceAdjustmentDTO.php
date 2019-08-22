<?php declare(strict_types=1);

namespace PHPExperts\ZuoraClient\DTOs\Write;

use PHPExperts\DataTypeValidator\DataTypeValidator;
use PHPExperts\DataTypeValidator\IsAFuzzyDataType;
use PHPExperts\SimpleDTO\SimpleDTO;
use PHPExperts\SimpleDTO\WriteOnce;

/**
 * https://www.zuora.com/developer/api-reference/#operation/Object_POSTCreditBalanceAdjustment
 *
 * @property null|string $AccountingCode
 * @property float       $Amount
 * @property null|string $Comment
 * @property null|string $ReasonCode
 * @property null|string $ReferenceId
 * @property null|string $SourceTransactionId       (Invoice ID, Payment ID, Refund ID) Cannot be null if $SourceTransactionNumber is null
 * @property null|string $SourceTransactionNumber   (Invoice Number, Payment Number, Refund Number) Cannot be null if $SourceTransactionId is null
 * @property string      $Type
 */
class CreditBalanceAdjustmentDTO extends SimpleDTO
{
    use WriteOnce;

    public const CREDIT_BALANCE_ADJUSTMENT_TYPE_INCREASE = 'Increase';
    public const CREDIT_BALANCE_ADJUSTMENT_TYPE_DECREASE = 'Decrease';

    public function __construct(array $input = [], array $options = [], DataTypeValidator $validator = null)
    {
        if (!$validator) {
            $validator = new DataTypeValidator(new IsAFuzzyDataType());
        }

        parent::__construct($input, $options, $validator);
    }
}
