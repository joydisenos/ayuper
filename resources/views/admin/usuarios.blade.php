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


        @foreach($users as $user)
            <div class="row mb-4">
                <div class="col-md-12">
              <div class="card item">
               <div class="card-header bg-secondary text-light d-flex justify-content-between align-items-center">
                            {{ title_case($user->name) }}
                </div>
						  <div class="card-body">

						    <div class="row mb-3">
						    	<div class="col">
						    		<strong>Email:</strong> {{ $user->email }}
						    	</div>
						    </div>


						    @if($user->perfil != null)
						    <div class="row mb-3">
                  <div class="col">
                    <p class="card-text">
                      <strong>DNI:</strong> {{ $user->perfil->dni }}
                    </p>
                  </div>
                  <div class="col">
                    <p class="card-text">
                      <strong>Código Postal:</strong> {{ $user->codigo }}
                    </p>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col">
                    <p class="card-text">
                      <strong>Teléfono móvil:</strong> {{ $user->perfil->telefonomovil }}
                    </p>
                  </div>
                  <div class="col">
                    <strong>Teléfono fijo:</strong> {{ $user->perfil->telefonofijo }}
                  </div>
                </div>

						    @else
						     
						    @endif

						    <div class="row mb-3">
						    	<div class="col">
						    		<p class="text-center">
						    			Miembro desde {{ $user->created_at->format('d-M-Y') }}
						    		</p>
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
