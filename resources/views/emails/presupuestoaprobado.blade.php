@component('mail::message')
# Presupuesto Aprobado por el cliente

Se ha aprobado un presupuesto dentro de la plataforma.

@component('mail::button', ['url' => 'https://ayuper.es/'])
Ayuper!
@endcomponent

Saludos,<br>
{{ config('app.name') }}
@endcomponent