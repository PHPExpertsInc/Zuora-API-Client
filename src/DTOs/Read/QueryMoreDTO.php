<?php declare(strict_types=1);

namespace PHPExperts\ZuoraClient\DTOs\Read;

use PHPExperts\SimpleDTO\NestedDTO;
use PHPExperts\SimpleDTO\SimpleDTO;

/**
 * @property-read bool        $done
 * @property-read string      $queryLocator
 * @property-read SimpleDTO[] $records
 * @property-read int         $size
 */
class QueryMoreDTO extends NestedDTO
{
    public function __construct(array $input)
    {
        $DTOs = [
            'records' => SimpleDTO::class,
        ];

        parent::__construct($input, $DTOs, [SimpleDTO::PERMISSIVE]);
    }
}
