<?php declare(strict_types=1);

namespace PHPExperts\ZuoraClient\DTOs\Write\RatePlans;

use PHPExperts\SimpleDTO\NestedDTO;
use PHPExperts\SimpleDTO\WriteOnce;

/**
 * @property string                   $productRatePlanId
 * @property null|ChargeOverrideDTO[] $chargeOverrides
 */
class RatePlanDTO extends NestedDTO
{
    use WriteOnce;

    public function __construct(array $input)
    {
        $DTOs = [
            'chargeOverrides' => ChargeOverrideDTO::class,
        ];

        $DTOs = array_intersect_key($input, $DTOs);

        parent::__construct($input, $DTOs);
    }
}
