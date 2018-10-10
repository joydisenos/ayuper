<div class="row mb-4">
                <div class="col-md-12">
                    <div class="card item">
                        <div class="card-header bg-secondary text-light d-flex justify-content-between align-items-center">
                            {{ $notificacion->tarea->nombre }} 
                                @if( $notificacion->tarea->finalizado == null )
                                    <span class="badge badge-warning text-light">Disponible</span>
                                @else
                                    <span class="badge badge-dark text-light">Cerrado</span>
                                @endif
                        </div>

                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-4 text-center">
                                    <img class="img-lista" src="https://ayuper.es/wp-content/uploads/2018/03/cropped-logotipo_opt-192x192.png" alt="">
                                </div>
                                <div class="col-sm-8">
                                    {{ str_limit($notificacion->tarea->descripcion,200) }}
                                </div>
                            </div>

                        </div>

                        <div class="card-footer text-right">
                            @if($notificacion->tarea->user_id == Auth::user()->id && $notificacion->tarea->finalizado == null)
                            <a href="{{ route('eliminartarea' , $notificacion->tarea->id) }}" class="btn btn-outline-danger btn-sm">
                                Eliminar
                            </a>
                            <a href="{{ route('modificartarea' , $notificacion->tarea->id) }}" class="btn btn-outline-secondary btn-sm">
                                Modificar
                            </a>
                            @endif
                            <a href="{{ route('tarea' , $notificacion->tarea->id) }}" class="btn btn-warning text-light btn-sm">Ver más</a>
                        </div>
                    </div>
                </div>
                 
</div>