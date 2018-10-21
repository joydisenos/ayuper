@component('mail::message')
# Depósito Verificado para la tarea {{ $tarea->nombre }}


<p>
    nombre del cliente: {{ title_case($tarea->user->name) }}
</p>
<p>
    Teléfono Móvil: {{ $tarea->user->perfil->telefonomovil }}
</p>
<p>
    Teléfono fijo: {{ $tarea->user->perfil->telefonofijo }}
</p>
<p>
    Email: {{ $tarea->user->email }}
</p>


@component('mail::button', ['url' => 'https://ayuper.es/'])
Verificalo!
@endcomponent

<br>
Saludos,
@endcomponent