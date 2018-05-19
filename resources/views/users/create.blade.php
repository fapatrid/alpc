@extends('layout')

@section('contenido')
	<h1>Crear nuevo usuario</h1>

	<form method="POST" 
	action="{{ route('usuarios.store') }}"
	enctype="multipart/form-data"
	>	
	@include('users.form', ['user'=> new App\User])

	<input class="btn btn-primary" type="submit" value="Guardar">

</form>
@stop

