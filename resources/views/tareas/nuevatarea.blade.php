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
                    @if(Auth::user()->perfil == null)
                    <div class="alert alert-warning" role="alert">
                            Para publicar tareas debes completar tu perfil! <a href="{{ route('perfil') }}" class="btn btn-outline-secondary">Perfil</a>
                    </div>
                    @else
                    <div class="card">
                        <div class="card-header bg-secondary text-light">Nueva Tarea</div>

                        <div class="card-body">

                        	@include('includes.errors')
                        	@include('includes.notificacion')


                            <form action="{{ route('posttarea') }}" method="post">
                            	@csrf

        <div class="form-group">
            <label for="lista">Selecciona la tarea</label>
            <select name="lista" id="lista" class="form-control">
                @foreach($servicios as $servicio)
                    <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tarea">Nombre de la Tarea</label>
            <input type="text" class="form-control filtronum" id="tarea" name="nombre" placeholder="Nombre de la Tarea">
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción detallada</label>
            <textarea name="descripcion" id="descripcion" class="form-control filtronum" rows="10"></textarea>
        </div>  

        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    <label for="inicio">Fecha de Inicio</label>
                    <input type="date" id="inicio" name="fechainicio" class="form-control">
                </div>
                <div class="col-sm-6">
                    <label for="final">Fecha de Culminación</label>
                    <input type="date" id="final" name="fechafinal" class="form-control">
                </div>
            </div>      
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="frecuencia">Frecuencia</label>
                    <select name="frecuencia" id="frecuencia" name="frecuencia" class="form-control">
                        <option value="1 Vez por Semana">1 Vez por Semana</option>
                        <option value="2 Veces por Semana">2 Veces por Semana</option>
                        <option value="3 Veces por Semana">3 Veces por Semana</option>
                        <option value="4 Veces por Semana">4 Veces por Semana</option>
                        <option value="5 Veces por Semana">5 Veces por Semana</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label for="horas">Número de horas estimadas</label>
            <input type="number" min="0" name="horas" id="horas" class="form-control" placeholder="Ingrese el Número de horas estimadas">
        </div>  

        <div class="form-group">
            <label for="codigo">Código Postal</label>
            <input type="number" name="codigo" id="codigo" class="form-control" placeholder="Ingrese su Código Postal">
        </div>

        <div class="form-group">
            <button class="btn btn-warning">Publicar</button>
        </div>  
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{asset('js/jquery.min.js')}}"></script>
<script>
$(document).ready(function () {
    $('.filtronum').on('input', function (e) {
        if (!/^[ a-záéíóúüñ]*$/i.test(this.value)) {
            this.value = this.value.replace(/[^ a-záéíóúüñ]+/ig,"");
        }
    });
});
</script>

@endsection
