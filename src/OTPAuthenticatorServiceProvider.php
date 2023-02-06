<?php

namespace Mahdialikhani\OtpAuthenticator;

use Illuminate\Support\ServiceProvider;
use Mahdialikhani\OtpAuthenticator\Console\InstallCommand;

class OTPAuthenticatorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/otpauthenticator.php',
            'otpauthenticator'
        );
    }

    public function boot()
    {
        $this->commands([
            InstallCommand::class,
        ]);

        $this->publishes([
            __DIR__ . '/../config/otpauthenticator.php' => config_path('otpauthenticator.php'),
        ], 'otpauthenticator');
    }
}
