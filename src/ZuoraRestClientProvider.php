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

use Illuminate\Support\ServiceProvider;
use PHPExperts\RESTSpeaker\RESTAuth;

class ZuoraRestClientProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Makes use of the Factory pattern.
        $this->app->singleton('zuora', function ($app) {
            if (env('APP_ENV') === 'prod') {
                $restAuth = new RESTAuth(RESTAuth::AUTH_MODE_TOKEN);
            } else {
                $restAuth = new RESTAuth(RESTAuth::AUTH_MODE_PASSKEY);
            }

            $zuoraClient = new ZuoraClient($restAuth, env('ZUORA_API_HOST'));

            return $zuoraClient;
        });

        // To Access:
        //    $zuoraClient = App::make('zuora');
    }
}
