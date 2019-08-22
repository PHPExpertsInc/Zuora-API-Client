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

namespace PHPExperts\ZuoraClient\DTOs\Read;

use Carbon\Carbon;
use PHPExperts\SimpleDTO\SimpleDTO;

/**
 * @property string $id
 * @property bool   $active
 * @property string $bccEmailAddress
 * @property string $ccEmailAddress
 * @property string $ccEmailType
 * @property string $createdBy
 * @property Carbon $createdOn
 * @property string $description
 * @property string $emailBody
 * @property string $emailSubject
 * @property string $encodingType
 * @property string $eventTypeName
 * @property string $eventTypeNamespace
 * @property string $fromEmailAddress
 * @property string $fromEmailType
 * @property string $fromName
 * @property bool   $isHtml
 * @property string $name
 * @property string $replyToEmailAddress
 * @property string $replyToEmailType
 * @property string $toEmailAddress
 * @property string $toEmailType
 * @property string $updatedBy
 * @property Carbon $updatedOn
 */
class EmailTemplateDTO extends SimpleDTO
{
}
