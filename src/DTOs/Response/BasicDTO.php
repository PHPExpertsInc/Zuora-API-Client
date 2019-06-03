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

use PHPExperts\DataTypeValidator\DataTypeValidator;
use PHPExperts\SimpleDTO\SimpleDTO;

/**
 * @property bool   $success
 * @property string $id
 */
class BasicDTO extends SimpleDTO
{
    public function __construct(array $input, array $options = [], DataTypeValidator $validator = null)
    {
        // This API route is divergent and returns Id instead of id.
        foreach ($input as $key => $val) {
            unset($input[$key]);
            $input[lcfirst($key)] = $val;
        }

        parent::__construct($input);
    }
}
