<div class="elemento-item">
<div class="row mb-4">  
                <div class="col-md-12">
                    <div class="card item">
                        <div class="card-header bg-secondary text-light d-flex justify-content-between align-items-center">
                            {{ $tarea->nombre }} 
                                @if( $tarea->finalizado == null )
                                    <span class="badge badge-warning text-light">Disponible</span>
                                @else
                                    <span class="badge badge-dark text-light">Cerrado</span>
                                @endif
                        </div>

                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-4 text-center">
                                    <img class="img-lista" src="{{asset('img/icono.png') }}" alt="">
                                </div>
                                <div class="col-sm-8">
                                    <p>
                                        {{ str_limit($tarea->descripcion,200) }}
                                    </p>
                                    <p>
                                       Publicado: {{ $tarea->created_at->format('d/m/y H:i') }}
                                    </p>
                            @if($tarea->presupuesto_id != null)
                            <p>
                                Proyecto adjudicado a: {{ $tarea->presupuesto->user->name }}
                            </p>
                            @endif
                                </div>
                            </div>

                        </div>

                        <div class="card-footer text-right">
                            @if($tarea->user_id == Auth::user()->id && $tarea->finalizado == null)
                            <a href="{{ route('eliminartarea' , $tarea->id) }}" class="btn btn-outline-danger btn-sm">
                                Eliminar
                            </a>
                            <a href="{{ route('modificartarea' , $tarea->id) }}" class="btn btn-outline-secondary btn-sm">
                                Modificar
                            </a>
                            @endif
                            <a href="{{ route('tarea' , $tarea->id) }}" class="btn btn-warning text-light btn-sm">Detalles</a>
                             
                             @if($tarea->presupuesto_id == null && $tarea->presupuestos->count() > 0 && Auth::user()->id == $tarea->user_id)
                             <a class="btn btn-warning text-light btn-sm btn-presupuestos">
                                 Ver Presupuestos {{ $tarea->presupuestos->count() }}
                             </a>
                             @endif
                        </div>
                    </div>
                </div>
                 
</div>

 <!-- toggle presupuestos -->

<div class="toggle-detalles ml-4 pl-4">
        @if($tarea->presupuesto_id == null)
            @foreach($tarea->presupuestos as $presupuesto)
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
                                        </strong>
                                    </p>
                                    <a href="{{ route('aceptarpresupuesto', [$presupuesto->id , $tarea->id]) }}" class="btn btn-outline-warning">
                                        Aceptar Presupuesto
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


                    <!-- Fin toggle presupuestos -->
</div>

