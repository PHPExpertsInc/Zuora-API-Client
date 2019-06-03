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

use Carbon\Carbon;
use PHPExperts\DataTypeValidator\InvalidDataTypeException;
use PHPExperts\SimpleDTO\SimpleDTO;
use PHPExperts\SimpleDTO\WriteOnce;

/**
 * @property string      $productRatePlanChargeId
 * @property null|string $applyDiscountTo
 * @property null|int    $billCycleDay
 * @property null|string $billCycleType
 * @property null|string $billingPeriod
 * @property null|string $billingPeriodAlignment
 * @property null|string $billingTiming
 * @property null|string $description
 * @property null|float  $discountAmount
 * @property null|string $discountLevel
 * @property null|float  $discountPercentage
 * @property null|string $endDateCondition
 * @property null|float  $includedUnits
 * @property null|string $listPriceBase
 * @property null|string $number A unique number that identifies the charge. Max 50 characters.
 * @property null|int    $numberOfPeriods
 * @property null|float  $overagePrice
 * @property null|string $overageUnusedUnitsCreditOption
 * @property null|float  $price
 * @property null|string $priceChangeOption
 * @property null|float  $priceIncreasePercentage
 * @property null|float  $quantity
 * @property null|string $ratingGroup
 * @property null|int    $specificBillingPeriod
 * @property null|Carbon $specificEndDate
 * @property null|array  $tiers An array of TierDTOs.
 * @property null|Carbon $triggerDate
 * @property null|string $triggerEvent
 * @property null|float  $unusedUnitsCreditRates
 * @property null|int    $upToPeriods
 * @property null|string $upToPeriodsType
 * @property null|string $weeklyBillCycleDay
 */
class ChargeOverrideDTO extends SimpleDTO
{
    use WriteOnce;

    public const APPLY_DISCOUNTS_TO = [
        'ONETIME',
        'RECURRING',
        'USAGE',
        'ONETIMERECURRING',
        'ONETIMEUSAGE',
        'RECURINGUSAGE',
        'ONETIMERECURRINGUSAGE',
    ];

    public const BILL_CYCLES = [
        'DefaultFromCustomer',
        'SpecificDayofMonth',
        'SpecificDayofWeek',
        'SubscriptionStartDay',
        'ChargeTriggerDay',
    ];

    public const BILLING_PERIODS = [
        'Week',
        'Month',
        'Quarter',
        'Semi_Annual',
        'Annual',
        'Eighteen_months',
        'Two_Years',
        'Three_Years',
        'Five_Years',
        'Specific_Months',
        'Specific_Weeks',
        'Subscription_Term',
    ];

    public const BILLING_PERIOD_ALIGNMENTS = [
        'AlignToCharge',
        'AlignToSubscriptionStart',
        'AlignToTermStart',
    ];

    public const BILLING_TIMINGS = [
        'IN_ADVANCE',
        'IN_ARREARS',
    ];

    public const DISCOUNT_LEVELS = [
        'account',
        'rateplan',
        'subscription',
    ];

    public const END_DATE_CONDITIONS = [
        'Subscription_End',
        'Fixed_Period',
        'Specific_End_Date',
    ];

    public const LIST_PRICE_BASES = [
        'Per_Billing_Period',
        'Per_Month',
        'Per_Week',
    ];

    public const UNUSED_CREDITS = [
        'NoCredit',
        'CreditBySpecificRate',
    ];

    public const PRICE_CHANGES = [
        'NoChange',
        'SpecificPercentageValue',
        'UseLatestProductCatalogPricing',
    ];

    public const RATING_GROUPS = [
        'ByBillingPeriod',
        'ByUsageStartDate',
        'ByUsageRecord',
        'ByUsageUpload',
        'ByGroupId',
    ];

    public const TRIGGER_EVENTS = [
        'UCE',
        'USA',
        'UCA',
        'USD',
    ];

    public const UP_TO_PERIODS = [
        'Billing_Periods',
        'Days',
        'Weeks',
        'Months',
        'Years',
    ];

    public const WEEKLY_DAYS = [
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday',
    ];

    protected function extraValidation(array $values)
    {
        $ifThisThenThat = $this->fetchThisThenThat();

        $acceptable = [
            'applyDiscountTo'    => self::APPLY_DISCOUNTS_TO,
            'billCycleDay'       => range(1, 31),
            'billCycleType'      => self::BILL_CYCLES,
            'billingPeriod'      => self::BILLING_PERIODS,
            'billingPeriodAlignment' => self::BILLING_PERIOD_ALIGNMENTS,
            'billingTiming'      => self::BILLING_TIMINGS,
            'discountLevel'      => self::DISCOUNT_LEVELS,
            'endDateCondition'   => self::END_DATE_CONDITIONS,
            'listPriceBase'      => self::LIST_PRICE_BASES,
            'overageUnusedUnitsCreditOption' => self::UNUSED_CREDITS,
            'priceChangeOption'  => self::PRICE_CHANGES,
            'ratingGroup'        => self::RATING_GROUPS,
            'triggerEvent'       => self::TRIGGER_EVENTS,
            'upToPeriodsType'    => self::UP_TO_PERIODS,
            'weeklyBillCycleDay' => self::WEEKLY_DAYS,
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

        $ifThisThenThat('billCycleType', 'SpecificDayofMonth', 'billCycleDay');
        $ifThisThenThat('billCycleType', 'SpecificDayofWeek', 'weeklyBillCycleDay');
        $ifThisThenThat('priceChangeOption', 'SpecificPercentageValue', 'priceIncreasePercentage');
        $ifThisThenThat('specificBillingPeriod', 'SpecificPercentageValue', 'specificBillingPeriod');
        $ifThisThenThat('endDateCondition', 'Specific_End_Date', 'specificEndDate');
        $ifThisThenThat('overageUnusedUnitsCreditOption', 'CreditBySpecificRate', 'unusedUnitsCreditRates');
        $ifThisThenThat('endDateCondition', 'Fixed_Period', 'upToPeriods');
        $ifThisThenThat('endDateCondition', 'Fixed_Period', 'upToPeriodsType');

        if (!empty($value['priceIncreasePercentage'])) {
            $val = $value['priceIncreasePercentage'];
            if ($val < -100 || $val > 100) {
                throw new \RangeException("$self::\$priceIncreasePercentage must be between -100 and 100.");
            }
        }
    }
}
