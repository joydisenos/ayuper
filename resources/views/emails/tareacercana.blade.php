@component('mail::message')
# Han publicado una tarea cerca de tu domicio!

Puede verificar dentro su cuenta Ayuper! la tarea que se ha publicado, así poder enviar un presupuesto a un posible cliente.

@component('mail::button', ['url' => 'https://ayuper.es/'])
Ayuper!
@endcomponent

Saludos,<br>
{{ config('app.name') }}
@endcomponent
