@component('mail::message')
# Has recibido un presupuesto nuevo!

Te invitamos a revisar tu cuenta Ayuper! para verificar esta propuesta de uno de nuestros profesionales registrados.

@component('mail::button', ['url' => 'https://ayuper.es/'])
Verificalo!
@endcomponent

<br>
Saludos,
@endcomponent
