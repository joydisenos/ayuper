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
                        <div class="card-header bg-secondary text-light d-flex justify-content-between align-items-center">
                            {{ title_case($tarea->nombre) }} 
                                @if( $tarea->finalizado == null )
                                    <span class="badge badge-warning text-light">Disponible</span>
                                @else
                                    @if(Auth::user()->id == $tarea->presupuesto->user->id)
                                    <span class="badge badge-warning text-light">
                                        Felicidades! {{$tarea->user->name}} te asignó este proyecto
                                    </span>
                                    @else
                                    <span class="badge badge-dark text-light">Cerrado</span>
                                    @endif
                                @endif
                        </div>

                        <div class="card-body">

                            <div class="row mb-4">
                                <div class="col-sm-4 text-center">
                                    @if($tarea->user->perfil == null)
                                    <img class="img-lista" src="{{ asset('img/principal.jpg') }}" alt="">
                                    @else
                                        @if($tarea->user->perfil->foto == null)
                                        <img class="img-lista" src="{{ asset('img/principal.jpg') }}" alt="">
                                        @else
                                        <img class="img-lista" src="{{
                                        asset('storage/perfiles')
                                         . '/' .
                                         $tarea->user->id
                                         . '/' . 
                                         $tarea->user->perfil->foto 
                                    }}" alt="">
                                        @endif
                                    @endif

                                </div>
                                <div class="col-sm-8">
                                    {{ $tarea->descripcion }}
                                </div>
                            </div>

                            <div class="row mb-4">
                            	<div class="col">
                            		<p>Fecha de inicio: {{ $tarea->inicio }}</p>
                            	</div>
                            	<div class="col">
                            		<p>Fecha de Culminación: {{ $tarea->final }}</p>
                            	</div>
                            </div>

                            <div class="row mb-4">
                            	<div class="col">
                            		<p>Con una frecuencia de: {{ title_case($tarea->frecuencia) }}</p>
                            	</div>
                            	<div class="col">
									<p>Horas aproximadas: {{ $tarea->horas }}</p>
								</div>
                            </div>

                            <div class="row-mb-4">
                                <div class="col text-center">
                                    <p>
                                        Publicado: {{$tarea->created_at->format('d/m/y H:i')}}
                                    </p>
                                </div>
                            </div>

                            <div class="row">
                            	<div class="col text-right">
                            		@if($tarea->user_id == Auth::user()->id && $tarea->presupuesto_id == null)
                                        <a href="{{ route('eliminartarea' , $tarea->id) }}" class="btn btn-outline-danger btn-sm">
                                            Eliminar
                                        </a>
                                        <a href="{{ route('modificartarea' , $tarea->id) }}" class="btn btn-outline-secondary btn-sm">
                                            Modificar
                                        </a>
                                    @else
                                    
                                    @if(Auth::user()->estatus == 1 && Auth::user()->id != $tarea->user_id && $tarea->presupuesto_id == null)
                                            <button type="button" class="btn btn-warning text-light" data-toggle="modal" data-target="#presupuestoenviar">
                                                Enviar Presupuesto
                                            </button>
                                        @endif
                                    @endif

                            	</div>
                            </div>

                        </div>
                    </div>
                </div>
                 
            </div>
            @if($tarea->presupuesto_id == null)
            @foreach($presupuestos as $presupuesto)
           <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card item">
                        <div class="card-header bg-secondary text-light d-flex justify-content-between align-items-center">
                            {{ title_case($presupuesto->user->name) }} 
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4 text-center">
                                   
                             @if($presupuesto->user->perfil->foto == null)
                            <img class="img-lista" src="https://ayuper.es/wp-content/uploads/2018/03/cropped-logotipo_opt-192x192.png" alt="Card image cap">
                            @else
                            <img class="card-img-top" src="{{ 
                             asset('storage/perfiles')
                             . '/' .
                             $presupuesto->user->id
                             . '/' . 
                             $presupuesto->user->perfil->foto 
                            }}" alt="Card image cap">
                            @endif

                                </div>
                                @if($tarea->user_id == Auth::user()->id)
                                <div class="col-sm-8">
                                    <p>{{ $presupuesto->detalles }}</p>
                                    <p>
                                        <strong>
                                            Precio: {{ $presupuesto->precio }}
                                            
                                            @if(Auth::user()->referido != null && Auth::user()->verificar != null && Auth::user()->verificar->descuento == null)
                                            - 5% = {{  $presupuesto->precio - (($presupuesto->precio * 5) / 100) }}
                                            @endif

                                        </strong>
                                    </p>

                                    <a href="{{ route('aceptarpresupuesto', [$presupuesto->id , $tarea->id]) }}" class="btn btn-outline-warning">
                                        Aceptar Presupuesto
                                    </a>

                                    <a href="{{ route('negarpresupuesto', $presupuesto->id) }}" class="btn btn-outline-secondary">
                                        Negar Presupuesto
                                    </a>
                                   
                                </div>
                                @else
                                <div class="col-sm-8">
                                    <p>A la Espera por la aprobación del Cliente</p>                                   
                                </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
                 
</div>
        @endforeach
        {{ $presupuestos->links() }}
         @else
          <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card item">
                        <div class="card-header bg-secondary text-light d-flex justify-content-between align-items-center">
                           Tarea adjudicada a {{ title_case($tarea->presupuesto->user->name) }} 
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4 text-center">
                                   
                             @if($tarea->presupuesto->user->perfil->foto == null)
                            <img class="img-lista" src="https://ayuper.es/wp-content/uploads/2018/03/cropped-logotipo_opt-192x192.png" alt="Card image cap">
                            @else
                            <img class="card-img-top" src="{{ 
                             asset('storage/perfiles')
                             . '/' .
                             $tarea->presupuesto->user->id
                             . '/' . 
                             $tarea->presupuesto->user->perfil->foto 
                            }}" alt="Card image cap">
                            @endif

                                </div>
                                @if($tarea->user_id == Auth::user()->id)
                                <div class="col-sm-8">
                                    <p>{{ $tarea->presupuesto->detalles }}</p>
                                     

                                     @if($tarea->estatus == 0)
                                     <p>
                                         Debe contactar con el administrador para realizar el pago y serán liberados los datos del Profesional
                                     </p>
                                     @elseif($tarea->estatus == 1)
                                     <p>
                                        Teléfono móvil {{ $tarea->presupuesto->user->perfil->telefonomovil }}
                                    </p>
                                     <p>
                                        Teléfono fijo {{ $tarea->presupuesto->user->perfil->telefonofijo }}
                                    </p>
                                    <p>
                                        Email {{ $tarea->presupuesto->user->email }}
                                    </p>
                                    @elseif($tarea->estatus == 2)
                                    <p>
                                        El proyecto fué cancelado por favor contacte con el administrador para más detalles.
                                    </p>
                                    @endif


                                    <p>
                                        <strong>
                                            Precio: {{ $tarea->presupuesto->precio }}

                                            @if(Auth::user()->referido != null && Auth::user()->verificar != null && Auth::user()->verificar->descuento == null)
                                            - 5% = {{  $tarea->presupuesto->precio - (($tarea->presupuesto->precio * 5) / 100) }}
                                            @endif


                                        </strong>
                                    </p>
                                   
                                   
                                </div>
                                @else
                                 @if($tarea->estatus == 0)
                                     <p>
                                         Proyecto a la Espera de la Confirmación del pago
                                     </p>
                                     @elseif($tarea->estatus == 1)
                                     <p>
                                         Pago confirmado!
                                     </p>
                                    @elseif($tarea->estatus == 2)
                                    <p>
                                        El proyecto fué cancelado por favor contacte con el administrador para más detalles.
                                    </p>
                                    @endif
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
                 
</div>
         @endif
    
            
        </div>
    </div>
</div>

 @if(Auth::user()->estatus == 1)
    <!-- Modal Presupuesto -->
<div class="modal fade" id="presupuestoenviar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enviar Propuestas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('enviarpresupuesto') }}" method="post" enctype="multipart/form-data">
        @csrf
        
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="tarea_id" value="{{ $tarea->id }}">


        <div class="modal-body">

      

        <div class="form-group">
            <label for="detallespresupuesto">Propuesta</label>
            <textarea name="detalles" id="detallespresupuesto" name="detalles" cols="30" rows="10" placeholder="Indique detalladamente su propuesta para el servicio" class="form-control"></textarea>        
        </div>

        <div class="form-group">
            <label for="precio">Precio</label>
            <div class="input-group">
                <div class="input-group-prepend">
                <div class="input-group-text bg-warning text-light">€</div>
            </div>
            <input type="number" min="0" step="0.1" class="form-control" id="precio" name="precio" placeholder="Indique el precio">
            </div>
        </div>

        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-warning text-light">Enviar Presupuesto</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endif


@endsection
@section('scripts')
<script src="{{asset('js/jquery.min.js')}}"></script>
<script>
$(document).ready(function () {
    $('#detallespresupuesto').on('input', function (e) {
        if (!/^[ a-záéíóúüñ]*$/i.test(this.value)) {
            this.value = this.value.replace(/[^ a-záéíóúüñ]+/ig,"");
        }
    });
});
</script>

@endsection
