<?php declare(strict_types=1);

namespace PHPExperts\ZuoraClient\DTOs\Write;

use PHPExperts\SimpleDTO\SimpleDTO;
use PHPExperts\SimpleDTO\WriteOnce;

/**
 * @property string $AccountId
 * @property string $Address1
 * @property string $Address2
 * @property string $City
 * @property string $County
 * @property string $Country
 * @property string $Fax
 * @property string $FirstName
 * @property string $HomePhone
 * @property string $LastName
 * @property string $MobilePhone
 * @property string $NickName
 * @property string $OtherPhone
 * @property string $OtherPhoneType
 * @property string $PersonalEmail
 * @property string $PostalCode
 * @property string $State
 * @property string $TaxRegion
 * @property string $WorkEmail
 * @property string $WorkPhone
 */
class ContactDTO extends SimpleDTO
{
    use WriteOnce;
}
