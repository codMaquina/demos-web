<?php 
	session_start();
	$token = '';
	if (isset($_SESSION['token']) && preg_match('/^[a-zA-Z0-9]+$/', $_SESSION['token'])) {
		$token = $_SESSION['token'];
	}
?>
<!DOCTYPE html>
<!--[if lt IE 8]>         <html class="no-js lt-ie8"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Prueba de CSRF(Cross-Site Request Forgery) | Ejemplos de Código Máquina</title>
        <meta name="description" content="Test ver como funciona el problema del CSRF, falsificación de petición en sitios cruzados.">
        <meta name="viewport" content="width=device-width">

		<meta name="robots" content="index, follow" />
		<meta name="author" content="Código Máquina | http://www.codigomaquina.com" />
		
		<link rel='icon' href='/favicon.png' type='image/png' />

		 <style type="text/css">
		body {
			font-family: Georgia;
		}
		#wrap {
			margin: 1em 3em;
		}
		.form {
			display: block;
			margin-bottom: 1em;
		}
		.form input {
			padding: .5em;
			margin-bottom: 1em;
		}
		input[type="submit"] {
			margin: 0 1em;
		}
		form {
			display: inline;
		}
		a {
			margin-bottom: 1em;
			margin-left: 2em;
		}
		</style>
    </head>
	
    <body>
		<!-- Los scripts que aparecen en el código pertenecen a Andy Pemberton -->
		<div id="wrap">
			<h1 style="text-align:center">Prueba de CSRF</h1>
			<p>Este concepto es muy interesante, y más interesante es verlo en acción.</p>
			<p>Para ponerlo en práctica lo he realizado sin base de datos, debido a que sólo existe un nombre de usuario y contraseña.</p>
			<p>Probarlo es muy sencillo: pulsar en login, y ver que pone CONECTADO. Después se prueban los enlaces para ver el resultado.</p>
			<p>Los datos de acceso, aunque los carga por defecto, son:</p>
			<ul>
				<li>Nombre de usuario: demo</li>
				<li>Contraseña: demo</li>
			</ul>
			<p><a href="checkStatus.php" target="_blank">Comprueba si estas conectado</a></p>
			<form action="checkStatus.php" method="post">
				<span class="form">
					<label for="username">Nombre de usuario: </label>
					<input name="username" id="username" type="text" value="demo" />
				</span>
				<span class="form">
					<label for="password">Contraseña: </label>
					<input name="password" id="password" type="password" id="con_prg" value="demo" />
				</span>
				<input type="submit" value="Login" name="login" />
			</form>

			<!-- A modo de ejemplo, para que se vea que por GET se puede neutralizar el problema -->
			<p>Modo normal. Carga el script, de modo que se desconecta y muestra un mensaje de éxito.</p>
			<span class="form"><a href="logoutsin.php" target="_blank">Logout SIN token (modo normal)</a> - SI desconecta</span>
			<span class="form"><a href="logoutcon.php?token=<?php echo $token; ?>" target="_blank">Logout CON token (modo normal)</a> - SI desconecta</span>
			<p>Modo CSRF. Carga una página con un par de imágenes, de modo que la que pide token no desconecta. Este ejemplo sería más potente alojando el logoutsintoken.html en otro dominio diferente, pero el efecto funciona bien.</p>
			<span class="form"><a href="logoutsintoken.html" target="_blank">Logout SIN token mediante imágenes</a> - SI desconecta</span>
			<span class="form"><a href="logoutcontoken.html" target="_blank">Logout CON token mediante imágenes</a> - NO desconecta</span>
		</div>
    </body>
</html>