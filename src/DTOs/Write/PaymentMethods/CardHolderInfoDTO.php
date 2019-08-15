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

namespace PHPExperts\ZuoraClient\DTOs\Write\PaymentMethods;

use PHPExperts\SimpleDTO\SimpleDTO;
use PHPExperts\SimpleDTO\WriteOnce;

/**
 * Taken from https://www.zuora.com/developer/api-reference/#operation/POST_PaymentMethods
 *
 * @property string      $cardHolderName
 * @property null|string $addressLine1
 * @property null|string $addressLine2
 * @property null|string $city
 * @property null|string $state
 * @property null|string $zipCode
 * @property null|string $country
 * @property null|string $pemail
 * @property null|string $phone
 */
class CardHolderInfoDTO extends SimpleDTO
{
    use WriteOnce;
}
