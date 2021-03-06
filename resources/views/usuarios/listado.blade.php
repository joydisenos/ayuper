@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-4">
        <div class="col-md-4">
            @include('includes.panel')
            
        </div>
        
            <div class="col-md-8">
                @include('includes.notificacion')
        @foreach($usuarios as $usuario)
           <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card item">
                        <div class="card-header bg-secondary text-light d-flex justify-content-between align-items-center">
                            {{ title_case($usuario->name) }} 
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4 text-center">
                                   
                             @if($usuario->perfil->foto == null)
						  	<img class="img-lista" src="{{ asset('img/principal.jpg') }}" alt="Card image cap">
						  	@else
						  	<img class="card-img-top" src="{{ 
						  	 asset('storage/perfiles')
						  	 . '/' .
						  	 $usuario->id
						  	 . '/' . 
						  	 $usuario->perfil->foto 
						  	}}" alt="Card image cap">
						  	@endif

                                </div>
                                <div class="col-sm-8">
                                    <p>Teléfono Móvil: {{ str_limit($usuario->perfil->telefonomovil,3,'XXXX') }}</p>
                                    <p>Teléfono Fijo: {{ str_limit($usuario->perfil->telefonofijo,3,'XXXX') }}</p>

                                    <h5>
                                        @if($usuario->estatus == 1)
                                        Servicios que ofrece:
                                        @else
                                        Servicios solicitados:
                                        @endif
                                    </h5>
                                    <ul>
                                    	@foreach($usuario->oficios as $oficio)
                                    		<li>{{ $oficio->servicio->nombre }}</li>
                                    	@endforeach
                                    </ul>
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
@endsection
