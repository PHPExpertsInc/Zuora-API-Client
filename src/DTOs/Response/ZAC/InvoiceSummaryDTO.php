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

namespace PHPExperts\ZuoraClient\DTOs\Response\ZAC;

use PHPExperts\DataTypeValidator\DataTypeValidator;
use PHPExperts\DataTypeValidator\IsAFuzzyDataType;
use PHPExperts\SimpleDTO\SimpleDTO;

/**
 * This is an extended DTO provided by the Zuora PHP API Client project.
 *
 * @property string $id
 * @property string $number
 * @property string $accountId
 * @property string $accountName
 * @property string $status
 * @property string $invoiceDate
 * @property string $dueDate
 * @property string $renewDate
 * @property float  $amount
 * @property float  $balance
 * @property float  $creditBalance
 */
class InvoiceSummaryDTO extends SimpleDTO
{
    public function __construct(array $input, array $options = [self::PERMISSIVE], DataTypeValidator $validator = null)
    {
        if (!$validator) {
            $validator = new DataTypeValidator(new IsAFuzzyDataType());
        }

        parent::__construct($input, $options, $validator);
    }
}
