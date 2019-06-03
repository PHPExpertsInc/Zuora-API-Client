<?php declare(strict_types=1);

namespace PHPExperts\ZuoraClient\DTOs\Write;

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
 */
class ContactDTO extends SimpleDTO
{
    use WriteOnce;

    public function __construct(array $input = [])
    {
        parent::__construct($input);
    }
}
