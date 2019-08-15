<?php declare(strict_types=1);

namespace PHPExperts\ZuoraClient\Managers\Account;

use InvalidArgumentException;
use PHPExperts\DataTypeValidator\InvalidDataTypeException;
use PHPExperts\ZuoraClient\DTOs\Read;
use PHPExperts\ZuoraClient\Exceptions\ZuoraAPIException;
use PHPExperts\ZuoraClient\Managers\Manager;

class CreditBalanceAdjustment extends Manager
{
    public function fetch(): Read\CreditBalanceAdjustmentsDTO
    {
        $this->assertHasId();
        $zuoraGUID = $this->id;
        $response = $this->api->get('v1/object/credit-balance-adjustment/' . $zuoraGUID);

        if ($response && $response->success === false) {
            throw new InvalidArgumentException("Could not find any credit balance adjustments for Zuora ID '$zuoraGUID'.");
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

    public function store(Write\CreditBalanceAdjustmentDTO $creditBalanceAdjustmentDTO): Response\BasicDTO
    {
        $response = $this->api->post('v1/object/credit-balance-adjustment/', [
            'json' => $this->capitalizeKeys($creditBalanceAdjustmentDTO->toArray())
        ]);

        $response = $this->processResponse($response);

        return new Response\BasicDTO((array) $response);
    }
}
