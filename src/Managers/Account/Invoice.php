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

namespace PHPExperts\ZuoraClient\Managers\Account;

use InvalidArgumentException;
use PHPExperts\DataTypeValidator\InvalidDataTypeException;
use PHPExperts\ZuoraClient\DTOs\Read;
use PHPExperts\ZuoraClient\Exceptions\ZuoraAPIException;
use PHPExperts\ZuoraClient\Managers\Manager;

class Invoice extends Manager
{
    public function fetch(): Read\InvoicesDTO
    {
        $this->assertHasId();
        $zuoraGUID = $this->id;
        $response = $this->api->get('v1/transactions/invoices/accounts/' . $zuoraGUID);
//        dd(json_encode($response));

//        $json = <<<JSON
//JSON;
//        $response = json_decode($json);

        if ($response && $response->success === false) {
            throw new InvalidArgumentException("Could not find any invoices for Zuora ID '$zuoraGUID'.");
        }

        if (!$response || !property_exists($response, 'invoices')) {
            throw new ZuoraAPIException('Malformed Zuora API call.');
        }

        try {
            return new Read\InvoicesDTO((array) $response);
        } catch (InvalidDataTypeException $e) {
            dd($e->getReasons());
        }
    }
}
