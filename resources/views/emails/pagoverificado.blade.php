@component('mail::message')
# Pago Verificado para la tarea {{ $tarea->nombre }}


<p>
    nombre del profesional: {{ title_case($tarea->presupuesto->user->name) }}
</p>
<p>
    Teléfono Móvil: {{ $tarea->presupuesto->user->perfil->telefonomovil }}
</p>
<p>
    Teléfono fijo: {{ $tarea->presupuesto->user->perfil->telefonofijo }}
</p>
<p>
    Email: {{ $tarea->presupuesto->user->email }}
</p>


@component('mail::button', ['url' => 'https://ayuper.es/'])
Ayuper!
@endcomponent

<br>
{{ config('app.name') }}
@endcomponent