<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordResetSuccessNotification extends Notification
{

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Kata Sandi Anda Telah Diubah')
            ->view('emails.password_reset_success', [
                'user' => $notifiable,
            ]);
    }
}
