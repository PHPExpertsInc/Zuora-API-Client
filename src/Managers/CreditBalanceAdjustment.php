<?php declare(strict_types=1);

namespace PHPExperts\ZuoraClient\Managers;

use InvalidArgumentException;
use PHPExperts\DataTypeValidator\InvalidDataTypeException;
use PHPExperts\ZuoraClient\DTOs\Read;
use PHPExperts\ZuoraClient\Exceptions\ZuoraAPIException;
use PHPExperts\ZuoraClient\DTOs\Write;

class CreditBalanceAdjustment extends Manager
{
    public function fetch(): Read\CreditBalanceAdjustmentsDTO
    {
        $this->assertHasId();
        $response = $this->api->get('v1/object/credit-balance-adjustment/' . $this->id);

        if ($response && $response->success === false) {
            throw new InvalidArgumentException("Could not find any credit balance adjustments for Zuora ID '$this->id'.");
        }

        if (!$response || !property_exists($response, 'id')) {
            throw new ZuoraAPIException('Malformed Zuora API call.');
        }

        try {
            return new Read\CreditBalanceAdjustmentsDTO((array) $response);
        } catch (InvalidDataTypeException $e) {
            dd($e->getReasons());
        }
    }

    public function store(Write\CreditBalanceAdjustmentDTO $creditBalanceAdjustmentDTO)
    {
        $response = $this->api->post(
            'v1/object/credit-balance-adjustment',
            $this->capitalizeKeys($creditBalanceAdjustmentDTO->toArray())
        );

        $response = $this->processResponse($response);

        return $response;
    }

}
