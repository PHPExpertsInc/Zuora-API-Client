<?php declare(strict_types=1);

namespace PHPExperts\ZuoraClient\DTOs\Response\Account;

use PHPExperts\SimpleDTO\SimpleDTO;

/**
 * See https://www.zuora.com/developer/api-reference/#operation/GET_Account
 *
 * @property int    $billCycleDay
 * @property string $currency
 * @property string $paymentTerm
 * @property string $paymentGateway
 * @property bool   $invoiceDeliveryPrefsPrint
 * @property bool   $invoiceDeliveryPrefsEmail
 * @property array  $additionalEmailAddresses
 */
class BillingDTO extends SimpleDTO
{
}
