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

namespace PHPExperts\ZuoraClient\DTOs\Read\RatePlans;

use Carbon\Carbon;
use PHPExperts\SimpleDTO\NestedDTO;

/**
 * See https://www.zuora.com/developer/api-reference/#operation/GET_SubscriptionsByKey
 *
 * @property-read string      $id
 * @property-read string      $originalChargeId
 * @property-read string      $productRatePlanChargeId
 * @property-read string      $number
 * @property-read string      $name
 * @property-read string      $type
 * @property-read string      $model
 * @property-read null|string $uom            Specifies the units to measure usage.*
 * @property-read int         $version        Rate plan charge revision number.
 * @property-read null|string $pricingSummary Concise description of rate plan charge model.
 * @property-read null|string $priceChangeOption
 * @property-read null|float  $priceIncreasePercentage
 * @property-read string      $currency
 * @property-read float       $price
 * @property-read TierDTO[]   $tiers
 * @property-read null|float  $includedUnits
 * @property-read null|float  $overagePrice
 * @property-read null|float  $discountPercentage
 * @property-read null|float  $discountAmount
 * @property-read null|string $applyDiscountTo
 * @property-read null|string $discountLevel
 * @property-read null|string $discountClass
 * @property-read null|string $billingDay
 * @property-read null|string $listPriceBase
 * @property-read null|string $billingPeriod
 * @property-read null|int    $specificBillingPeriod
 * @property-read null|string $billingTiming
 * @property-read null|string $billingPeriodAlignment
 * @property-read float       $quantity
 * @property-read null|string $smoothingModel
 * @property-read null|int    $numberOfPeriods
 * @property-read null|string $overageCalculationOption
 * @property-read null|string $overageUnusedUnitsCreditOption Determines whether to credit the customer with unused
 *                                                            units of usage.
 * @property-read null|float  $unusedUnitsCreditRates
 * @property-read null|string $usageRecordRatingOption        Determines how Zuora processes usage records for per-unit
 *                                                            usage charges.
 * @property-read int         $segment
 * @property-read Carbon      $effectiveStartDate
 * @property-read Carbon      $effectiveEndDate
 * @property-read Carbon      $processedThroughDate
 * @property-read Carbon      $chargedThroughDate The date through which a customer has been billed for the charge.
 * @property-read bool        $done
 * @property-read null|Carbon $triggerDate
 * @property-read string      $triggerEvent
 * @property-read string      $endDateCondition
 * @property-read null|string $upToPeriods     Specifies the length of the period during which the charge is active. If
 *                                             this period ends before the subscription ends, the charge ends when this
 *                                             period ends.
 * @property-read null|string $upToPeriodsType The period type used to define when the charge ends.
 * @property-read null|Carbon $specificEndDate
 * @property-read null|float  $mrr             Monthly recurring revenue of the rate plan charge.
 * @property-read null|float  $dmrc            The change (delta) of monthly recurring charge exists when the change in
 *                                             monthly recurring revenue caused by an amendment or a new subscription.
 * [API Break! Zuora returns a float but docs say string]
 * @property-read float       $tcv             The total contract value.
 * [API Break! Zuora returns a float but docs say string]
 * @property-read float       $dtcv            After an amendment or an AutomatedPriceChange event, dtcv displays the
 *                                             change (delta) for the total contract value (TCV) amount for this charge,
 *                                             compared with its previous value with recurring charge types.
 * @property-read string      $description
 * @property-read string      $ratingGroup
 * @property-read null|DiscountApplyDetailDTO[] $discountApplyDetails
*/
class RatePlanChargeDTO extends NestedDTO
{
    public function __construct(array $input)
    {
        $DTOs = [
            'discountApplyDetails' => DiscountApplyDetailDTO::class,
            'tiers'                => DiscountApplyDetailDTO::class,
        ];

        if (empty($input['discountApplyDetails'])) {
            unset($DTOs['discountApplyDetails']);
            unset($input['discountApplyDetails']);
        }

        if (empty($input['tiers'])) {
            unset($DTOs['tiers']);
            unset($input['tiers']);
        }

        parent::__construct($input, $DTOs);
    }
}
