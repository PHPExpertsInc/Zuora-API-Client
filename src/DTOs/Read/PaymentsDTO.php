<?php declare(strict_types=1);

namespace PHPExperts\ZuoraClient\DTOs\Read;

use PHPExperts\SimpleDTO\NestedDTO;

/**
 * See https://www.zuora.com/developer/api-reference/#operation/GET_RetrieveAllPayments
 *
 * @property null|string  $nextPage
 * @property PaymentDTO[] $payments
 * @property bool         $success
 */
class PaymentsDTO extends NestedDTO
{
    public function __construct(array $input)
    {
        $DTOs = [
            'payments' => PaymentDTO::class,
        ];

        parent::__construct($input, $DTOs);
    }
}
