<html>
<head>
	<meta name="robots" content="noindex">
	<meta name="googlebot" content="noindex">
</head>
<body>
	<?php
		//iniciamos a sessão que foi aberta.
		session_start();
	
		//pei!!! destruimos a sessão ;)
		session_destroy();
		
		//limpamos as variaveis globais das sessões.
		session_unset();
		
		header('location:../index.php');
	?>
</body>
</html>