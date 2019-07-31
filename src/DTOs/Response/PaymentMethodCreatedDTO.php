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

use PHPExperts\SimpleDTO\SimpleDTO;

/**
 * @property-read string        $id        The Internal ID of the payment method that was created.
 * @property-read bool          $success   Indicates whether the call succeeded.
 * @property-read null|string[] $reasons   The reasons why creating the payment method failed.
 * @property-read string        $processId The ID of the process that handle the operation.
 */
class PaymentMethodCreatedDTO extends SimpleDTO
{
}
