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

use PHPExperts\DataTypeValidator\DataTypeValidator;
use PHPExperts\SimpleDTO\SimpleDTO;
use PHPExperts\SimpleDTO\WriteOnce;

/**
 * https://www.zuora.com/developer/api-reference/#operation/POST_CreatePayment
 *
 * @property float       $amount
 * @property null|string $invoiceItemId
 * @property null|string $taxItemId
 */
class InvoiceItemsDTO extends SimpleDTO
{
    use WriteOnce;

    public function __construct(array $input = [], array $options = [], DataTypeValidator $validator = null)
    {
        parent::__construct($input, $options, $validator);
    }
}
