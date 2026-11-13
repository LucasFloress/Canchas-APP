<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminResetPasswordNotification extends Notification
{
    use Queueable;

    public function __construct(public string $token)
    {
    }

    /**
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $url = route('admin.password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]);

        $expire = config('auth.passwords.admins.expire');

        return (new MailMessage)
            ->subject('Restablecer contraseña')
            ->line('Recibes este correo porque se solicitó restablecer la contraseña de tu cuenta de administrador.')
            ->action('Restablecer contraseña', $url)
            ->line("Este enlace expirará en {$expire} minutos.")
            ->line('Si no solicitaste este cambio, puedes ignorar este correo.');
    }
}
