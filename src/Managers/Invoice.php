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

use InvalidArgumentException;
use PHPExperts\DataTypeValidator\InvalidDataTypeException;
use PHPExperts\ZuoraClient\DTOs\Response;

class Invoice extends Manager
{
    public function fetch(): Response\InvoiceDTO
    {
        $this->assertHasId();
        $response = $this->api->get('v1/object/invoice/' . $this->id);

        if (!$response || !property_exists($response, 'Id')) {
            throw new InvalidArgumentException("Could not find an invoice with the ID '{$this->id}'.");
        }

        try {
            return new Response\InvoiceDTO((array) $response);
        }
        catch (InvalidDataTypeException $e) {
            $response->Body = substr($response->Body, 0, 15);
            dd([
                $response,
                $e->getReasons()
            ]);
        }
    }
}
