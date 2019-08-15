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

namespace PHPExperts\ZuoraClient\DTOs\Write\Account;

use Carbon\Carbon;
use PHPExperts\DataTypeValidator\InvalidDataTypeException;
use PHPExperts\SimpleDTO\NestedDTO;
use PHPExperts\SimpleDTO\WriteOnce;
use PHPExperts\ZuoraClient\DTOs\Write\RatePlans\RatePlanDTO;

/**
 * @property Carbon           $contractEffectiveDate
 * @property string           $termType
 *
 * @property null|bool        $autoRenew
 * @property null|Carbon      $customerAcceptanceDate
 * @property null|int         $initialTerm
 * @property null|string      $invoiceOwnerAccountKey
 * @property null|string      $invoiceSeparately
 * @property null|string      $notes
 * @property null|int         $renewalTern
 * @property null|Carbon      $serviceActivationDate
 * @property null|RatePlanDTO $subscribeToRatePlans
 * @property null|string      $subscriptionNumber
 * @property null|Carbon      $termStartDate
 */
class SubscriptionDTO extends NestedDTO
{
    use WriteOnce;

    public const TERM_TYPES = [
        'TERMED',
        'EVERGREEN',
    ];

    public function __construct(array $input = [])
    {
        $DTOs = [
            'subscribeToRatePlans' => SubscriptionDTO::class,
        ];

        parent::__construct($input, $DTOs);
    }

    protected function extraValidation(array $values)
    {
        $acceptable = [
            'termType' => self::TERM_TYPES,
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
