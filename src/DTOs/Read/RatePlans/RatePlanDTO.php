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

use PHPExperts\SimpleDTO\NestedDTO;

/**
 * See https://www.zuora.com/developer/api-reference/#operation/GET_SubscriptionsByKey
 *
 * @property-read string              $id
 * @property-read string              $productId
 * @property-read string              $productName
 * @property-read string              $productSku
 * @property-read string              $productRatePlanId
 * @property-read string              $ratePlanName
 * @property-read RatePlanChargeDTO[] $ratePlanCharges
 * @property-read ProductFeatureDTO[] $subscriptionProductFeatures
 * @property-read string              $lastChangeType The last amendment on the rate plan.
 */
class RatePlanDTO extends NestedDTO
{
    public function __construct(array $input)
    {
        $DTOs = [
            'ratePlanCharges'             => RatePlanChargeDTO::class,
            'subscriptionProductFeatures' => ProductFeatureDTO::class,
        ];

        if (empty($input['subscriptionProductFeatures'])) {
            unset($DTOs['subscriptionProductFeatures']);
        }

        parent::__construct($input, $DTOs);
    }
}
