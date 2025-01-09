<?php

namespace Daugt\Notifications\Content;

use Daugt\Models\Content\Content;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContentUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    protected Content $content;

    protected string $subject;

    protected string $image;

    protected string $url;

    protected bool $updated;

    public function __construct($content, $subject, $image, $url, $updated = false) {
        $this->content = $content;
        $this->subject = $subject;
        $this->image = $image;
        $this->url = $url;
        $this->updated = $updated;
    }

    public function toMail($notifiable) {
        $user = $notifiable;
        return (new MailMessage)
            ->subject($this->subject)
            ->markdown('daugt::mail.content.notification', ['user' => $user, 'content' => $this->content, 'image' => $this->image, 'url' => $this->url, 'updated' => $this->updated])
            ->mailer('broadcast');
    }

    public function via($notifiable) {
        return ['mail'];
    }
}