@component('mail::message')
# Nuevo Usuario

Se Ha registrado un nuevo usuario en la plataforma.

@component('mail::button', ['url' => 'https://ayuper.es/'])
Verificalo!
@endcomponent

<br>
Saludos,
@endcomponent