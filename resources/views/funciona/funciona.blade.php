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
           <div class="row">
           	<div class="col">
           		<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
					  <div class="carousel-inner">
					  	@if(Auth::user()->estatus == 2)
					  	<!-- Carrusel Cliente -->
					    <div class="carousel-item active">
					     <div class="card">
					     	<div class="card-header bg-secondary text-light">
					     		Inicia Sesión
					     	</div>
					     	<div class="card-body">
					     			 <p>
					      	Inicia sesión si ya tienes una cuenta o Regístrate, si necesitas contratar un ayuper regístrate como cliente en el apartado "Localiza tu ayuper!", si eres un profesional registrate en el apartado "Encuentra tu trabajo"
					      </p>
					      <img class="d-block w-100" src="{{ asset('img/login.jpg') }}" alt="First slide">
					     	</div>
					     	</div>
					     
					    </div>
					    <div class="carousel-item">
					    	<div class="card">
					     	<div class="card-header bg-secondary text-light">
					     		Completa tu Perfil
					     	</div>
					     <div class="card-body">
					     	
 <p>
					      	Completa tu perfil con tus datos personales para poder publicar las tareas que necesites.
					      </p>
					      <img class="d-block w-100" src="{{ asset('img/perfil-form.jpg') }}" alt="Second slide">
					     </div>
					      </div>
					    
					    </div>
					    <div class="carousel-item">
					    	<div class="card">
					    		<div class="card-header bg-secondary text-light">
					    			Publica una Tarea
					    		</div>
					    		<div class="card-body">
					    			<p>
					      	Publica una tarea indicando todas las especificaciones requeridas para poder localizar al profesional que mejor se adapte a sus necesidades, le notificaremos a todos los profesionales cercanos que brinden este servicio!
					      </p>
					      <img class="d-block w-100" src="{{ asset('img/publicar-tarea.jpg') }}" alt="Third slide">
					    		</div>
					    	</div>
					      
					    </div>
					    <div class="carousel-item">
					    	<div class="card">
					    		<div class="card-header bg-secondary text-light">
					    			Elige tu Ayuper
					    		</div>
					    		<div class="card-body">
					    			<p>
					    		Elige tu ayuper!, muchos profesionales estarán publicando presupuestos junto con sus descripciones de cómo pueden realizar esta tarea, elige el que mejor se adapte a su actividad
					    	</p>
					    	<img class="d-block w-100" src="{{ asset('img/presupuesto-cliente.jpg') }}" alt="fourth slide">
					    		</div>
					    	</div>
					
					    </div>
					    <div class="carousel-item">
					    	<div class="card">
					    		<div class="card-header bg-secondary text-light">
					    			Acepta una propuesta
					    		</div>
					    		<div class="card-body">
					    			<p>
					    		Al aceptar una propuesta es necesario realizar el pago correspondiente de la misma para notificarle al profesional elegido que ya puede comenzar a realizar la actividad
					    	</p>
					    	<img class="d-block w-100" src="{{ asset('img/presupuesto-aceptar-cliente.jpg') }}" alt="fiveth slide">
					    		</div>
					    	</div>
					    	
					    </div>
					    @else
					    <!-- Carrusel Profesional -->
					    <div class="carousel-item active">
					     <div class="card">
					     	<div class="card-header bg-secondary text-light">
					     		Inicia Sesión
					     	</div>
					     	<div class="card-body">
					     			 <p>
					      	Inicia sesión si ya tienes una cuenta o Regístrate, si necesitas contratar un ayuper regístrate como cliente en el apartado "Localiza tu ayuper!", si eres un profesional registrate en el apartado "Encuentra tu trabajo"
					      </p>
					      <img class="d-block w-100" src="{{ asset('img/login.jpg') }}" alt="First slide">
					     	</div>
					     	</div>
					     
					    </div>
					    <div class="carousel-item">
					    	<div class="card">
					     	<div class="card-header bg-secondary text-light">
					     		Completa tu Perfil
					     	</div>
					     <div class="card-body">
					     	
 <p>
					      	Completa tu perfil con tus datos personales para poder tener acceso a todas las tareas cercanas a tu domicilio y poder publicar presupuestos para las mismas
					      </p>
					      <img class="d-block w-100" src="{{ asset('img/perfil-profesional.jpg') }}" alt="Second slide">
					     </div>
					      </div>
					    
					    </div>
					    <div class="carousel-item">
					    	<div class="card">
					    		<div class="card-header bg-secondary text-light">
					    			Espera una Tarea
					    		</div>
					    		<div class="card-body">
					    			<p>
					      	Espera una Tarea Cercana, al momento de la publicación de una tarea cercana a tu domicilio se te informará por una notificación vía email
					      </p>
					      <img class="d-block w-100" src="{{ asset('img/espera.jpg') }}" alt="Third slide">
					    		</div>
					    	</div>
					      
					    </div>
					    <div class="carousel-item">
					    	<div class="card">
					    		<div class="card-header bg-secondary text-light">
					    			Envía tu presupuesto
					    		</div>
					    		<div class="card-body">
					    			<p>
					    		Envía un presupuesto indicando por qué deben contratarte para realizar esta tarea e indicando el precio por la actividad
					    	</p>
					    	<img class="d-block w-100" src="{{ asset('img/enviar-propuesta.jpg') }}" alt="fourth slide">
					    		</div>
					    	</div>
					
					    </div>
					    <div class="carousel-item">
					    	<div class="card">
					    		<div class="card-header bg-secondary text-light">
					    			Espera la aprobación
					    		</div>
					    		<div class="card-body">
					    			<p>
					    		Espera por la aprobación del pago del cliente, con el fin de asegurar tu remuneración y puedas obtener ganancias!
					    	</p>
					    	<img class="d-block w-100" src="{{ asset('img/presupuesto-aceptar-profesional.jpg') }}" alt="fiveth slide">
					    		</div>
					    	</div>
					    	
					    </div>
					    @endif
					  </div>
					  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
					    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
					    <span class="sr-only">Previous</span>
					  </a>
					  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
					    <span class="carousel-control-next-icon" aria-hidden="true"></span>
					    <span class="sr-only">Next</span>
					  </a>
				</div>
           	</div>
           </div>
    
            
        </div>
    </div>
</div>

@endsection
@section('scripts')

@endsection
