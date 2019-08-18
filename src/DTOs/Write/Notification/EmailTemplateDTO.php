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

namespace PHPExperts\ZuoraClient\DTOs\Write\Notification;

use PHPExperts\DataTypeValidator\DataTypeValidator;
use PHPExperts\DataTypeValidator\InvalidDataTypeException;
use PHPExperts\SimpleDTO\SimpleDTO;
use PHPExperts\SimpleDTO\WriteOnce;

/**
 * https://www.zuora.com/developer/api-reference/#operation/POST_Create_Email_Template
 *
 * @property null|string $ccEmailAddress
 * @property null|string $ccEmailType
 * @property null|string $bccEmailAddress
 * @property null|string $description
 * @property string      $emailBody
 * @property string      $emailSubject
 * @property string      $eventTypeName
 * @property string      $fromEmailType
 * @property string      $name
 * @property string      $toEmailType
 * @property null|string $encodingType
 * @property null|string $eventTypeNamespace
 * @property null|string $fromEmailAddress
 * @property null|string $fromName
 * @property null|string $replyToEmailAddress
 * @property null|string $replyToEmailType
 * @property null|string $toEmailAddress
 * @property null|bool   $active
 * @property null|bool   $isHtml
 */
final class EmailTemplateDTO extends SimpleDTO
{
    use WriteOnce;

    public const EMAIL_TYPE_BILL_TO = 'BillToContact';
    public const EMAIL_TYPE_SOLD_TO = 'SoldToContact';
    public const EMAIL_TYPE_BILL_AND_SOLD_TO = 'BillToAndSoldToContacts';
    public const EMAIL_TYPE_ALL = 'AllContacts';
    public const EMAIL_TYPE_TENANT_ADMIN = 'TenantAdmin';
    public const EMAIL_TYPE_SPECIFIC = 'SpecificEmails';
    public const EMAIL_TYPE_RUN_OWNER = 'RunOwner';
    public const EMAIL_TYPE_INVOICE_OWNER_BILL_TO = 'InvoiceOwnerBillToContact';
    public const EMAIL_TYPE_INVOICE_OWNER_SOLD_TO = 'InvoiceOwnerSoldToContact';
    public const EMAIL_TYPE_INVOICE_OWNER_BILL_AND_SOLD_TO = 'InvoiceOwnerBillToAndSoldToContact';
    public const EMAIL_TYPE_INVOICE_OWNER_ALL = 'InvoiceOwnerAllContacts';

    public const FROM_EMAIL_TYPE_TENANT = 'TenantEmail';
    public const FROM_EMAIL_TYPE_SPECIFIC = 'SpecificEmail';

    public const ENCODING_TYPE_UTF8 = 'UTF8';
    public const ENCODING_TYPE_SHIFT_JIS = 'Shift_JIS';
    public const ENCODING_TYPE_ISO2022JP = 'ISO_2022_JP';
    public const ENCODING_TYPE_EUC_JP = 'EUC_JP';
    public const ENCODING_TYPE_X_SJIS_0213 = 'X_SJIS_0213';

    private const EMAIL_TYPES = [
        self::EMAIL_TYPE_BILL_TO,
        self::EMAIL_TYPE_SOLD_TO,
        self::EMAIL_TYPE_BILL_AND_SOLD_TO,
        self::EMAIL_TYPE_ALL,
        self::EMAIL_TYPE_TENANT_ADMIN,
        self::EMAIL_TYPE_SPECIFIC,
        self::EMAIL_TYPE_RUN_OWNER,
        self::EMAIL_TYPE_INVOICE_OWNER_BILL_TO,
        self::EMAIL_TYPE_INVOICE_OWNER_SOLD_TO,
        self::EMAIL_TYPE_INVOICE_OWNER_BILL_AND_SOLD_TO,
        self::EMAIL_TYPE_INVOICE_OWNER_ALL,
    ];

    private const FROM_EMAIL_TYPES = [
        self::FROM_EMAIL_TYPE_TENANT,
        self::FROM_EMAIL_TYPE_SPECIFIC,
    ];

    private const ENCODING_TYPES = [
        self::ENCODING_TYPE_UTF8,
        self::ENCODING_TYPE_SHIFT_JIS,
        self::ENCODING_TYPE_ISO2022JP,
        self::ENCODING_TYPE_EUC_JP,
        self::ENCODING_TYPE_X_SJIS_0213,
    ];

    /** @var string */
    protected $ccEmailType = self::EMAIL_TYPE_SPECIFIC;

    public function __construct(array $input = [], array $options = [], DataTypeValidator $validator = null)
    {
        parent::__construct($input, $options, $validator);
    }

    protected function extraValidation(array $values)
    {
        $acceptable = [
            'ccEmailType'      => self::EMAIL_TYPES,
            'encodingType'     => self::ENCODING_TYPES,
            'fromEmailType'    => self::FROM_EMAIL_TYPES,
            'replyToEmailType' => self::FROM_EMAIL_TYPES,
            'toEmailType'      => self::EMAIL_TYPES,
        ];

        $self = get_class($this);
        foreach ($values as $property => $value) {
            if (!empty($acceptable[$property])) {
                if (!in_array($value, $acceptable[$property])) {
                    $acceptableValues = implode(', ', $acceptable[$property]);

                    throw new InvalidDataTypeException("The value of $self::\$$property must be one of $acceptableValues");
                }
            }
        }
    }

    public function toArray(): array
    {
        $data = parent::toArray();
        $data['emailBody'] = str_replace("\n", ' ', $data['emailBody']);

        return $data;
    }
}
