@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-4">
        <div class="col-md-4">
            @include('includes.panel')
        </div>
        
       
            <div class="col-md-8">
                 @foreach($tareas as $tarea)
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card item">
                        <div class="card-header bg-secondary text-light">{{ $tarea->nombre }}</div>

                        <div class="card-body">

                            {{ $tarea->descripcion }}
                        </div>
                    </div>
                </div>
                 
            </div>
       @endforeach
            
        </div>
    </div>
</div>
@endsection
