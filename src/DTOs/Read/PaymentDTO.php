<?php declare(strict_types=1);

namespace PHPExperts\ZuoraClient\DTOs\Read;

use Carbon\Carbon;
use PHPExperts\SimpleDTO\NestedDTO;

/**
 * See https://www.zuora.com/developer/api-reference/#operation/GET_Payment
 *
 * @property string         $id
 * @property string         $accountId
 * @property float          $amount
 * @property float          $appliedAmount
 * @property string         $authTransactionId
 * @property string         $bankIdentificationNumber
 * @property string         $comment
 * @property float          $creditBalanceAmount
 * @property string         $currency
 * @property FinanceInfoDTO $financeInformation
 * @property string         $gatewayId
 * @property string         $gatewayOrderId
 * @property string         $gatewayResponse
 * @property string         $gatewayResponseCode
 * @property string         $gatewayState
 * @property string         $number
 * @property string         $paymentMethodId
 * @property string         $paymentMethodSnapshotId
 * @property string         $referenceId
 * @property float          $refundAmount
 * @property string         $secondPaymentReferenceId
 * @property string         $softDescriptor
 * @property string         $softDescriptorPhone
 * @property string         $status
 * @property string         $type
 * @property float          $unappliedAmount
 * @property string         $createdById
 * @property string         $updatedById
 * @property Carbon         $createdDate
 * @property Carbon         $submittedOn
 * @property Carbon         $effectiveDate
 * @property Carbon         $settledOn
 * @property Carbon         $cancelledOn
 * @property bool           $success
 */
class PaymentDTO extends NestedDTO
{
    public function __construct(array $input)
    {
        $DTOs = [
            'financeInformation' => FinanceInfoDTO::class,
        ];

        parent::__construct($input, $DTOs);
    }
}
