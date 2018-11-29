<ul class="list-group">
			<a href="{{ route('home') }}">
				<li class="list-group-item d-flex justify-content-between align-items-center">
              		Inicio
                </li>	
			</a>

      @if(Auth::user()->estatus == 2)
      <a href="{{ route('nuevatarea') }}">
        <li class="list-group-item d-flex justify-content-between align-items-center">
                  Demandar Servicio
                </li> 
      </a> 

      <a href="{{ route('profesionales') }}">
        <li class="list-group-item d-flex justify-content-between align-items-center">
                  Profesionales
        </li> 
      </a>  
      @endif 

      @if(Auth::user()->estatus == 1)
      <a href="{{ route('clientes') }}">
        <li class="list-group-item d-flex justify-content-between align-items-center">
                  Clientes
                </li> 
      </a> 
      @endif  

      @role('admin')
      <a href="{{ route('notificacionespendientes') }}">
        <li class="list-group-item d-flex justify-content-between align-items-center">
                  Notificaciones Pendientes
                  <span class="badge badge-warning text-light">{{ App\Notificacion::where('estatus','<',3)->where('tipo',2)->count() }}</span>
                </li> 
      </a>

      <a href="{{ route('presupuestosnegados') }}">
        <li class="list-group-item d-flex justify-content-between align-items-center">
                  Presupuestos negados
                  <span class="badge badge-warning text-light">{{ App\Presupuesto::where('estatus',2)->count() }}</span>
                </li> 
      </a>

      <a href="{{ route('usuariosregistrados') }}">
        <li class="list-group-item d-flex justify-content-between align-items-center">
                  Usuarios Registrados
                </li> 
      </a>

      <a href="{{ route('referidos') }}">
        <li class="list-group-item d-flex justify-content-between align-items-center">
                  Referidos
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