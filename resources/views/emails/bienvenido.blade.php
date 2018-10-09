@component('mail::message')
# Bienvenido a Ayuper.es

Te damos cordialmente la bienvenida a nuestra plataforma, donde puedes encontrar profesionales y clientes en un solo sitio, puedes acceder a nuestra plataforma desde el siguiente enlace.

@component('mail::button', ['url' => 'https://ayuper.es/'])
Ayuper!
@endcomponent

Saludos,<br>
{{ config('app.name') }}
@endcomponent
