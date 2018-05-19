@extends('layout')

@section('contenido')
	<h1>Editar usuario</h1>
	@if(session()->has('info'))
		<div class="alert alert-success">{{ session('info') }}</div>
	@endif
<form method="POST" 
	action="{{ route('usuarios.update', $user->id) }}"
	enctype="multipart/form-data"
	>
	{!! method_field('PUT') !!}
	<img width="100px" src="{{ Storage::url($user->avatar)}}">	

	@include('users.form')

	<input class="btn btn-primary" type="submit" value="Enviar">

</form>
@stop



