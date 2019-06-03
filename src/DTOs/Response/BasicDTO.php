<?php declare(strict_types=1);

namespace PHPExperts\ZuoraClient\DTOs\Response;

use PHPExperts\DataTypeValidator\DataTypeValidator;
use PHPExperts\DataTypeValidator\InvalidDataTypeException;
use PHPExperts\SimpleDTO\SimpleDTO;

/**
 * @property bool   $success
 * @property string $id
 */
class BasicDTO extends SimpleDTO
{
    public function __construct(array $input, array $options = [], DataTypeValidator $validator = null)
    {
        // This API route is divergent and returns Id instead of id.
        foreach ($input as $key => $val) {
            unset($input[$key]);
            $input[lcfirst($key)] = $val;
        }

        parent::__construct($input);
    }
}
