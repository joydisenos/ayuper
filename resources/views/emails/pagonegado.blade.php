@component('mail::message')
# Pago ha sido negado {{ $tarea->nombre }}

<p>
	La tarea asignada fué negada, para más información por favor contacte al administrador
</p>


@component('mail::button', ['url' => 'https://ayuper.es/'])
Verificalo!
@endcomponent

<br>
Saludos,
@endcomponent