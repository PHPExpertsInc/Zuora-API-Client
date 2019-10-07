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

namespace PHPExperts\ZuoraClient\DTOs\Response;

use Carbon\Carbon;
use PHPExperts\SimpleDTO\SimpleDTO;

/**
 * See https://www.zuora.com/developer/api-reference/#operation/Object_GETPaymentMethod
 *
 * @property-read string  $Id
 * @property-read string  $AccountId
 * @property-read string  $Type
 * @property-read bool    $Active
 * @property-read string  $PaymentMethodStatus
 * @property-read string  $CreditCardHolderName
 * @property-read bool    $IsCompany
 * @property-read string  $CreditCardType
 * @property-read string  $CreditCardMaskNumber
 * @property-read int     $CreditCardExpirationMonth
 * @property-read int     $CreditCardExpirationYear
 * @property-read string  $BankIdentificationNumber
 * @property-read ?Carbon $LastTransactionDateTime
 * @property-read ?string $LastTransactionStatus
 * @property-read int     $NumConsecutiveFailures
 * @property-read int     $TotalNumberOfProcessedPayments
 * @property-read int     $TotalNumberOfErrorPayments
 * @property-read bool    $UseDefaultRetryRule
 * @property-read string  $CreatedById
 * @property-read Carbon  $CreatedDate
 * @property-read string  $UpdatedById
 * @property-read Carbon  $UpdatedDate
 */
class DetailedCreditCardDTO extends SimpleDTO
{
}
