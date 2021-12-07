<div class="content">
	<link href="assets/css/software.css" rel="stylesheet" type="text/css">
	<?php
		//echo "Software";
		
		//require_once('system\connection.php');
		$result = mysqli_query($connection, "SELECT * FROM pagina WHERE id_pagina = 2;");
	
		echo "<div id=\"software\">";
		while ($sql = mysqli_fetch_array($result)) {
		echo "<p>";
			$titulo = $sql[1];
			$subtitulo = $sql[2];
			$img = $sql[3];
			$conteudo = $sql[4];
			
			$ttitulo = "<output class=\"pagetitulo\">$titulo</output><br>";
			$ssubtitulo = "<output class=\"pagesubtitulo\">$subtitulo</output>";
			$image = "<img class=\"pageimg\" src=\"$img\">";
			$cconteudo = "<p><div class=\"pageconteudo\">$conteudo</div></p>";
			
			echo "<div>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<center>";
			echo "$ttitulo";
			echo "$ssubtitulo";
			echo "</center>";
			echo "</div>";
			if ($img != "") {
			echo "<center>";
				echo "$image";
			echo "</center>";
			}
			echo "$cconteudo";
		echo "</p>";
		}
		echo "</div>";
		
		if ((isset ($_SESSION['login']) == true) and (isset ($_SESSION['senha']) == true)) {
			$prioridade = $_SESSION['prioridade'];
			
			$erro = null;
				
			if ($prioridade == 0 or $prioridade == 1) {
				if (isset($_POST['enviar'])) {
					$titulo = $_POST['titulo'];
					$subtitulo = $_POST['subtitulo'];
					$imagem = $_POST['imagem'];
					$conteudo = $_POST['conteudo'];
					
					if($titulo == "") {
						$erro = "<div><span class=\"erro\">Informe o Titulo!</span></div>";
					}
					else if($subtitulo == "") {
						$erro = "<div><span class=\"erro\">Informe o Subtitulo!</span></div>";
					}
					else if($conteudo == "") {
						$erro = "<div><span class=\"erro\">Informe o Conteúdo!</span></div>";
					}
					else {
						$result = mysqli_query($connection, "UPDATE `pagina` SET `id_pagina` = 2,`titulo_1` = '$titulo',`sub_titulo_1` = '$subtitulo',`imagem_1` = '$imagem',`paragrafo_1` = '$conteudo' WHERE `id_pagina` = 2;");
						header('location:index.php?pg=content/software.php');
					}
				}
				echo "<div class=\"editar\">";
				echo "<a href=\"#\"><input class=\"btnmostrar\" Onclick=\"$( '#item1' ).slideToggle();\" type=\"submit\" value=\"Conteúdo\" /></a>";
				echo "	<form id=\"form\" method=\"post\" action=\"\">";
				echo "		<div id=\"item1\" style=\"display:none;\">";
				echo "			<input class=\"titulo\" type=\"text\" name=\"titulo\" placeholder=\"Titulo\" value=\"$titulo\" /></br>";
				echo "			<input class=\"subtitulo\" type=\"text\" name=\"subtitulo\" placeholder=\"Subtitulo\" value=\"$subtitulo\" /></br>";
				echo "			<input class=\"imagem\" type=\"text\" name=\"imagem\" placeholder=\"Imagem\" value=\"$img\" /></br>";
				echo "			<textarea class=\"text\" type=\"text\" name=\"conteudo\" placeholder=\"Conteúdo\" rows=\"8\">$conteudo</textarea></br>";
				echo "		<div>";
				if ($erro != null) {
					echo "$erro";
				}
				echo "			<input class=\"btnenviar\" type=\"submit\" name=\"enviar\" value=\"Enviar\" />";
				echo "		</div>";
				echo "		</div>";
				echo "	</form>";
				echo "</div>";
			}
		}
	?>
</div>