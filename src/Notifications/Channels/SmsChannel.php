<?php

namespace Mahdialikhani\OtpAuthenticator\Notifications\Channels;

use App\Notifications\VerificationNotification;
use Mahdialikhani\OtpAuthenticator\Contracts\Messageable;

class SmsChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \App\Notifications  $notification
     * @return void
     */
    public function send($notifiable, VerificationNotification $notification)
    {
        $message = $notification->toSms($notifiable);

        if(!$message instanceof Messageable) {
            return;
        }
        
        if($message instanceof Messageable) {
            $message->send();
        }
    }
}
