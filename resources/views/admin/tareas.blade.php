@extends('layouts.app')

@section('content')
@role('admin')
<div class="container">
    <div class="row justify-content-center mb-4">
        <div class="col-md-4">
            @include('includes.panel')
        </div>
        
            <div class="col-md-8">
                 @include('includes.notificacion')


        @foreach($tareas as $tarea)
            <div class="row mb-4">
                <div class="col-md-12">
              <div class="card item">
               <div class="card-header bg-secondary text-light d-flex justify-content-between align-items-center">
                            {{ title_case($tarea->nombre) }}
                </div>
						  <div class="card-body">

						    <div class="row mb-3">
						    	<div class="col">
						    		{{ $tarea->descripcion }}
						    	</div>
						    	
						    </div>

						    <div class="row mb-3">
						    	<div class="col">
						    		<strong>Nombre de usuario:</strong> {{ $tarea->user->name }}
						    	</div>
						    	<div class="col">
						    		<strong>Email:</strong> {{ $tarea->user->email }}
						    	</div>
						    </div>


						    

						


						  </div>
					</div>
                </div>
                 
            </div>
            @endforeach
    
            
        </div>
    </div>
</div>
@endrole
@endsection
