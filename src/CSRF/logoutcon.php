<?php
	/*
	 * Desconecta al usuario si tuviera un token
	 */
	$url = "localhost/ejemplos/CSRF";
	session_start();
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		if (isset($_SESSION['token']) && isset($_GET['token']) && $_GET['token'] == $_SESSION['token']) {
			$_SESSION['online'] = false;
			$_SESSION['token'] = false;
			header("HTTP/1.1 303 See Other");
			header("Location: http://$url/ok.html");
			exit();
		}
		else {
			header("HTTP/1.1 303 See Other");
			header("Location: http://$url/index.php");
			exit();
		}
	}
?>