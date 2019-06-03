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
use PHPExperts\DataTypeValidator\DataTypeValidator;
use PHPExperts\DataTypeValidator\InvalidDataTypeException;
use PHPExperts\SimpleDTO\SimpleDTO;

/**
 * @property string $accountId
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $county
 * @property string $country
 * @property string $fax
 * @property string $firstName
 * @property string $homePhone
 * @property string $id
 * @property string $lastName
 * @property string $mobilePhone
 * @property string $nickName
 * @property string $otherPhone
 * @property string $otherPhoneType
 * @property string $personalEmail
 * @property string $postalCode
 * @property string $state
 * @property string $taxRegion
 * @property string $createdById
 * @property Carbon $createdDate
 * @property string $updatedById
 * @property Carbon $updatedDate
 * @property string $workEmail
 * @property string $workPhone
 */
class ContactDTO extends SimpleDTO
{
    public function __construct(array $input, array $options = null, DataTypeValidator $validator = null)
    {
        // This API route is divergent and returns Id instead of id.
        foreach ($input as $key => $val) {
            unset($input[$key]);
            $input[lcfirst($key)] = $val;
        }

        try {
            parent::__construct($input, $options ?? [SimpleDTO::ALLOW_NULL], $validator);

        } catch (InvalidDataTypeException $e) {
            dd($e->getReasons());
        }
    }
}
