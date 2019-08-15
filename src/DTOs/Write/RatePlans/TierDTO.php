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

namespace PHPExperts\ZuoraClient\DTOs\Write\RatePlans;

use PHPExperts\DataTypeValidator\DataTypeValidator;
use PHPExperts\DataTypeValidator\InvalidDataTypeException;
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

    public function __construct(array $input = [], array $options = [], DataTypeValidator $validator = null)
    {
        parent::__construct($input, $options, $validator);
    }

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
