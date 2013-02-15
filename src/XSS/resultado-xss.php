<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		mostrar_form();
	}
?>

<?php function mostrar_form() { ?>
<!DOCTYPE html>
<!--[if lt IE 8]><html class="no-js lt-ie8"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
		<title>Resultado del ataque con XSS (<?php echo isset($_POST['filtrar'])?'Filtrado':'Sin filtrar'; ?>) | Ejemplos de Código Máquina</title>
        <meta name="description" content="Resultado del vector XSS.">
        <meta name="viewport" content="width=device-width">

		<meta name="robots" content="noindex, nofollow" />
		<meta name="author" content="Código Máquina | http://www.codigomaquina.com" />

		<link rel='icon' href='/favicon.png' type='image/png' />
    </head>
	
    <body>
		<?php
			//Si hay que filtrar los datos
			if (isset($_POST['filtrar']) && strlen(trim($_POST['filtrar'])) != 0) {
				echo htmlspecialchars($_POST['vector'], ENT_QUOTES, 'UTF-8');
			}
			else if (isset($_POST['nofiltrar']) && strlen(trim($_POST['nofiltrar'])) != 0) {
				echo ($_POST['vector']);
			}
			else {
				echo "Error al procesar el formulario, por favor, inténtelo de nuevo.";
			}
		?>
    </body>
</html>

<?php } //Cierra mostrar_form() ?>