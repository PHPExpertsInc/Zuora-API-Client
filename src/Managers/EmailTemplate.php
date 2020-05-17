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
use PHPExperts\ZuoraClient\DTOs\Write;

class EmailTemplate extends Manager
{
    public function index(): array
    {
        $response = $this->api->get('notifications/email-templates');

        $response = $this->processResponse($response, 'Fetching the Email Templates');
        $response = new Read\EmailTemplateDTO((array) $response);

        $this->id = $response->id;

        return $response;
    }

    public function store(Write\Notification\EmailTemplateDTO $emailTemplateDTO): Read\EmailTemplateDTO
    {
        $response = $this->api->post('notifications/email-templates', [
                $emailTemplateDTO,
        ]);
        dump($response);

        $response = $this->processResponse($response, 'Creating an Email Template');
        $response = new Read\EmailTemplateDTO((array) $response);

        $this->id = $response->id;

        return $response;
    }
}
