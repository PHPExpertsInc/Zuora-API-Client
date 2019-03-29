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

use PHPExperts\RESTSpeaker\RESTAuth;
use PHPExperts\RESTSpeaker\RESTSpeaker;
use PHPExperts\ZuoraClient\Managers\Account;

final class ZuoraClient
{
    /** @var RESTSpeaker */
    protected $api;

    /** === Managers (See: Composition Architectural Pattern) === */

    /** @var Account */
    public $account;

    public function __construct(RESTAuth $authStrat, string $baseURI, RESTSpeaker $apiClient = null)
    {
        if (!$apiClient) {
            $apiClient = new RESTSpeaker($authStrat, $baseURI);
        }

        $this->api = $apiClient;

        // @todo: This should *probably* be done via Dependency Injection :-/
        // @todo: Maybe add a light container later that proxies to Laravel's, if present?
        $this->account = new Account($this, $apiClient);
    }

    public function getApiClient(): RESTSpeaker
    {
        return $this->api;
    }
}
