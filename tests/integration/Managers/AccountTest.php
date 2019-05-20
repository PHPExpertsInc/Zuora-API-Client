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

namespace PHPExperts\ZuoraClient\Tests\Integration\Managers;

use PHPExperts\ZuoraClient\DTOs\Response\AccountDTO;
use PHPExperts\ZuoraClient\RESTAuthStrat as RESTAuth;
use PHPExperts\ZuoraClient\Tests\TestCase;
use PHPExperts\ZuoraClient\ZuoraClient;

class AccountTest extends TestCase
{
    /** @var ZuoraClient */
    protected $api;

    public function setUp(): void
    {
        parent::setUp();

        $restAuth = new RESTAuth(RESTAuth::AUTH_MODE_PASSKEY);

        $this->api = new ZuoraClient($restAuth, env('ZUORA_API_HOST'));
        $restAuth->setApiClient($this->api->getApiClient());
    }

    public function testCanFetchAccountDetails()
    {
        $zuoraGUID = '2c92a0fe528dec760152afe18f1a3122';
        $response = $this->api->account->fetch($zuoraGUID);

        self::assertTrue($response->success);
        self::assertSame($zuoraGUID, $response->basicInfo->id);
    }

    public function testCanBuildComplexNestedDTOs()
    {
        $json = <<<JSON
{
    "basicInfo": {
        "id": "2c92a0fe528dec760152afe18f1a3122",
        "name": "Montie Martinez",
        "accountNumber": "a5218685-ea59-4d03-976d-8970a16f0d17",
        "notes": "Imported from FuseBill Customer Number: 419694",
        "status": "Active",
        "crmId": "001i000001BtehDAAR",
        "batch": "Batch4",
        "invoiceTemplateId": "2c92a0f952151ae7015247a8949c58b4",
        "communicationProfileId": "2c92a0fd53ef6d8b0153ef7aae2c1e22",
        "CardFlightApplicationImage__c": null,
        "MemberNumber__c": "FL243661",
        "AccountType__c": "Standard",
        "InvoiceOwner__c": null,
        "PolicyReasonForCancellation__c": null,
        "SecondaryFirstName__c": "Christina",
        "NamePrefix__c": null,
        "SecondaryNameSuffix__c": null,
        "OriginalFacility__c": "Lone Star Protective Solutions L.L.C.",
        "Region__c": "U.S. Law Shield of Florida",
        "Reference__c": null,
        "LEOSECDepartment__c": null,
        "AccountSource__c": "Web",
        "ReportingStatus__c": null,
        "SecondaryEmailAddress__c": "cdollar23@gmail.com",
        "SecondaryNamePrefix__c": null,
        "SecondaryLastName__c": "Dollar-Martinez",
        "CommissionPaymentType__c": null,
        "PolicyNumber__c": null,
        "SecondaryMemberNumber__c": "FL243660",
        "SignatureDate__c": null,
        "NameSuffix__c": null,
        "salesRep": "",
        "parentId": "2c92a0f952151ae401523c838a89130b"
    },
    "billingAndPayment": {
        "billCycleDay": 17,
        "currency": "USD",
        "paymentTerm": "Due Upon Receipt",
        "paymentGateway": "Florida Gateway",
        "invoiceDeliveryPrefsPrint": false,
        "invoiceDeliveryPrefsEmail": true,
        "additionalEmailAddresses": [
            "dummy@zuora.io"
        ]
    },
    "metrics": {
        "balance": 0,
        "totalInvoiceBalance": 0,
        "creditBalance": 0,
        "contractedMrr": 27.8
    },
    "billToContact": {
        "address1": null,
        "address2": null,
        "city": "Winter Haven",
        "country": "United States",
        "county": null,
        "fax": null,
        "firstName": "Montie",
        "homePhone": null,
        "lastName": "Martinez",
        "mobilePhone": null,
        "nickname": "",
        "otherPhone": null,
        "otherPhoneType": "Other",
        "personalEmail": "personal@dummy.io",
        "state": "Florida",
        "taxRegion": null,
        "workEmail": "work@dummy.io",
        "workPhone": null,
        "zipCode": "33880",
        "contactDescription": null
    },
    "soldToContact": {
        "address1": null,
        "address2": null,
        "city": "Winter Haven",
        "country": "United States",
        "county": null,
        "fax": null,
        "firstName": "Montie",
        "homePhone": null,
        "lastName": "Martinez",
        "mobilePhone": null,
        "nickname": "",
        "otherPhone": null,
        "otherPhoneType": "Other",
        "personalEmail": "personal@dummy.io",
        "state": "Florida",
        "taxRegion": null,
        "workEmail": "work@dummy.io",
        "workPhone": null,
        "zipCode": "33880",
        "contactDescription": null
    },
    "success": true
}
JSON;
        $accountInfo = json_decode($json, true);

        $accountDTO = new AccountDTO($accountInfo);
        dd($accountDTO->toArray());
    }

    public function testCanUpdateAccountDetails()
    {
    }
}
