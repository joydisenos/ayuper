@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-4">
        <div class="col-md-4">
            @include('includes.panel')
        </div>

        <div class="col-md-8">
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-secondary text-light">Modificar {{ title_case($tarea->nombre) }}</div>

                        <div class="card-body">

                        	@include('includes.errors')
                        	@include('includes.notificacion')


                            <form action="{{ route('actualizartarea', $tarea->id) }}" method="post">
                            	@csrf

        <div class="form-group">
            <label for="lista">Selecciona la tarea</label>
            <select name="lista" id="lista" class="form-control">
                @foreach($servicios as $servicio)
                    <option value="{{ $servicio->id }}"
                    	@if ($servicio->id == $tarea->id)
                    	selected
                    	@endif
                    	>{{ $servicio->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tarea">Nombre de la Tarea</label>
            <input type="text" class="form-control" id="tarea" name="nombre" placeholder="Nombre de la Tarea" value="{{ $tarea->nombre }}">
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción detallada</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="10">{{ $tarea->descripcion }}</textarea>
        </div>  

        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    <label for="inicio">Fecha de Inicio</label>
                    <input type="date" id="inicio" name="fechainicio" class="form-control" value="{{ $tarea->inicio }}">
                </div>
                <div class="col-sm-6">
                    <label for="final">Fecha de Culminación</label>
                    <input type="date" id="final" name="fechafinal" class="form-control" value="{{ $tarea->final }}">
                </div>
            </div>      
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="frecuencia">Frecuencia</label>
                    <select name="frecuencia" id="frecuencia" name="frecuencia" class="form-control">
                        <option value="sólo una vez"
                        @if($tarea->frecuencia == 'sólo una vez')
                        selected
                        @endif
                        >Sólo una vez</option>
                        <option value="cada semana"
                        @if($tarea->frecuencia == 'cada semana')
                        selected
                        @endif
                        >Cada semana</option>
                        <option value="cada dos semanas"
                        @if($tarea->frecuencia == 'cada dos semanas')
                        selected
                        @endif
                        >Cada dos semanas</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label for="horas">Número de horas estimadas</label>
            <input type="number" min="0" name="horas" id="horas" class="form-control" placeholder="Ingrese el Número de horas estimadas" value="{{ $tarea->horas }}">
        </div>  

        <div class="form-group">
            <label for="codigo">Código Postal</label>
            <input type="number" name="codigo" id="codigo" class="form-control" placeholder="Ingrese su Código Postal" value="{{ $tarea->codigo }}">
        </div>

        <div class="form-group">
            <button class="btn btn-warning">Publicar</button>
        </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
