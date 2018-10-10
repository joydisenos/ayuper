@component('mail::message')
# Pago Verificado para la tarea {{ $tarea->nombre }}

<h2>Datos del Profesional</h2>
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

<h2>Datos del Cliente</h2>

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
Ayuper!
@endcomponent

Saludos,<br>
{{ config('app.name') }}
@endcomponent