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

use PHPExperts\SimpleDTO\SimpleDTO;

/**
 * Taken from https://www.zuora.com/developer/api-reference/#operation/POST_Subscription
 *
 * @property-read bool        $success
 * @property-read string      $subscriptionId
 * @property-read float       $totalDeltaMrr
 * @property-read float       $totalDeltaTcv
 * @property-read string      $invoiceId
 * @property-read null|string $paymentId
 * @property-read null|float  $paidAmount
 * @property-read null|string $creditMemoId
 */
class SubscriptionCancelledDTO extends SimpleDTO
{
}
