@component('mail::message')
# Invitación Ayuper.es

{{ title_case($user->name) }} te ha invitado a registrarte a Ayuper.es, donde podrás solicitar servicios profesionales de tu ayudante personal, con este link recibirás un 5% de descuento en tu primer consumo en la plataforma!.

@component('mail::button', ['url' => 'https://app.ayuper.es/alta/'. $user->id ])
Registro
@endcomponent

Saludos,<br>
@endcomponent
