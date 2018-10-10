@component('mail::message')
# Felicitaciones tu presupuesto ha sido adjudicado!

Nos encontramos a la espera de la confirmación del pago por parte del cliente, ingresa a tu cuenta Ayuper! para más detalles.

@component('mail::button', ['url' => 'https://ayuper.es/'])
Ayuper!
@endcomponent

Saludos,<br>
{{ config('app.name') }}
@endcomponent
