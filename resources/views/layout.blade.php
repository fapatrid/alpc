<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<style>
		.active {
			text-decoration: none;
			font-weight: bold;
			color:blue;
		}
		.error {
			color:red;
			font-size: 12px;
		}
	</style>
	<link rel="stylesheet"  href="/css/app.css">
	<title>Mi Sitio</title>
			<link rel="stylesheet" href="/css/desplegable.css" type="text/css" media="all" />
			<script type="text/javascript">
				function ver(n) 
					{
         				document.getElementById("subseccion"+n).style.display="block"
         			}
function ocultar(n) {
         document.getElementById("subseccion"+n).style.display="none"
         }
</script>
</head>
<body>
	<header>
		<nav>
			<div class="container">
					<a class="nav navbar-brand {{ request()->is('/')?'active':'' }}" href="{{ route('home') }}">Inicio</a>
					<a class="nav navbar-brand {{ request()->is('saludos*')?'active':'' }}" href="{{ route('saludos', 'Jorge') }}">Saludo</a>
					<a class="nav navbar-brand {{ request()->is('mensajes/create')?'active':'' }}" href="{{ route('mensajes.create') }}">Contactos</a>
					@if (auth()->check())
					<a class="nav navbar-brand {{ request()->is('mensajes')?'active':'' }}" href="{{ route('mensajes.index') }}">Mensajes</a>
						@if (auth()->user()->hasRoles(['admin']))
							<a class="nav navbar-brand {{ request()->is('usuarios')?'active':'' }}" href="{{ route('usuarios.index') }}">Usuarios</a>
						@endif
					@endif
				<div class="text-right">
					@if (auth()->guest())
					<a class="nav navbar-brand {{ request()->is('login')?'active':'' }}" href="/login">Login</a>
					@else
						<div id="navegador">
						  <ul>
						    <li id="seccion4" onmouseover="ver(4)" onmouseout="ocultar(4)">
						    <a href="#">{{ auth()->user()->name }}</a> 
						      <div id="subseccion4">
						        <p><a href="/usuarios/{{ auth()->id() }}/edit">Mi cuenta</a></p>
						        <p><a href="/logout">Cerrar sesión</a></p>
						        <p><a href="#"> tres</a></p>
						      </div>
						    </li>
						  </ul>
						</div>
					@endif					
				</div>
			</div>
		</nav>
	</header>
	<div class="container">
		@yield ('contenido')
		<footer>Copyright {{ date('Y H:m:s') }}</footer>
	</div>
	<script src="/js/all.js"> 
	</script>	
</body>
</html>