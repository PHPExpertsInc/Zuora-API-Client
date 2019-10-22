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
 * @property string      $firstName
 * @property string      $lastName
 * @property string      $country
 * @property null|string $accountId
 * @property null|string $address1
 * @property null|string $address2
 * @property null|string $city
 * @property null|string $county
 * @property null|string $fax
 * @property null|string $homePhone
 * @property null|string $mobilePhone
 * @property null|string $nickName
 * @property null|string $otherPhone
 * @property null|string $otherPhoneType
 * @property null|string $personalEmail
 * @property null|string $postalCode
 * @property null|string $state
 * @property null|string $taxRegion
 * @property null|string $workEmail
 * @property null|string $workPhone
 * @property null|string $zipCode Some routes take postalCode :-/
 */
class ContactDTO extends SimpleDTO
{
    use WriteOnce;

    public function __construct(array $input = [], array $options = null, DataTypeValidator $validator = null)
    {
        parent::__construct($input, $options ?? [self::PERMISSIVE, self::ALLOW_EXTRA], $validator);
    }
}
