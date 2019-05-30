<?php declare(strict_types=1);

namespace PHPExperts\ZuoraClient\DTOs\Write;

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

    public function __construct(array $input)
    {
        $DTOs = [
            'subscribeToRatePlans' => SubscriptionDTO::class,
        ];

        $DTOs = array_intersect_key($input, $DTOs);

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
