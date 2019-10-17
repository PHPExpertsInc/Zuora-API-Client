<?php declare(strict_types=1);


namespace PHPExperts\ZuoraClient\DTOs\Response;

use PHPExperts\SimpleDTO\SimpleDTO;
use Carbon\Carbon;

/**
 * See https://www.zuora.com/developer/api-reference/#operation/Object_GETAccount
 *
 *
 * @property string          $AccountNumber
 * @property null|string     $AdditionalEmailAddresses
 * @property bool            $AllowInvoiceEdit
 * @property bool            $AutoPay
 * @property float           $Balance
 * @property string          $Batch
 * @property string          $BcdSettingOption
 * @property int             $BillCycleDay
 * @property string          $BillToId
 * @property string          $CommunicationProfileId
 * @property string          $CreatedById
 * @property Carbon          $CreatedDate
 * @property float           $CreditBalance
 * @property string          $CrmId
 * @property string          $Currency
 * @property string          $CustomerServiceRepName
 * @property string          $DefaultPaymentMethodId
 * @property string          $Id
 * @property bool            $InvoiceDeliveryPrefsEmail
 * @property bool            $InvoiceDeliveryPrefsPrint
 * @property string          $InvoiceTemplateId
 * @property string          $LastInvoiceDate
 * @property string          $Name
 * @property null|string     $Notes
 * @property string          $ParentId
 * @property null|string     $PaymentGateway
 * @property string          $PaymentTerm
 * @property null|string     $PurchaseOrderNumber
 * @property string          $SalesRepName
 * @property string          $SoldToId
 * @property string          $Status
 * @property float           $TotalInvoiceBalance
 * @property string          $UpdatedById
 * @property Carbon          $UpdatedDate
 * @property string          $OriginalFacility__c
 * @property string          $PolicyReasonForCancellation__c
 * @property string          $Region__c
 * @property string          $LateEmailPaymentDate__c
 * @property string          $AccountType__c
 * @property string          $AccountSource__c
 * @property string          $MemberNumber__c
 * @property string          $ReportingStatus__c
 * @property string          $PreviousAutoPayStatus__c
 *
 */

class AccountDTO extends SimpleDTO
{

}