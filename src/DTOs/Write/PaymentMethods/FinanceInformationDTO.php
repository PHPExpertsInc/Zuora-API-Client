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

namespace PHPExperts\ZuoraClient\DTOs\Write\PaymentMethods;

use PHPExperts\SimpleDTO\SimpleDTO;
use PHPExperts\SimpleDTO\WriteOnce;

/**
 * Taken from https://www.zuora.com/developer/api-reference/#operation/POST_PaymentMethods
 *
 * The accounting code that maps to a bank account in your accounting system.
 * @property null|string $bankAccountAccountingCode
 *
 * Whether the payment was transferred to an external accounting system.
 * Use this field for integration with accounting systems, such as NetSuite.
 * @property null|string $transferredToAccount
 *
 * The accounting code for the unapplied payment.
 * @property null|string $unappliedPaymentAccountingCode
 */
class FinanceInformationDTO extends SimpleDTO
{
    use WriteOnce;
}
