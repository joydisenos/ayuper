@component('mail::message')
# El Cliente ha negado su presupuesto para {{ title_case($presupuesto->tarea->nombre) }}

El Cliente ha negado su presupuesto, pero todavía quedan más tareas por ser asignadas, permanece atento en nuestra plataforma.

@component('mail::button', ['url' => 'https://ayuper.es/'])
Ayuper!
@endcomponent

<br>
{{ config('app.name') }}
@endcomponent