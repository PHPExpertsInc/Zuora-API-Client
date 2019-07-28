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

use PHPExperts\ZuoraClient\DTOs\Read;
use PHPExperts\ZuoraClient\DTOs\Response;
use PHPExperts\ZuoraClient\DTOs\Write;
use PHPExperts\ZuoraClient\Exceptions\ResourceNotFoundException;

class Contact extends Manager
{
    public function fetch(): Read\ContactDTO
    {
        $response = $this->api->get('v1/object/contact/' . $this->id);
        if ($response instanceof \GuzzleHttp\Psr7\Response) {
            dump((string) $response->getBody());
        }

        if (property_exists($response, 'size') && $response->size === 0) {
            throw new ResourceNotFoundException();
        }

        return new Read\ContactDTO((array) $response);
    }

    public function store(Write\ContactDTO $contactDTO): Response\BasicDTO
    {
        $response = $this->api->post('v1/object/contact/', [
            'json' => $this->capitalizeKeys($contactDTO->toArray())
        ]);

        $response = $this->processResponse($response);

        return new Response\BasicDTO((array) $response);
    }

    public function update(Write\ContactDTO $contactDTO): Response\BasicDTO
    {
        $this->assertHasId();
        $response = $this->api->put('v1/object/contact/' . $this->id, [
            'json' => $this->capitalizeKeys($contactDTO->toArray()),
        ]);

        $response = $this->processResponse($response);

        return new Response\BasicDTO((array) $response);
    }

    public function destroy(string $uri = ''): bool
    {
        return parent::destroy('v1/object/contact/');
    }

    protected function capitalizeKeys(array $input): array
    {
        $output = [];
        foreach ($input as $key => $val) {
            $output[ucfirst($key)] = $val;
        }

        return $output;
    }
}
