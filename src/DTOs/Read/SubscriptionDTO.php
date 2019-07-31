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

namespace PHPExperts\ZuoraClient\DTOs\Read;

use Carbon\Carbon;
use PHPExperts\SimpleDTO\NestedDTO;
use PHPExperts\ZuoraClient\DTOs\Read\RatePlans\RatePlanDTO;

/**
 * See https://www.zuora.com/developer/api-reference/#operation/GET_SubscriptionsByKey
 *
 * @property-read bool          $success
 * @property-read string        $id
 * @property-read string        $accountId
 * @property-read string        $accountNumber
 * @property-read string        $accountName
 * @property-read string        $orderNumber
 * @property-read string        $invoiceOwnerAccountId
 * @property-read string        $invoiceOwnerAccountName
 * @property-read string        $invoiceOwnerAccountNumber
 * @property-read string        $subscriptionNumber
 * @property-read string        $termType
 * @property-read bool          $invoiceSeparately
 * @property-read Carbon        $contractEffectiveDate
 * @property-read Carbon        $serviceActivationDate
 * @property-read Carbon        $customerAcceptanceDate
 * @property-read Carbon        $subscriptionStartDate
 * @property-read Carbon        $termStartDate
 * @property-read Carbon        $termEndDate
 * @property-read int           $initialTerm
 * @property-read string        $initialTermPeriodType The default is monthly
 * @property-read int           $currentTerm
 * @property-read string        $currentTermPeriodType
 * @property-read bool          $autoRenew
 * @property-read string        $renewalSetting
 * @property-read int           $renewalTerm
 * @property-read string        $renewalTermPeriodType
 * @property-read float         $contractedMrr Monthly recurring revenue of the subscription.
 * @property-read float         $totalContractedValue
 * @property-read string        $notes A string of up to 65,535 characters.
 * @property-read string        $status
 * @property-read RatePlanDTO[] $ratePlans
 */
class SubscriptionDTO extends NestedDTO
{
    public function __construct(array $input)
    {
        $DTOs = [
            'ratePlans' => RatePlanDTO::class,
        ];

        parent::__construct($input, $DTOs);
    }
}
