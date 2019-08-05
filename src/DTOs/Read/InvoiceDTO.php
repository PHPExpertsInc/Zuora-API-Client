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

namespace PHPExperts\ZuoraClient\DTOs\Read;

use Carbon\Carbon;
use PHPExperts\SimpleDTO\NestedDTO;

/**
 * See https://www.zuora.com/developer/api-reference/#operation/GET_TransactionInvoice
 *
 * @property string           $id
 * @property string           $accountId
 * @property string           $accountNumber
 * @property string           $accountName
 * @property Carbon           $invoiceDate
 * @property string           $invoiceNumber
 * @property Carbon           $dueDate
 * @property Carbon           $invoiceTargetDate
 * @property float            $amount
 * @property float            $balance
 * @property float            $creditBalanceAdjustmentAmount
 * @property string           $createdBy
 * @property string           $status
 * @property null|bool        $reversed
 * @property string           $body
 * @property InvoiceItemDTO[] $invoiceItems
 * @property InvoiceFileDTO[] $invoiceFiles
 */
class InvoiceDTO extends NestedDTO
{
    public function __construct(array $input)
    {
        $DTOs = [
            'invoiceItems' => InvoiceItemDTO::class,
            'invoiceFiles' => InvoiceFileDTO::class,
        ];

        // Sometimes, invoices are created with any invoice files.
        if (empty($input['invoiceFiles'])) {
            unset($DTOs['invoiceFiles']);
        }

        parent::__construct($input, $DTOs);
    }
}
