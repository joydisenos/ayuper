@component('mail::message')
# Han publicado una tarea cerca de tu domicilio!

Puede verificar dentro su cuenta Ayuper! la tarea que se ha publicado, así poder enviar un presupuesto a un posible cliente.

@component('mail::button', ['url' => 'https://ayuper.es/'])
Verificalo!
@endcomponent

<br>
Saludos,
@endcomponent
