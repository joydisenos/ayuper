@component('mail::message')
# Nuevo Usuario

Se Ha registrado un nuevo usuario en la plataforma.

@component('mail::button', ['url' => 'https://ayuper.es/'])
Ayuper!
@endcomponent

Saludos,<br>
{{ config('app.name') }}
@endcomponent