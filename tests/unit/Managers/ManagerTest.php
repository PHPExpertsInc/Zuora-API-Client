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

namespace PHPExperts\ZuoraClient\Tests\Unit\Managers;

use PHPExperts\RESTSpeaker\RESTAuth;
use PHPExperts\RESTSpeaker\RESTSpeaker;
use PHPExperts\ZuoraClient\Exceptions\ResourceNotFoundException;
use PHPExperts\ZuoraClient\Exceptions\ZuoraAPIException;
use PHPExperts\ZuoraClient\Managers\Manager;
use PHPExperts\ZuoraClient\RESTAuthStrat;
use PHPExperts\ZuoraClient\ZuoraClient;
use PHPUnit\Framework\TestCase;

class ManagerTest extends TestCase
{
    /** @var Manager */
    private $manager;

    public function setUp(): void
    {
        parent::setUp();

        $fakeAuth = new RESTAuthStrat(RESTAuth::AUTH_MODE_OAUTH2);
        $fakeZuora = new ZuoraClient($fakeAuth, '');
        $fakeRESTSpeaker = new RESTSpeaker($fakeAuth);
        $this->manager = new class($fakeZuora, $fakeRESTSpeaker) extends Manager {
            public function fetch()
            {
                $this->assertHasId();

                if ($this->id === 'api break') {
                    $response = new \stdClass();
                    $response->apiBreak = true;

                    return $this->processResponse($response);
                }

                if ($this->id === '404') {
                    $response = json_decode(json_encode([
                        'success' => false,
                        'reasons' => [
                            ['message' => 'Cannot find entity by key: "404"'],
                        ],
                    ]));

                    return $this->processResponse($response);
                }

                if ($this->id === 'other') {
                    $response = json_decode(json_encode([
                        'success' => false,
                        'reasons' => [
                            ['message' => 'Another, unknown, error occurred.'],
                        ],
                    ]));

                    return $this->processResponse($response, 'Testing');
                }

                $response = json_decode(json_encode([
                    'success' => true,
                    'id'      => $this->id,
                ]));

                return $this->processResponse($response);
            }
        };
    }

    public function testCanAssertThatAnIdHasBeenSet()
    {
        try {
            $this->manager->fetch();
            self::fail('Fetched without an ID.');
        } catch (\LogicException $e) {
            self::assertStringStartsWith('An ID must be set for ', $e->getMessage());
        }

        $this->manager->id('abcd123');
        self::assertEquals('abcd123', $this->manager->fetch()->id);
    }

    /** @testdox Looks out for API compatibility breaks */
    public function testLooksOutForApiCompatibilityBreaks()
    {
        self::expectException(ZuoraAPIException::class);

        $this->manager->id('api break');
        $this->manager->fetch();
    }

    public function testCanHandleNonExistingEntities()
    {
        try {
            $this->manager->id('404');
            $this->manager->fetch();
            self::fail('Fetched a non-existing entity, somehow.');
        } catch (ResourceNotFoundException $e) {
            self::assertEquals("Unknown with ID '404'", $e->getMessage());
        }
    }

    public function testCanHandleOtherFailures()
    {
        try {
            $this->manager->id('other');
            $this->manager->fetch();
            self::fail('Fetched a non-existing entity, somehow.');
        } catch (ZuoraAPIException $e) {
                self::assertEquals('Testing was unsuccessful: Another, unknown, error occurred.', $e->getMessage());
        }

    }

    public function testCanFetchNormally()
    {
        $this->manager->id('abcd123');
        self::assertEquals('abcd123', $this->manager->fetch()->id);
    }
}
