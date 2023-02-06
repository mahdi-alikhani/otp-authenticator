<?php

namespace Mahdialikhani\OtpAuthenticator\Notifications\Messages;

use Ghasedak\GhasedakApi;
use Mahdialikhani\OtpAuthenticator\Contracts\Messageable;

class GhasedakMessage extends SimpleMessage implements Messageable
{
    public function send()
    {
        $api = new GhasedakApi(env('GHASEDAKAPI_KEY'));
        $api->Verify($this->receptor, config('otpauthenticator.drivers.ghasedak.template_name'), (string)$this->message);
    }
}
