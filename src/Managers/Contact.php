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

use PHPExperts\ZuoraClient\DTOs\Write\ContactDTO;

class Contact extends Manager
{
    public function fetch()
    {
        $this->assertHasId();
        $response = $this->api->get('v1/object/contact/' . $this->id);

        return $response;
    }

    public function store(ContactDTO $contactDTO)
    {
        $this->assertHasId();
        $response = $this->api->post('v1/contacts/' . $this->id, [
            'json' => $contactDTO,
        ]);

        return $this->processResponse($response);
    }

    public function update(ContactDTO $contactDTO)
    {
        $this->assertHasId();
        $response = $this->api->put('v1/object/contact/' . $this->id, [
            'json' => $contactDTO,
        ]);

        return $this->processResponse($response);
    }

    public function destroy(string $zuoraGUID)
    {
        $this->assertHasId();
        $response = $this->api->delete('v1/object/contact/' . $this->id);

        return $this->processResponse($response);
    }
}
