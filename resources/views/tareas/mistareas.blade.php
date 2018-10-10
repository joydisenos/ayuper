@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-4">
        <div class="col-md-4">
            @include('includes.panel')
        </div>
        
       
            <div class="col-md-8">

                @include('includes.notificacion')
                
                @if($tareas->count() == 0 && Auth::user()->estatus == 2)
                <div class="alert alert-warning bg-warning text-light text-center" role="alert">
                    <h5>
                        Aún no tienes tareas, crea una para conseguir a los mejores profesionales!
                    </h5>
                    <a href="{{ route('nuevatarea') }}" class="btn btn-light">
                        Crear tarea
                    </a>
                </div>
                @endif

                @foreach($tareas as $tarea)

                    @include('includes.item')

                @endforeach

                {{ $tareas->links() }}

                @if(Auth::user()->estatus == 1)
                @foreach($notificaciones as $notificacion)

                    @include('includes.itemprofesional')

                @endforeach

                {{ $notificaciones->links() }}
                @endif
            
        </div>
    </div>
</div>
@if(Auth::user()->estatus == 2)
<div class="float">
    <a href="{{ route('nuevatarea') }}" class="btn btn-outline-warning">
                        Crear tarea
    </a>
</div>
@endif
@endsection
