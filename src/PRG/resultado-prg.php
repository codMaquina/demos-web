<?php
	/*
	 * A modo de ejemplo el redireccionamiento se hace en esta misma página.
	 * Normalmente se utiliza una página intermedia, pero el código para redireccionar es el mismo.
	 * Se ha realizado de este modo para no tener que utilizar JavaScript, para un ejemplo con
	 * página intermedia tenéis http://www.andypemberton.com/sandbox/prg/
	 */
	//Si llega de index.php o se ha actualizado sin redireccionar
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_POST['prg'])) {
			if ($_POST['prg'] == 'si') {
				/*
				 * Las siguientes líneas son las que definen la redirección.
				 * Es lo que se haría en una página intermedia.
				 * Es recomendable utilizar como código de redirección 302 ó 303.
				 */
				$codRedir = getMetodo();
				header("HTTP/1.1 $codRedir");
				header('Location: http://www.codigomaquina.com/blog/demo/resultado-prg.php');
				exit();
			}
			else {
				mostrar_form(false);
			}
		}
		else {
			mostrar_form(false);
		}
	}
	//Si se ha realizado la redirección a GET
	else {
		mostrar_form(true);
	}
?>

<?php function mostrar_form($es_get) { ?>
<!DOCTYPE html>
<!--[if lt IE 8]><html class="no-js lt-ie8"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
		<title>Resultado del patrón de diseño PRG [(<?php echo isset($_POST['filtrar'])?'Filtrado':'Sin filtrar'; ?>)] | Ejemplos de Código Máquina</title>
        <meta name="description" content="Resultado del patrón PRG.">
        <meta name="viewport" content="width=device-width">

		<meta name="robots" content="noindex, nofollow" />
		<meta name="author" content="Código Máquina | http://www.codigomaquina.com" />

		<link rel='icon' href='/favicon.png' type='image/png' />
    </head>
	
    <body>
		<?php
			if ($es_get):
		?>
			<h2>Resultado del patrón PRG (redirección GET)</h2>
			<p>Al haber seleccionado <strong>redireccionar después del POST</strong>, actualizar esta página <em>no</em> provocará que el navegador muestre una advertencia acerca de reenviar el POST que has enviado, siempre que hayas elegido uno de los siguientes códigos de estado:</p>
			<ul>
				<li>301 - Mudado permanentemente</li>
				<li>302 - Encontrado</li>
				<li>303 - Vea otros</li>
			</ul>
			<p>Sin embargo, los siguientes códigos de redireccionamiento pueden producir resultados inesperados:</p>
			<ul>
				<li>304 - No modificado</li>
				<li>305 - Utilice un proxy</li>
				<li>307 - Redirección temporal</li>
			</ul>
			<p>Esta advertencia no ocurre porque emitiendo una redirección despues del POST previene al navegador de cachear (almacenar en la caché) la petición POST en su historial. De hecho, esta página se ha solicitado mediante una petición <strong>GET</strong> emitida por el navegador de tu parte debido al código de estado de redirección enviado por el navegador después del POST.</p>
		<?php
			else:
		?>
			<h2>Resultado del patrón PRG (redirección POST)</h2>
			<p>Como has seleccionado <strong>utilizar POST para ver la página directamente</strong>, pulsando actualizar en esta página hará que en la mayoría de los navegadores se muestre una advertencia acerca de reenviar la petición POST que se utilizó para mostrar esta página.</p>
			<p>Esta advertencia no parece muy mala cuando se trata de actualizar la página; Sin embargo, es importante fijarse en que el navegador realmente está reenviando los datos de POST. Entonces imagina, por ejemplo, que el formulario de la página anterior se ha utilizado para enviar un pago con tarjeta de crédito.</p>
		<?php endif; ?>
    </body>
</html>

<?php } //Cierra mostrar_form()
function getMetodo() {
	switch ($_POST['rs']) {
		case 301:
			return '301 Moved Permanently';
			break;
		case 302:
			return '302 Found';
			break;
		case 303:
			return '303 See Other';
			break;
		case 304:
			return '304 Not Modified';
			break;
		case 305:
			return '305 Use Proxy';
			break;
		case 307:
			return '307 Temporary Redirect';
			break;
		default:
			return '303 See Other';
			break;
	}
}
?>