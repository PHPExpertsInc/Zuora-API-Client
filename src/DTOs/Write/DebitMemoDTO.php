<?php declare(strict_types=1);

namespace PHPExperts\ZuoraClient\DTOs\Write;

use PHPExperts\SimpleDTO\NestedDTO;
use PHPExperts\SimpleDTO\WriteOnce;

/**
 * https://www.zuora.com/developer/api-reference/#operation/POST_CreatePayment
 *
 * @property float                   $amount
 * @property null|string             $debitMemoId
 * @property null|DebitMemoItemDTO[] $items
 */
class DebitMemoDTO extends NestedDTO
{
    use WriteOnce;

    public function __construct(array $input)
    {
        $DTOs = [
            'items' => DebitMemoItemDTO::class,
        ];

        $DTOs = array_intersect_key($input, $DTOs);

        parent::__construct($input, $DTOs);
    }
}
