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
                            <a href="{{ route('tarea' , $tarea->id) }}" class="btn btn-warning text-light btn-sm">Ver más</a>
                        </div>
                    </div>
                </div>
                 
</div>