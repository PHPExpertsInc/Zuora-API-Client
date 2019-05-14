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

use PHPExperts\ZuoraClient\DTOs\ContactDTO;

class Contact extends Manager
{
    public function fetch(string $contactId)
    {
        $response = $this->api->get('v1/object/contact/' . $contactId);

        return $response;
    }

    public function store(string $contactId, array $fields)
    {
        $response = $this->api->post('v1/contacts/' . $contactId, [
            'json' => $fields,
        ]);

        return $this->processResponse($response);
    }

    public function update(string $contactId, ContactDTO $contactDTO)
    {
        $response = $this->api->put('v1/object/contact/' . $contactId, [
            'json' => $contactDTO->toArray(),
        ]);

        return $this->processResponse($response);
    }

    public function destroy(string $zuoraGUID)
    {
        $response = $this->api->delete('v1/object/contact/' . $zuoraGUID);

        return $this->processResponse($response);
    }
}
