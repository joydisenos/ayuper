@component('mail::message')
# Felicitaciones tu presupuesto ha sido adjudicado!

Puedes ponerte en contacto con el cliente ahora, ingresa a tu cuenta Ayuper! para más detalles.

@component('mail::button', ['url' => 'https://ayuper.es/'])
Ayuper!
@endcomponent

Saludos,<br>
{{ config('app.name') }}
@endcomponent
