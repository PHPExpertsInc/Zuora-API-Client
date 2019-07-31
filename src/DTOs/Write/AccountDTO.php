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
use PHPExperts\SimpleDTO\NestedDTO;
use PHPExperts\SimpleDTO\SimpleDTO;
use PHPExperts\SimpleDTO\WriteOnce;

/**
 * See https://www.zuora.com/developer/api-reference/#operation/POST_Account
 *
 * Required:
 * @property ContactDTO $billToContact
 * @property string     $currency
 * @property string     $name
 *
 * Optional:
 * @property null|string          $accountNumber
 * @property null|array           $additionalEmailAddresses
 * @property null|bool            $applyCreditBalance
 * @property null|bool            $autoPay
 * @property null|string          $batch
 * @property null|int             $billCycleDay
 * @property null|bool            $collect
 * @property null|string          $communicationProfileId
 * @property null|CreditCardDTO   $creditCard
 * @property null|string          $creditMemoTemplateId
 * @property null|string          $crmId
 * @property null|string          $debitMemoTemplateId
 * @property null|Carbon          $documentDate
 * @property null|string          $hpmCreditCardPaymentMethodId
 * @property null|bool            $invoice
 * @property null|bool            $invoiceCollect
 * @property null|bool            $invoiceDeliveryPrefsEmail
 * @property null|bool            $invoiceDeliveryPrefsPrint
 * @property null|string          $invoiceTargetDate
 * @property null|string          $invoiceTemplateId
 * @property null|string          $notes
 * @property null|string          $parentId
 * @property null|string          $paymentGateway
 * @property null|string          $paymentTerm
 * @property null|bool            $runBilling
 * @property null|string          $salesRep
 * @property null|string          $sequenceSetId
 * @property null|ContactDTO      $soldToContact
 * @property null|bool            $soldToSameAsBillTo
 * @property null|SubscriptionDTO $subscription
 * @property null|string          $tagging
 * @property null|Carbon          $targetDate
 * @property null|TaxInfoDTO      $taxInfo
 */
class AccountDTO extends NestedDTO
{
    use WriteOnce;

    protected $autoPay = false;

    public function __construct(array $input = [])
    {
        $DTOs = [
            'billToContact' => ContactDTO::class,
            'soldToContact' => ContactDTO::class,
            'creditCard'    => CreditCardDTO::class,
            'subscription'  => SubscriptionDTO::class,
            'taxInfo'       => TaxInfoDTO::class,
        ];

        $DTOs = array_intersect_key($DTOs, $input);

        parent::__construct($input, $DTOs, [SimpleDTO::ALLOW_EXTRA]);
    }
}
