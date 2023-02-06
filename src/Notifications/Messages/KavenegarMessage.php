<?php

namespace Mahdialikhani\OtpAuthenticator\Notifications\Messages;

use Kavenegar;
use Mahdialikhani\OtpAuthenticator\Contracts\Messageable;

class KavenegarMessage extends SimpleMessage implements Messageable
{
    public function send()
    {
        try {
            $result = Kavenegar::Send(config('otpauthenticator.drivers.kavenegar.line_number'), $this->receptor, $this->message);
        } catch (\Kavenegar\Exceptions\ApiException $e) {
            echo $e->errorMessage();
        } catch (\Kavenegar\Exceptions\HttpException $e) {
            echo $e->errorMessage();
        }
    }
}
