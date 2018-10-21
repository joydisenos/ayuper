<?php
 
namespace App\Notifications;
 
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
 
class MyResetPassword extends ResetPassword
{
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('📬 Recuperar Contraseña')
            ->line('Estás recibiendo este email porque se ha solicitado un cambio de contraseña para tu cuenta.')
            ->action('Reestablecer Contraseña', route('password.reset', $this->token))
            ->line('Si no has solicitado un cambio de contraseña, puedes ignorar o eliminar este e-mail.');
    }
}