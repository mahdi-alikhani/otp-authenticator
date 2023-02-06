<?php

namespace Mahdialikhani\OtpAuthenticator;

use Illuminate\Support\ServiceProvider;
use Mahdialikhani\OtpAuthenticator\Console\InstallCommand;

class OTPAuthenticatorServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        $this->commands([
            InstallCommand::class,
        ]);
    }
}
