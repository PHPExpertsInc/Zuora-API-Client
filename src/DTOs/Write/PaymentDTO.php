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

use PHPExperts\SimpleDTO\NestedDTO;

/**
 * See https://www.zuora.com/developer/api-reference/#operation/POST_CreatePayment
 *
 * @property float               $amount
 * @property string              $type
 * @property null|string         $accountId
 * @property null|string         $bankIdentificationNumber
 * @property null|string         $comment
 * @property null|string         $currency
 * @property null|DebitMemoDTO[] $debitMemos
 * @property null|FinanceInfoDTO $financeInformation
 * @property null|string         $gatewayId
 * @property null|InvoiceDTO[]   $invoices
 * @property null|string         $paymentMethodId
 * @property null|string         $referenceId
 */
class PaymentDTO extends NestedDTO
{
    public function __construct(array $input)
    {
        $DTOs = [
            'debitMemos'         => DebitMemoDTO::class,
            'financeInformation' => FinanceInfoDTO::class,
            'invoices'           => InvoiceDTO::class,
        ];

        $DTOs = array_intersect_key($input, $DTOs);

        parent::__construct($input, $DTOs);
    }
}
