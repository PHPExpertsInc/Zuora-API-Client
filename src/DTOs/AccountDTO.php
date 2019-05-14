<?php declare(strict_types=1);

namespace PHPExperts\ZuoraClient\DTOs;

use PHPExperts\SimpleDTO\SimpleDTO;

/**
 * See https://www.zuora.com/developer/api-reference/#operation/POST_Account
 *
 * Required:
 * @property ContactDTO $billToContact
 * @property string $currency
 * @property string $name
 *
 * Optional:
 * @property ?string $accountNumber
 * @property ?array      $additionalEmailAddresses
 * @property ?bool $applyCreditBalance
 * @property ?bool       $autoPay
 * @property ?string $batch
 * @property ?int        $billCycleDay
 * @property ?bool $collect
 * @property ?string $communicationProfileId
 * @property ?CreditCardDTO $creditCard
 * @property ?string $creditMemoTemplateId
 * @property ?string $crmId
 * @property ?string $debitMemoTemplateId
 * @property ?Carbon $documentDate
 * @property ?string $hpmCreditCardPaymentMethodId
 * @property ?bool   $invoice
 * @property ?bool   $invoiceCollect
 * @property ?bool   $invoiceDeliveryPrefsEmail
 * @property ?bool   $invoiceDeliveryPrefsPrint
 * @property ?string $invoiceTargetDate
 * @property ?string $invoiceTemplateId
 * @property ?string $notes
 * @property ?string $parentId
 * @property ?string $paymentGateway
 * @property ?string $paymentTerm
 * @property ?bool   $runBilling
 * @property ?string $salesRep
 * @property ?string $sequenceSetId
 * @property ?ContactDTO $soldToContact
 * @property ?bool   $soldToSameAsBillTo
 * @property ?SubscriptionDTO $subscription
 * @property ?string $tagging
 * @property ?Carbon $targetDate
 * @property ?TaxInfoDTO $taxInfo
 */
class AccountDTO extends SimpleDTO
{
}
