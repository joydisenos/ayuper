@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-4">
        <div class="col-md-4">
            @include('includes.panel')
            
        </div>
        
            <div class="col-md-8">
        @include('includes.notificacion')
                @if(Auth::user()->perfil == null)
                    <div class="alert alert-warning" role="alert">
                            Para encontrar trabajos cercanos deber completar tu perfil! <a href="{{ route('perfil') }}" class="btn btn-outline-secondary">Perfil</a>
                    </div>
                @else
                    @if($tareas->count() == 0)
                        <div class="alert alert-warning" role="alert">
                                En estos momentos no hay trabajos cercanos pero mantente atento cuando soliciten sus servicios
                        </div>
                    @endif
                    @foreach($tareas as $tarea)
                       @include('includes.item') 
                    @endforeach
                @endif
        
            
        </div>
    </div>
</div>
@endsection
