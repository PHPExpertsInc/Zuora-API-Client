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

namespace PHPExperts\ZuoraClient;

use PHPExperts\RESTSpeaker\RESTAuth;
use PHPExperts\RESTSpeaker\RESTSpeaker;
use PHPExperts\ZuoraClient\Managers\Account;
use PHPExperts\ZuoraClient\Managers\Contact;
use PHPExperts\ZuoraClient\Managers\CreditBalanceAdjustment;
use PHPExperts\ZuoraClient\Managers\EmailTemplate;
use PHPExperts\ZuoraClient\Managers\Payment;
use PHPExperts\ZuoraClient\Managers\PaymentGateway;
use PHPExperts\ZuoraClient\Managers\PaymentMethod;
use PHPExperts\ZuoraClient\Managers\Subscription;
use PHPExperts\ZuoraClient\Managers\SubscriptionAmendment;

final class ZuoraClient
{
    // Zuora API v252.0: Current as of 2019-07-26.
    public const ZUORA_API_VERSION = '230.0';

    /** @var RESTSpeaker */
    protected $api;

    /** === Managers (See: Composition Architectural Pattern) === */

    /** @var Account */
    public $account;

    /** @var Contact */
    public $contact;

    /** @var EmailTemplate */
    public $emailTemplate;

    /** @var Payment */
    public $payment;

    /** @var PaymentGateway */
    public $paymentGateway;

    /** @var PaymentMethod */
    public $paymentMethod;

    /** @var Subscription */
    public $subscription;

    /** @var SubscriptionAmendment */
    public $subAmendment;

    /** @var CreditBalanceAdjustment */
    public $creditBalanceAdjustment;

    public function __construct(RESTAuth $authStrat, string $baseURI, RESTSpeaker $apiClient = null)
    {
        if (!$apiClient) {
            $apiClient = new RESTSpeaker($authStrat, $baseURI);
        }

        $this->api = $apiClient;

        // @todo: This should *probably* be done via Dependency Injection :-/
        // @todo: Maybe add a light container later that proxies to Laravel's, if present?
        $this->account = new Account($this, $apiClient);
        $this->contact = new Contact($this, $apiClient);
        $this->emailTemplate = new EmailTemplate($this, $apiClient);
        $this->payment = new Payment($this, $apiClient);
        $this->paymentGateway = new PaymentGateway($this, $apiClient);
        $this->paymentMethod = new PaymentMethod($this, $apiClient);
        $this->subscription = new Subscription($this, $apiClient);
        $this->subAmendment = new SubscriptionAmendment($this, $apiClient);
        $this->creditBalanceAdjustment = new CreditBalanceAdjustment($this, $apiClient);
    }

    public function getApiClient(): RESTSpeaker
    {
        return $this->api;
    }
}
