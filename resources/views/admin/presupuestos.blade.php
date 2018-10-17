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


        @foreach($presupuestos as $presupuesto)
            <div class="row mb-4">
                <div class="col-md-12">
              <div class="card item">
               <div class="card-header bg-secondary text-light d-flex justify-content-between align-items-center nombres">
                           tarea: {{ title_case($presupuesto->tarea->nombre) }}

                </div>
						  <div class="card-body">

						    <div class="row mb-3">
						    	<div class="col">
						    		<p>
						    			Profesional: {{ title_case($presupuesto->user->name) }} <br>
						    			{{ $presupuesto->user->email }}
						    		</p>
						    	</div>
						    	<div class="col">
						    		Cliente: {{ title_case($presupuesto->tarea->user->name) }} <br>
									{{ $presupuesto->tarea->user->email }}
						    	</div>
						    </div>

						    <div class="row mb-3">
						    	<div class="col">
						    		<p>
							    		Propuesta: {{ $presupuesto->detalles }}
							    	</p>
							    	<p>
							    		Precio: {{ $presupuesto->precio }}
							    	</p>
						    	</div>
						    </div>

						  </div>
					</div>
                </div>
                 
            </div>
            @endforeach
    
             {{ $presupuestos->links() }}

        </div>
    </div>
</div>

@endrole
@endsection
