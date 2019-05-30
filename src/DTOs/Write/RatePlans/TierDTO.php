<?php declare(strict_types=1);

namespace PHPExperts\ZuoraClient\DTOs\Write\RatePlans;

use PHPExperts\DataTypeValidator\DataTypeValidator;
use PHPExperts\DataTypeValidator\InvalidDataTypeException;
use PHPExperts\DataTypeValidator\IsAStrictDataType;
use PHPExperts\SimpleDTO\SimpleDTO;
use PHPExperts\SimpleDTO\WriteOnce;

/**
 * @property float       $price
 * @property int         $tier
 * @property null|float  $startingUnit
 * @property null|float  $endingUnit
 * @property null|string $priceFormat
 **/
class TierDTO extends SimpleDTO
{
    use WriteOnce;

    public const PRICE_FORMATS = [
        'FlatFee',
        'PerUnit',
    ];

    protected function extraValidation(array $values)
    {
        $acceptable = [
            'priceFormat' => self::PRICE_FORMATS,
        ];

        $self = get_class($this);
        foreach ($values as $propery => $value) {
            if (!empty($acceptable[$propery])) {
                if (!in_array($value, $acceptable[$propery])) {
                    $acceptableValues = implode(', ', $acceptable[$propery]);

                    throw new InvalidDataTypeException("The value of $self::\$$propery must be one of $acceptableValues");
                }
            }
        }
    }
}
