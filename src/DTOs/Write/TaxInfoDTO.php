<?php declare(strict_types=1);

namespace PHPExperts\ZuoraClient\DTOs\Write;

use Carbon\Carbon;
use PHPExperts\DataTypeValidator\InvalidDataTypeException;
use PHPExperts\SimpleDTO\SimpleDTO;
use PHPExperts\SimpleDTO\WriteOnce;

/**
 * @property null|string $VATId
 * @property null|string $companyCode
 * @property null|string $exemptCertificateId
 * @property null|string $exemptCertificateType
 * @property null|string $exemptDescription
 * @property null|string $exemptEntityUseCode
 * @property null|Carbon $exemptEffectiveDate
 * @property null|Carbon $exemptExpirationDate
 * @property null|string $exemptIssuingJurisdiction
 * @property null|string $exemptStatus
 */
class TaxInfoDTO extends SimpleDTO
{
    use WriteOnce;

    public const EXEMPT_STATUSES = [
        'Yes',
        'No',
        'pendingVerification',
    ];

    protected function extraValidation(array $values)
    {
        $acceptable = [
            'exemptStatus' => self::EXEMPT_STATUSES,
        ];

        $self = get_class($this);
        foreach ($values as $propery => $value) {
            if (!empty($acceptable[$propery])) {
                if (!in_array($value, $acceptable[$propery])) {
                    $acceptableValues = implode(', ', $acceptable[$propery]);

                    throw new InvalidDataTypeException("The value of $self::\$$propery must be one of $acceptableValues");
                }
            }
        }
    }
}
