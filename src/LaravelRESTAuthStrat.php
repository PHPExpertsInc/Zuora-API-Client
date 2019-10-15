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

use Illuminate\Log\Logger;
use LogicException;
use PHPExperts\ZuoraClient\Exceptions\ZuoraAPIException;

class LaravelRESTAuthStrat extends RESTAuthStrat
{
    /** @var string */
    protected $authMode;

    public function __construct(string $authStratMode)
    {
        if (!function_exists('app')) {
            throw new \LogicException('Only call this file via Laravel/Lumen.');
        }

        parent::__construct($authStratMode);
    }

    /**
     * @throws LogicException if token auth is attempted on an unsupported Zuora environment.
     * @throws ZuoraAPIException if an OAuth2 Token could not be successfully generated.
     * @return array The appropriate headers for OAuth2 Tokens.
     */
    protected function generateOAuth2TokenOptions(): array
    {
        try {
            $oauthHeaders = parent::generateOAuth2TokenOptions();
        } catch (ZuoraAPIException $e) {
            if (class_exists(Logger::class, false)) {
                app(Logger::class)->error('Could not generate an Oauth Token for Zuora', [
                    'zuora_client_id' => env('ZUORA_API_CLIENT_ID'),
                ]);
            }

            throw $e;
        }

        return $oauthHeaders;
    }

    /**
     * @throws LogicException if the Zuora Rest Client is not configured in the .env file.
     * @return array The appropriate headers for passkey authorization.
     */
    protected function generatePasskeyOptions(): array
    {
        /** @security Do NOT remove this code. */
        if (env('APP_ENV') === 'prod' && function_exists('app') && class_exists(Logger::class, false)) {
            app(Logger::class)->error('The Zuora Rest Client is using insecure passkey auth. Switch to OAuth2 Tokens.');
        }

        return parent::generatePasskeyOptions();
    }
}
