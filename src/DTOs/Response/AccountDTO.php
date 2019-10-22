<?php declare(strict_types=1);


namespace PHPExperts\ZuoraClient\DTOs\Response;

use PHPExperts\SimpleDTO\SimpleDTO;
use Carbon\Carbon;
use PHPExperts\DataTypeValidator\DataTypeValidator;
use PHPExperts\DataTypeValidator\IsAFuzzyDataType;

/**
 * See https://www.zuora.com/developer/api-reference/#operation/Object_GETAccount
 *
 * @property null|string $AccountNumber
 * @property null|string $AdditionalEmailAddresses
 * @property bool        $AllowInvoiceEdit
 * @property bool        $AutoPay
 * @property null|float  $Balance
 * @property null|string $Batch
 * @property null|string $BcdSettingOption
 * @property int         $BillCycleDay
 * @property null|string $BillToId
 * @property null|string $CommunicationProfileId
 * @property null|string $CreatedById
 * @property Carbon      $CreatedDate
 * @property null|float  $CreditBalance
 * @property null|string $CrmId
 * @property null|string $Currency
 * @property null|string $CustomerServiceRepName
 * @property null|string $DefaultPaymentMethodId
 * @property null|string $Id
 * @property bool        $InvoiceDeliveryPrefsEmail
 * @property bool        $InvoiceDeliveryPrefsPrint
 * @property null|string $InvoiceTemplateId
 * @property null|string $LastInvoiceDate
 * @property null|string $Name
 * @property null|string $Notes
 * @property null|string $ParentId
 * @property null|string $PaymentGateway
 * @property null|string $PaymentTerm
 * @property null|string $PurchaseOrderNumber
 * @property null|string $SalesRepName
 * @property null|string $SoldToId
 * @property null|string $Status
 * @property null|float  $TotalInvoiceBalance
 * @property null|string $UpdatedById
 * @property Carbon      $UpdatedDate
 * @property null|string $OriginalFacility__c
 * @property null|string $PolicyReasonForCancellation__c
 * @property null|string $Region__c
 * @property null|string $LateEmailPaymentDate__c
 * @property null|string $LateEmailTemplate__c
 * @property null|string $AccountType__c
 * @property null|string $AccountSource__c
 * @property null|string $MemberNumber__c
 * @property null|string $ReportingStatus__c
 * @property null|string $PreviousAutoPayStatus__c
 *
 */

class AccountDTO extends SimpleDTO
{
    public function __construct(array $input = [], array $options = [self::PERMISSIVE], DataTypeValidator $validator = null)
    {
        if (!$validator) {
            $validator = new DataTypeValidator(new IsAFuzzyDataType());
        }

        parent::__construct($input, $options, $validator);
    }
}