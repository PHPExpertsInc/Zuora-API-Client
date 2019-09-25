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

use Carbon\Carbon;
use PHPExperts\DataTypeValidator\InvalidDataTypeException;
use PHPExperts\SimpleDTO\NestedDTO;
use PHPExperts\SimpleDTO\WriteOnce;
use PHPExperts\ZuoraClient\DTOs\Write\RatePlans\RatePlanDTO;

/**
 * Taken from https://www.zuora.com/developer/api-reference/#operation/POST_Subscription
 *
 * @property string             $accountKey   Customer account number or ID.
 * @property bool               $collect      Collects an automatic payment for a subscription. The collection
 *                                            generated in this operation is only for this subscription, not
 *                                            for the entire customer account.
 * @property bool               $runBilling   Creates an invoice for a subscription.
 * @property bool               $invoiceCollect
 * @property Carbon             $contractEffectiveDate
 * @property string             $termType
 * @property int                $renewalTerm
 * @property null|bool          $applyCreditBalance
 * @property null|bool          $autoRenew
 * @property null|Carbon        $customerAcceptanceDate
 * @property null|Carbon        $documentDate
 * @property null|int           $initialTerm
 * @property null|string        $initialTermPeriodType The default is monthly
 * @property null|string        $invoiceOwnerAccountKey
 * @property null|bool          $invoiceSeparately
 * @property null|Carbon        $invoiceTargetDate
 * @property null|string        $notes
 * @property null|string        $renewalSetting
 * @property null|string        $renewalTermPeriodType The default is monthly
 * @property null|Carbon        $serviceActivationDate
 * @property null|RatePlanDTO[] $subscribeToRatePlans
 * @property null|string        $subscriptionNumber
 * @property null|Carbon        $targetDate
 * @property null|Carbon        $termStartDate
 */
class SubscriptionDTO extends NestedDTO
{
    use WriteOnce;

    public const TERM_TYPE_TERMED = 'TERMED';
    public const TERM_TYPE_EVERGREEN = 'EVERGREEN';

    public const TERM_TYPES = [
        self::TERM_TYPE_TERMED,
        self::TERM_TYPE_EVERGREEN,
    ];

    public const TERM_PERIOD_DAY = 'Day';
    public const TERM_PERIOD_WEEK = 'Week';
    public const TERM_PERIOD_MONTH = 'Month';
    public const TERM_PERIOD_YEAR = 'Year';

    public const TERM_PERIODS = [
        self::TERM_PERIOD_DAY,
        self::TERM_PERIOD_WEEK,
        self::TERM_PERIOD_MONTH,
        self::TERM_PERIOD_YEAR,
    ];

    public const RENEW_WITH_SPECIFIC_TERM = 'RENEW_WITH_SPECIFIC_TERM';
    public const RENEW_TO_EVERGREEN = 'RENEW_TO_EVERGREEN';

    public const RENEWAL_TERMS = [
        self::RENEW_TO_EVERGREEN,
        self::RENEW_WITH_SPECIFIC_TERM,
    ];

    public function __construct(array $input = [])
    {
        $DTOs = [
            'subscribeToRatePlans' => SubscriptionDTO::class,
        ];

        $DTOs = array_intersect_key($input, $DTOs);
        
        $input['runBilling'] = $input['runBilling'] ?? true;

        if ($input['runBilling'])
        {
            $input['collect'] = $input['collect'] ?? true;
        }


        parent::__construct($input, $DTOs);
    }

    protected function extraValidation(array $values)
    {
        $acceptable = [
            'termType'              => self::TERM_TYPES,
            'initialTermPeriodType' => self::TERM_PERIODS,
            'renewalSetting'        => self::RENEWAL_TERMS,
            'renewalTermPeriodType' => self::TERM_PERIODS,
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
