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

namespace PHPExperts\ZuoraClient\DTOs\Response;

use Carbon\Carbon;
use PHPExperts\SimpleDTO\NestedDTO;
use PHPExperts\ZuoraClient\DTOs\Response\SubscriptionPreview\InvoiceDTO;

/**
 * Taken from https://www.zuora.com/developer/api-reference/#operation/POST_PreviewSubscription
 * NOTE: The Zuora API has *substantially* deviated from the documentation.
 *
 * @property-read bool       $success
 * @property-read float      $contractedMrr Monthly recurring revenue of the subscription.
 * @property-read float      $totalContractedValue
 * @property-read Carbon     $targetDate
 * @property-read InvoiceDTO $invoice
 */
class SubscriptionPreviewCreatedDTO extends NestedDTO
{
    public function __construct(array $input = [])
    {
        $DTOs = [
            'invoice' => InvoiceDTO::class,
        ];

        parent::__construct($input, $DTOs);
    }
}
