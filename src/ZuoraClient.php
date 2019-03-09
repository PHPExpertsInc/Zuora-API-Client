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

namespace PHPExperts\ZuoraClient;

use PHPExperts\RESTSpeaker\RestAuth;
use PHPExperts\ZuoraClient\Managers\Account;

class ZuoraClient
{
    /** @var RestAuth */
    protected $auth;

    /** === Managers (See: Composition Architectural Pattern) === */

    /** @var Account */
    public $account;

    public function __construct(RestAuth $auth, string $baseURI)
    {
        $this->auth = $auth;

        $this->account = app()->make(Account::class, [
            'auth'    => $auth,
            'baseURI' => $baseURI,
        ]);
    }
}