<div id="content">
	<link href="../media/css/404-Erro.css" rel="stylesheet" type="text/css">
	<?php
		echo '404-ERRO<br>';
		echo "<h2>P&aacute;gina n&atilde;o encontrada</h2>";
		echo "<p>Voc&ecirc; tentou acessar a p&aacute;gina <span>";
		echo "<strong>";
		echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		echo "</strong></span>, mas ela n&atilde;o existe.</p>";
	?>