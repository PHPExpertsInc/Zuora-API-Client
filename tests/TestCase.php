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

namespace PHPExperts\ZuoraClient\Tests;

use Dotenv\Dotenv;
use Faker\Factory as Faker;
use PHPExperts\ZuoraClient\RESTAuthStrat as RESTAuth;
use PHPExperts\ZuoraClient\ZuoraClient;
use PHPUnit\Framework\TestCase as BaseTestCase;

/**
 * Any new tests that use the Laravel 5.4 testing layer will extend this TestCase class.
 */
abstract class TestCase extends BaseTestCase
{
    /** @var ZuoraClient */
    protected $api;

    /**
     * Constructs a test case with the given name.
     *
     * @param string $name
     * @param array  $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->faker = Faker::create();

        $dotenv = Dotenv::create(__DIR__ . '/../', '.env');
        $dotenv->load();
    }

    protected static function buildZuoraClient(): ZuoraClient
    {
//        $restAuth = new RESTAuth(RESTAuth::AUTH_MODE_PASSKEY);
        $restAuth = new RESTAuth(RESTAuth::AUTH_MODE_OAUTH2);

        $zuoraClient = new ZuoraClient($restAuth, env('ZUORA_API_HOST'));
        $restAuth->setApiClient($zuoraClient->getApiClient());

        return $zuoraClient;
    }

    public function setUp(): void
    {
        parent::setUp();

        $this->api = self::buildZuoraClient();
    }
}
