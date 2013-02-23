<?php
	/*
	 * Comprueba si se está conectado, es decir, si el login se ha realizado correctamente.
	 * Si no está conectado y viene de la pantalla de login con los datos correctos, se pone online.
	 */
	$url = "localhost/ejemplos/CSRF";
    session_start();
	
	//Si se identifica en index.html
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_POST['login'])) {
			if (isset($_POST['username'])&&isset($_POST['password']))
				$usuario = trim($_POST['username']);
				$pass = trim($_POST['password']);
			}
			//Aquí estaría el login en una aplicación real (conexión a la base de datos, etc.)
			if ($usuario != 'demo' || $pass != 'demo') {
				$_SESSION['online'] = false;
				header("HTTP/1.1 303 See Other");
				header("Location: http://$url/checkStatus.php");
				exit();
			}
			else {
				//Los datos ya se han comprobado que son correctos, se conecta
				$_SESSION['online'] = true;
				$_SESSION['token'] = md5(uniqid(microtime(), true));
				header("HTTP/1.1 303 See Other");
				header("Location: http://$url/checkStatus.php");
				exit();
			}
	}
	//Si quiere ver si está o no conectado
	else {
		mostrar_form();
	}
?>

<?php function mostrar_form() { ?>
<!DOCTYPE html>
<!--[if lt IE 8]><html class="no-js lt-ie8"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
		<title>Comprobar si estás online (ejemplo CSRF) | Ejemplos de Código Máquina</title>
        <meta name="description" content="Comprobación si se ha conectado correctamente para el ejemplo CSRF.">
        <meta name="viewport" content="width=device-width">

		<meta name="robots" content="noindex, nofollow" />
		<meta name="author" content="Código Máquina | http://www.codigomaquina.com" />

		<link rel='icon' href='/favicon.png' type='image/png' />
    </head>
	
    <body>
		<h2>Estado de tu conexión</h2>
		<p>Ahora mismo estas:
		<?php
			if (isset($_SESSION['online'])&&$_SESSION['online'] == true):
		?>
			<span style="color:green;">CONECTADO</span>
		<?php
			else:
		?>
			<span style="color:red;">DESCONECTADO</span>
		<?php endif; ?>
		</p>
    </body>
</html>

<?php } //Cierra mostrar_form()