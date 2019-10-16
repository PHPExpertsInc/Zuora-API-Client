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

namespace PHPExperts\ZuoraClient\DTOs\Write\Account;

use PHPExperts\SimpleDTO\NestedDTO;
use PHPExperts\SimpleDTO\WriteOnce;
use PHPExperts\ZuoraClient\DTOs\Write\ContactDTO;

/**
 * https://www.zuora.com/developer/api-reference/#operation/POST_PreviewSubscription
 *
 * @property int        $billCycleDay
 * @property ContactDTO $billToContact
 * @property string     $currency
 */
class PreviewAccountDTO extends NestedDTO
{
    use WriteOnce;

    public function __construct(array $input = [])
    {
        $DTOs = [
            'billToContact' => ContactDTO::class,
        ];

        parent::__construct($input, $DTOs);
    }
}
