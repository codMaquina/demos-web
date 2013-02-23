<?php
	/*
	 * Desconecta al usuario sin ningún tipo de token
	 */
	$url = "localhost/ejemplos/CSRF";
	session_start();
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		$_SESSION['online'] = false;
		//La siguiente línea es necesaria para que al hacer logout el token se borre y así no lie tanto la demo
		$_SESSION['token'] = false;
		header("HTTP/1.1 303 See Other");
		header("Location: http://$url/ok.html");
		exit();
	}
?>