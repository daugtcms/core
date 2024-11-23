<?php

namespace Daugt\Notifications\Auth;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;

class VerifyEmail extends BaseVerifyEmail
{
    /**
     * Get the verify email notification mail message for the given URL.
     *
     * @param  string  $url
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    /*protected function buildMailMessage($url)
    {
        return (new MailMessage)
            ->subject('Verify Email Address')
            ->line('Please click the button below to verify your email address.')
            ->action('Verify Email Address', $url)
            ->line('If you did not create an account, no further action is required.');
    }*/
}