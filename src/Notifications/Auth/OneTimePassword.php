<?php

namespace Daugt\Notifications\Auth;

use Illuminate\Auth\Notifications\ResetPassword as BaseResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OneTimePassword extends Notification implements ShouldQueue
{
    use Queueable;

    protected $otp;

    protected $url;

    public function __construct($otp, $url) {
        $this->otp = $otp;
        $this->url = $url;
    }

    public function toMail($notifiable) {
        return (new MailMessage)
            ->subject(__('daugt::auth.otp.email.subject', ['otp' => $this->otp]))
            ->markdown('daugt::mail.auth.otp', ['otp' => $this->otp, 'url' => $this->url]);
    }

    public function via($notifiable) {
        return ['mail'];
    }
}