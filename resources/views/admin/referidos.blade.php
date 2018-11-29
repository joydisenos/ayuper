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
  <div class="col">
   
      <input type="text" class="form-control" placeholder="Buscar por nombre" id="nombre" value="">

  </div>
  <div class="col">
   
      <input type="text" class="form-control" placeholder="Buscar por email" id="email" value="">

  </div>
</div>
        @foreach($users as $user)
            <div class="row mb-4 ocultar">
                <div class="col-md-12">
              <div class="card item">
               <div class="card-header bg-secondary text-light d-flex justify-content-between align-items-center nombres">
                            {{ title_case($user->name) }}

                            @if($user->estatus == 1)
                            <span class="badge badge-warning text-light">
                              Profesional
                            </span>
                            @elseif($user->estatus == 2)
                            <span class="badge badge-warning text-light">
                              Cliente
                            </span>
                            @endif
                </div>
						  <div class="card-body">

						    <div class="row mb-3">
						    	<div class="col emails">
						    		<strong>Email:</strong> {{ $user->email }}
						    	</div>
                  @if($user->perfil != null)
                    @if($user->perfil->tipo != null)
                    <div class="col">
                      <strong>Tipo de perfil:</strong> {{ $user->perfil->tipo }}
                    </div>
                    @endif
                  @endif
						    </div>


						    @if($user->perfil != null)
						    <div class="row mb-3">
                  <div class="col">
                    <!--<p class="card-text">
                      <strong>DNI:</strong> {{ $user->perfil->dni }}
                    </p>-->
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
						    			<strong>Referidos: {{ $user->referidos->count() }}</strong>
						    		</p>
						    	</div>
                 
                  <div class="col">
                    <button type="button" class="btn btn-warning text-light" data-toggle="modal" data-target="#modificarusuario{{$user->id}}" data-nombre="{{$user->name}}" data-email="{{ $user->email }}" data-id="{{$user->id}}">Referidos</button>
                  </div>
                 
						    </div>
    

						  </div>
					</div>
                </div>
                 
            </div>

            <div class="modal fade" id="modificarusuario{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Referidos de {{ title_case($user->name) }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
        <div class="modal-body">
        
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <th>Nombre</th>
                  <th>Email</th>
                </thead>
                @foreach($user->referidos as $referido)
                <tr>
                  <td>{{$referido->user->name}}</td>
                  <td>{{$referido->user->email}}</td>
                </tr>
                @endforeach
              </table>
            </div>
      
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
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
@section('scripts')
<script src="{{asset('js/jquery.min.js')}}"></script>


<script>
$(document).ready(function () {
   $('#nombre').keyup(function () {

    var filter = this.value.toLowerCase();  // no need to call jQuery here
      $('.ocultar').show();
      $('#email').val('');
    $('.ocultar').each(function() {
        /* cache a reference to the current .media (you're using it twice) */
        var _this = $(this);
        var title = _this.find('.nombres').text().toLowerCase();

        /* 
            title and filter are normalized in lowerCase letters
            for a case insensitive search
         */
        if (title.indexOf(filter) < 0) {
            _this.hide();
        }else if(filter == ''){
          $('.ocultar').show();
        }
    });
});

   $('#email').keyup(function () {

    var filter = this.value.toLowerCase();  // no need to call jQuery here
      $('.ocultar').show();
      $('#nombre').val('');
    $('.ocultar').each(function() {
        /* cache a reference to the current .media (you're using it twice) */
        var _this = $(this);
        var title = _this.find('.emails').text().toLowerCase();

        /* 
            title and filter are normalized in lowerCase letters
            for a case insensitive search
         */
        if (title.indexOf(filter) < 0) {
            _this.hide();
        }else if(filter == ''){
          $('.ocultar').show();
        }
    });
});

  $('#modificarusuario').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget); // Button that triggered the modal
  var nombreUser = button.data('nombre'); // Extract info from data-* attributes
  var emailUser = button.data('email'); // Extract info from data-* attributes
  var idUser = button.data('id'); // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this);
  modal.find('.modal-title').text('Modificar datos de ' + nombreUser);
  modal.find('#nombremodal').val(nombreUser);
  modal.find('#emailmodal').val(emailUser);
  modal.find('#idmodal').val(idUser);
});

});
</script>

@endsection
