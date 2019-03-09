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

namespace PHPExperts\ZuoraClient\Managers;

class Account extends Manager
{
    public function fetch(string $zuoraGUID)
    {
        $response = $this->api->get('v1/accounts/' . $zuoraGUID, [
            // @FIXME: This needs to be abstracted up into RESTSpeaker.
            'headers' => $this->api->auth->generateAuthHeaders(),
        ]);
        dd($response);
    }
}
