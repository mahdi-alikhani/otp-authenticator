<?php

namespace Mahdialikhani\OtpAuthenticator\Listeners;

use App\Notifications\VerificationNotification;
use Mahdialikhani\OtpAuthenticator\Events\Authenticated;

class SendVerificationNotification
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Authenticated $event)
    {
        $event->user->notify(new VerificationNotification());
    }
}
