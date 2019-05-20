<?php declare(strict_types=1);

namespace PHPExperts\ZuoraClient\DTOs\Response;

use PHPExperts\SimpleDTO\NestedDTO;
use PHPExperts\ZuoraClient\DTOs\Response\Account\BasicInfoDTO;
use PHPExperts\ZuoraClient\DTOs\Response\Account\BillingDTO;
use PHPExperts\ZuoraClient\DTOs\Response\Account\MetricsDTO;

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
