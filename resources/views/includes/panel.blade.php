<ul class="list-group">
			<a href="{{ route('home') }}">
				<li class="list-group-item d-flex justify-content-between align-items-center">
              		Inicio
                </li>	
			</a>

      @if(Auth::user()->estatus == 1)
      <a href="{{ route('nuevatarea') }}">
        <li class="list-group-item d-flex justify-content-between align-items-center">
                  Demandar Servicio
                </li> 
      </a>  
      @endif   

      <a href="{{ route('home') }}">
        <li class="list-group-item d-flex justify-content-between align-items-center">
                  Ofrecer Servicio
                </li> 
      </a> 

      <a href="{{ route('clientes') }}">
        <li class="list-group-item d-flex justify-content-between align-items-center">
                  Encuentra Clientes
                </li> 
      </a>

      <a href="{{ route('profesionales') }}">
        <li class="list-group-item d-flex justify-content-between align-items-center">
                  Encuentra Profesionales
                </li> 
      </a>

      @role('admin')
      <a href="{{ route('usuariosregistrados') }}">
        <li class="list-group-item d-flex justify-content-between align-items-center">
                  Usuarios Registrados
                </li> 
      </a>
      <a href="{{ route('todastareas') }}">
        <li class="list-group-item d-flex justify-content-between align-items-center">
                  Tareas
                </li> 
      </a>
      <a href="{{ route('servicios') }}">
        <li class="list-group-item d-flex justify-content-between align-items-center">
                  Servicios
                </li> 
      </a>
      @endrole

	

            
      

</ul>