@extends('layouts.app')

@section('content')
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
                <h5 class="d-block bg-warning text-light p-1 text-right">
                  @if(Auth::user()->estatus == 1)
                Perfil Profesional
                @else
                Perfil Cliente
                @endif
                </h5>
						  <div class="container-img">
						  	@if($perfil == null)
						  	<img class="card-img-top" src="{{ asset('img/principal.jpg') }}" alt="Card image cap">
						  	@else
						  	@if(Auth::user()->perfil->foto == null)
						  	<img class="card-img-top" src="{{ asset('img/principal.jpg') }}" alt="Card image cap">
						  	@else
						  	<img class="card-img-top" src="{{ 
						  	 asset('storage/perfiles')
						  	 . '/' .
						  	 Auth::user()->id
						  	 . '/' . 
						  	 Auth::user()->perfil->foto 
						  	}}" alt="Card image cap">
						  	@endif
						  	@endif
						  </div>
						  <div class="card-body">

						    <div class="row mb-3">
						    	<div class="col">
						    		<p class="card-text">
						    			<strong>Nombre:</strong> {{ title_case(Auth::user()->name) }}
						    		</p>
						    	</div>
						    	<div class="col">
						    		<strong>Email:</strong> {{ Auth::user()->email }}
						    	</div>
						    </div>


						    @if($perfil == null)
						    <div class="row mb-3">
						    	<div class="col">
						    		<h5>Debes completar tus datos!</h5>
						    		<button type="button" class="btn btn-warning text-light" data-toggle="modal" data-target="#crearperfil">Actualizar Perfil</button>
						    	</div>
						    </div>
						    @else
						     <div class="row mb-3">
						    	<div class="col">
						    		<p class="card-text">
						    			<strong>DNI:</strong> {{ Auth::user()->perfil->dni }}
						    		</p>
						    	</div>
                  <div class="col">
                    <p class="card-text">
                      <strong>Código Postal:</strong> {{ Auth::user()->codigo }}
                    </p>
                  </div>
						    </div>

						    <div class="row mb-3">
						    	<div class="col">
						    		<p class="card-text">
						    			<strong>Teléfono móvil:</strong> {{ Auth::user()->perfil->telefonomovil }}
						    		</p>
						    	</div>
						    	<div class="col">
						    		<strong>Teléfono fijo:</strong> {{ Auth::user()->perfil->telefonofijo }}
						    	</div>
						    </div>

						    <div class="row mb-3">
						    	<div class="col">
						    		<button type="button" class="btn btn-warning text-light" data-toggle="modal" data-target="#modificarperfil">Actualizar Perfil</button>
						    	</div>
                  
                  @if(Auth::user()->perfil->tipo != null)
                  <div class="col">
                    <p>
                      <strong>Tipo de perfil:</strong> {{ Auth::user()->perfil->tipo }}
                    </p>
                  </div>
                  @endif
						    </div>
						    @endif

                <div class="row mb-3">
                  
                     <div class="col">
                      <button type="button" class="btn btn-warning text-light" data-toggle="modal" data-target="#cambiarpass">Cambio de Contraseña</button>
                    </div>
                 
                </div>

						    <div class="row mb-3">
						    	<div class="col">
						    		<p class="text-center">
						    			Miembro desde {{ Auth::user()->created_at->format('d-M-Y') }}
						    		</p>
						    	</div>
						    </div>


						  </div>
					</div>
                </div>
                 
            </div>
    
            
        </div>
    </div>
</div>

@if($perfil == null)
<!-- Modal -->
<div class="modal fade" id="crearperfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Completar Perfil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('completarperfil') }}" method="post" enctype="multipart/form-data">
      	@csrf
      	<div class="modal-body">

        <div class="form-group">
        	<div class="custom-file">
			  <input type="file" class="custom-file-input" id="foto" name="foto">
			  <label class="custom-file-label" for="foto">Elegir Foto</label>
			</div>
        </div>

        <div class="form-group">
            <label for="dni">Coloque su DNI</label>
            <input type="text" class="form-control" id="dni" name="dni" placeholder="DNI">
        </div>

        <div class="form-group">
            <label for="codigo">Coloque su Código Postal</label>
            <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código Postal">
        </div>

        <div class="form-group">
            <label for="telefonomovil">Teléfono Móvil</label>
            <input type="number" class="form-control" id="telefonomovil" name="telefonomovil" placeholder="Coloque su número móvil">
        </div>

        <div class="form-group">
            <label for="telefonofijo">Teléfono Fijo</label>
            <input type="number" class="form-control" id="telefonofijo" name="telefonofijo" placeholder="Coloque su número fijo">
        </div>

        @if(Auth::user()->estatus == 1)
        <h5>Tipo de perfil profesional</h5>
          <div class="custom-control custom-radio">
            <input type="radio" id="customRadio1" name="tipo" value="Autónomo" class="custom-control-input">
            <label class="custom-control-label" for="customRadio1" >Autónomo</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" id="customRadio2" name="tipo" value="Empresa" class="custom-control-input">
            <label class="custom-control-label" for="customRadio2" >Empresa</label>
          </div>
        @endif

        <div class="form-group">
        	<h5>
           @if(Auth::user()->estatus == 1)
           Seleccione los servicios a ofrecer
           @else
           Seleccione los servicios a contratar
           @endif 
          </h5>
        	@foreach($servicios as $servicio)
        	<div class="custom-control custom-checkbox">
    			  <input type="checkbox" class="custom-control-input" name="servicios[]" id="servicio{{$servicio->id}}" value="{{ $servicio->id }}">
    			  <label class="custom-control-label" for="servicio{{$servicio->id}}">{{ $servicio->nombre }}</label>
			   </div>
        	@endforeach
        </div>

      	</div>
      	<div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-warning text-light">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>
@else
<!-- Modal Actualizar -->
<div class="modal fade" id="modificarperfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Perfil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('actualizarperfil',Auth::user()->perfil->id) }}" method="post" enctype="multipart/form-data">
      	@csrf
      	<div class="modal-body">

        <div class="form-group">
        	<div class="custom-file">
			  <input type="file" class="custom-file-input" id="foto" name="foto">
			  <label class="custom-file-label" for="foto">Elegir Foto</label>
			</div>
        </div>

        <div class="form-group">
            <label for="dni">Coloque su DNI</label>
            <input type="text" class="form-control" id="dni" name="dni" placeholder="DNI" value="{{ Auth::user()->perfil->dni }}">
        </div>

        <div class="form-group">
            <label for="codigo">Coloque su Código Postal</label>
            <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código Postal" value="{{ Auth::user()->codigo }}">
        </div>

        <div class="form-group">
            <label for="telefonomovil">Teléfono Móvil</label>
            <input type="number" class="form-control" id="telefonomovil" name="telefonomovil" placeholder="Coloque su número móvil" value="{{ Auth::user()->perfil->telefonomovil }}">
        </div>

        <div class="form-group">
            <label for="telefonofijo">Teléfono Fijo</label>
            <input type="number" class="form-control" id="telefonofijo" name="telefonofijo" placeholder="Coloque su número fijo" value="{{ Auth::user()->perfil->telefonofijo }}">
        </div>

        @if(Auth::user()->estatus == 1)
         <h5>Tipo de perfil profesional</h5>
          <div class="custom-control custom-radio">
            <input type="radio" id="customRadio1" name="tipo" value="Autónomo" class="custom-control-input"
            @if(Auth::user()->perfil->tipo == 'Autónomo')
            checked
            @endif
            >
            <label class="custom-control-label" for="customRadio1" >Autónomo</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" id="customRadio2" name="tipo" value="Empresa" class="custom-control-input"
            @if(Auth::user()->perfil->tipo == 'Empresa')
            checked
            @endif
            >
            <label class="custom-control-label" for="customRadio2" >Empresa</label>
          </div>
        @endif

        <div class="form-group">
        	<h5>Seleccione los servicios a ofrecer</h5>
        	@foreach($servicios as $servicio)
        	<?php 
        	$activo = App\Oficio::where('user_id',Auth::user()->id)
        						->where('servicio_id',$servicio->id)
        						->first(); 
        								?>
        	<div class="custom-control custom-checkbox">
			  <input type="checkbox" class="custom-control-input" name="servicios[]" id="servicio{{$servicio->id}}" value="{{ $servicio->id }}"
			  @if($activo != null)
			  checked
			  @endif
			  >
			  <label class="custom-control-label" for="servicio{{$servicio->id}}">{{ $servicio->nombre }}</label>
			</div>
        	@endforeach
        </div>

      	</div>
      	<div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-warning text-light">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endif

<!-- Modal Actualizar -->
<div class="modal fade" id="cambiarpass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambio de Contraseña</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('cambiarpassword') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

      

        <div class="form-group">
            <label for="pass">Contraseña nueva</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirme su contraseña</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>

        
        </div>

        
        <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-warning text-light">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>

@endsection
