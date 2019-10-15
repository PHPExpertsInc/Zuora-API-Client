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

use PHPExperts\DataTypeValidator\InvalidDataTypeException;
use PHPExperts\ZuoraClient\DTOs\Read;
use PHPExperts\ZuoraClient\Helpers\Cachable;

class PaymentGateway extends Manager
{
    use Cachable;

    public function all(): Read\PaymentGatewaysDTO
    {
        $this->setCachedDTOClass(Read\PaymentGatewaysDTO::class);
        // Cache for four hours.
        /** @var Read\PaymentGatewaysDTO|null $dto */
        $dto = $this->fetchCache(60 * 4);

        if (!$dto) {
            $response = $this->api->get('v1/paymentgateways');
            $response = $this->processResponse($response, 'Creating a Payment Method');

            $dto = new Read\PaymentGatewaysDTO((array) $response);
            $this->cache($dto);
        }

        return $dto;
    }
}
