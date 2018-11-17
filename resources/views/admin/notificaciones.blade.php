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
                            Notificaciones Pendientes
                </div>
						  <div class="card-body">

						<div class="table-responsive">
							<table class="table">
								<thead>
									<th>Cliente</th>
									<th>Email</th>
									<th>Tarea</th>
									<th>Profesional</th>
									<th>Email</th>
									<th>Estatus</th>
									<th>Acción</th>
								</thead>
								<tbody>
									@foreach($notificaciones as $not)
						    			<tr>
						    				<td>{{$not->tarea->user->name}}</td>
						    				<td>{{$not->tarea->user->email}}</td>
						    				<td><a href="{{route('tarea', $not->tarea->id)}}">
						    					{{$not->tarea->nombre}}
						    				</a></td>
						    				<td>{{$not->tarea->presupuesto->user->name}}</td>
						    				<td>{{$not->tarea->presupuesto->user->email}}</td>
						    				<td>
						    					@if($not->tarea->estatus == 0)
						    					A la espera por aprobación
						    					@elseif($not->tarea->estatus == 1)
						    					<span class="text-success">Aprobado</span>
						    					@elseif($not->tarea->estatus == 2)
						    					<span class="text-danger">Negado</span>
						    					@endif
						    				</td>
						    				<td>
						    					@if($not->tarea->estatus == 0)
						    					<a href="{{ route('notificacionestatus',[$not->id,1]) }}" class="btn btn-warning text-light btn-sm d-block mb-1	">
						    						Aprobar
						    					</a>
						    					<a href="{{ route('notificacionestatus',[$not->id,2]) }}" class="btn btn-outline-danger btn-sm d-block mb-1	">
						    						Negar
						    					</a>
						    					@else 
						    					<a href="{{ route('notificacionestatus',[$not->id,0]) }}" class="btn btn-outline-secondary btn-sm d-block mb-1	">
						    						Verificar
						    					</a>
						    					@endif
						    				</td>
						    			</tr>
									@endforeach
								</tbody>
							</table>
						</div>


						    

						


						  </div>
					</div>
                </div>
                 
            </div>

    
            
        </div>
    </div>
</div>
@endrole
@endsection
