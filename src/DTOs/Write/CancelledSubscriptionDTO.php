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
use PHPExperts\SimpleDTO\SimpleDTO;
use PHPExperts\SimpleDTO\WriteOnce;

/**
 * Taken from https://www.zuora.com/developer/api-reference/#operation/PUT_CancelSubscription
 *
 * @property string      $accountKey   Customer account number or ID.
 * @property bool        $collect      Collects an automatic payment for a subscription. The collection
 *                                     generated in this operation is only for this subscription, not
 *                                     for the entire customer account.
 * @property bool        $runBilling   Creates an invoice for a subscription.
 * @property bool        $invoiceCollect
 * @property string      $cancellationPolicy
 * @property Carbon      $cancellationEffectiveDate
 * @property null|Carbon $documentDate
 * @property null|Carbon $invoiceTargetDate
 * @property null|Carbon $targetDate
 */
class CancelledSubscriptionDTO extends SimpleDTO
{
    use WriteOnce;

    public const TERM_TYPE_TERMED    = 'TERMED';
    public const TERM_TYPE_EVERGREEN = 'EVERGREEN';

    public const TERM_TYPES = [
        self::TERM_TYPE_TERMED,
        self::TERM_TYPE_EVERGREEN,
    ];

    public const TERM_PERIOD_DAY   = 'Day';
    public const TERM_PERIOD_WEEK  = 'Week';
    public const TERM_PERIOD_MONTH = 'Month';
    public const TERM_PERIOD_YEAR  = 'Year';

    public const TERM_PERIODS = [
        self::TERM_PERIOD_DAY,
        self::TERM_PERIOD_WEEK,
        self::TERM_PERIOD_MONTH,
        self::TERM_PERIOD_YEAR,
    ];

    public const RENEW_WITH_SPECIFIC_TERM = 'RENEW_WITH_SPECIFIC_TERM';
    public const RENEW_TO_EVERGREEN       = 'RENEW_TO_EVERGREEN';

    public const RENEWAL_TERMS = [
        self::RENEW_TO_EVERGREEN,
        self::RENEW_WITH_SPECIFIC_TERM,
    ];

    /** @var bool */
    protected $collect = true;

    /** @var bool */
    protected $runBilling = true;

    protected function extraValidation(array $values)
    {
        $acceptable = [
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
