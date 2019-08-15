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

namespace PHPExperts\ZuoraClient\Tests\unit\Mocks;

use PHPExperts\ZuoraClient\DTOs\Response\SubscriptionCreatedDTO;

class MockDTOs
{
    public static function createSubscriptionCreatedDTO(array $input = null): SubscriptionCreatedDTO
    {
        return new SubscriptionCreatedDTO([
            'success'              => $input['success']              ?? true,
            'contractedMrr'        => $input['contractedMrr']        ?? 0.0,
            'creditMemoId'         => $input['creditMemoId']         ?? '222222ff52b506f20152bab06a777777',
            'invoiceId'            => $input['invoiceId']            ?? '222222ff52b506f20152bab06a222222',
            'paidAmount'           => $input['paymentAmount']        ?? 90.15,
            'paymentId'            => $input['paymentId']            ?? '222222ff52b506f20152bab06a333333',
            'subscriptionId'       => $input['subscriptionId']       ?? '222222ff52b506f20152bab06a111111',
            'subscriptionNumber'   => $input['subscriptionNumber']   ?? 'ASDF',
            'totalContractedValue' => $input['totalContractedValue'] ?? 100.12,
        ]);
    }
}
