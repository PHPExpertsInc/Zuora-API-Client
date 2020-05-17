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
use PHPExperts\ZuoraClient\DTOs\Read;
use PHPExperts\ZuoraClient\DTOs\Response;
use PHPExperts\ZuoraClient\DTOs\Response\SubscriptionPreviewCreatedDTO;
use PHPExperts\ZuoraClient\DTOs\Write;
use PHPExperts\ZuoraClient\DTOs\Write\SubscriptionPreviewDTO;

class Subscription extends Manager
{
    /**
     * @see https://www.zuora.com/developer/api-reference/#operation/GET_SubscriptionsByKey
     *
     * @param string $chargeDetail
     * @return Read\SubscriptionDTO
     */
    public function fetch(string $chargeDetail = ''): Read\SubscriptionDTO
    {
        $this->assertHasId();
        $params = $chargeDetail !== '' ? "?charge-detail=$chargeDetail" : '';
        $response = $this->api->get('v1/subscriptions/' . $this->id . $params);

        if (!$response || $response->success !== true) {
            throw new InvalidArgumentException("Could not find a subscription with the ID '{$this->id}'.");
        }

        try {
            return new Read\SubscriptionDTO((array)$response);
        } catch (InvalidDataTypeException $e) {
            dd($e->getReasons());
        }
    }

    /**
     * @see https://www.zuora.com/developer/api-reference/#operation/POST_Subscription
     *
     * @param Write\SubscriptionDTO $subscriptionDTO
     * @return Response\SubscriptionCreatedDTO
     */
    public function store(Write\SubscriptionDTO $subscriptionDTO): Response\SubscriptionCreatedDTO
    {
        $response = $this->api->post(
            'v1/subscriptions',
            $subscriptionDTO->toArray()
        );

        $response = $this->processResponse($response);

        return new Response\SubscriptionCreatedDTO((array) $response);
    }

    /**
     * @see https://www.zuora.com/developer/api-reference/#operation/PUT_CancelSubscription
     *
     * @param string $subscriptionId
     * @param Write\CancelledSubscriptionDTO $subscriptionDTO
     * @return Response\SubscriptionCancelledDTO
     */
    public function cancel(string $subscriptionId, Write\CancelledSubscriptionDTO $subscriptionDTO): Response\SubscriptionCancelledDTO
    {
        $response = $this->api->put(
            "v1/subscriptions/{$subscriptionId}/cancel", [
            $subscriptionDTO->toArray()
        ]);

        $response = $this->processResponse($response);

        return new Response\SubscriptionCancelledDTO((array) $response);
    }

    public function preview(SubscriptionPreviewDTO $previewDTO)
    {
        $response = $this->api->post(
            'v1/subscriptions/preview',
            $previewDTO
        );

        $response = $this->processResponse($response, 'Creating a Preview Subscription');

        try {
            return new SubscriptionPreviewCreatedDTO((array)$response);
        } catch (InvalidDataTypeException $e) {
            dd($e->getReasons());
        }
    }
}
