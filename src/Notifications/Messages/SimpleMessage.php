<?php

namespace Mahdialikhani\OtpAuthenticator\Notifications\Messages;

class SimpleMessage
{
    /**
     * Text message content
     * 
     * @param string
     */
    public $message;

    /**
     * Text message receptors
     * 
     * @param array
     */
    public $receptor;

    /**
     * Set text message receptor
     * 
     * @param string $receptor
     * @return \Mahdialikhani\OtpAuthenticator\Notifications\Messages\SimpleMessage
     */
    public function to($receptor)
    {
        $this->receptor = $receptor;

        return $this;
    }

    /**
     * Set text message content
     * 
     * @param string $message
     * @return \Mahdialikhani\OtpAuthenticator\Notifications\Messages\SimpleMessage
     */
    public function message($message)
    {
        $this->message = $message;

        return $this;
    }
}
