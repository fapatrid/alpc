<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mensaje recibido</title>
</head>
<body>
	<h1>Te responderemos de alguna manguera</h1>
	<p>
		Nombre: {{ $msg->nombre }} <br>
		Email: {{ $msg->email }} <br>
		Tu mensaje: {{ $msg->mensaje }} 
	</p>
	
</body>
</html>