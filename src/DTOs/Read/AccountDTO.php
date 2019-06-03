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

use PHPExperts\SimpleDTO\NestedDTO;
use PHPExperts\ZuoraClient\DTOs\Read\Account\BasicInfoDTO;
use PHPExperts\ZuoraClient\DTOs\Read\Account\BillingDTO;
use PHPExperts\ZuoraClient\DTOs\Read\Account\MetricsDTO;

/**
 * See https://www.zuora.com/developer/api-reference/#operation/GET_Account
 *
 * @property BasicInfoDTO $basicInfo
 * @property BillingDTO   $billingAndPayment
 * @property MetricsDTO   $metrics
 * @property ContactDTO   $billToContact
 * @property ContactDTO   $soldToContact
 * @property bool         $success
 */
class AccountDTO extends NestedDTO
{
    public function __construct(array $input)
    {
        $DTOs = [
            'basicInfo'         => BasicInfoDTO::class,
            'billingAndPayment' => BillingDTO::class,
            'metrics'           => MetricsDTO::class,
            'billToContact'     => ContactDTO::class,
            'soldToContact'     => ContactDTO::class,
        ];

        parent::__construct($input, $DTOs);
    }
}
