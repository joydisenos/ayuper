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
                 @include('includes.errors')


            <div class="row mb-4">
                <div class="col-md-12">
              <div class="card item">
               <div class="card-header bg-secondary text-light d-flex justify-content-between align-items-center">
                            Servicios
                </div>
						  <div class="card-body">
<form action="{{ route('nuevoservicio') }}" method="post">
						    <div class="row mb-4">
						    	
						    	<div class="col">
						    		
						    			@csrf
						    			<input type="text" name='nombre' placeholder="nuevo servicio" class="form-control">
						    		
						    	</div>
						    	<div class="col">
						    		<button type="submit" class="btn btn-warning">Guardar</button>
						    	</div>
						    	
						    </div>
</form>
<hr>
						@foreach($servicios as $servicio)
						    <div class="row mb-3">
						    	<div class="col">
						    		{{ $servicio->nombre }}
						    	</div>
						    	<div class="col">
						    		<a href="{{ route('eliminarservicio',$servicio->id) }}" class="btn btn-danger">
						    			Eliminar
						    		</a>
						    	</div>
						    </div>
						@endforeach


						    

						


						  </div>
					</div>
                </div>
                 
            </div>

    
            
        </div>
    </div>
</div>
@endrole
@endsection
