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
use PHPExperts\ZuoraClient\DTOs\Read;
use PHPExperts\ZuoraClient\DTOs\Response;
use PHPExperts\ZuoraClient\DTOs\Write;

class Subscription extends Manager
{
    /**
     * @see https://www.zuora.com/developer/api-reference/#operation/GET_SubscriptionsByKey
     */
    public function fetch(string $chargeDetail = ''): Read\SubscriptionDTO
    {
        $this->assertHasId();
        $params = $chargeDetail !== '' ? "?charge-detail=$chargeDetail" : '';
        $response = $this->api->get('v1/subscriptions/' . $this->id . $params);

        if (!$response || $response->success !== true) {
            throw new InvalidArgumentException("Could not find a subscription with the ID '{$this->id}'.");
        }

        return new Read\SubscriptionDTO((array) $response);
    }

    /**
     * @see https://www.zuora.com/developer/api-reference/#operation/POST_Subscription
     */
    public function store(Write\SubscriptionDTO $subscriptionDTO): Response\SubscriptionCreatedDTO
    {
        $response = $this->api->post('v1/subscriptions', [
            'json' => $subscriptionDTO->toArray(),
        ]);

        dd([$response, 1]);
        $response = $this->processResponse($response);

        return new Response\SubscriptionCreatedDTO((array) $response);
    }
}
