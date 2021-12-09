<?php
	$result = mysqli_query($connection, "SELECT * FROM pagina WHERE id_pagina = 3;");
	
	while ($row = mysqli_fetch_row($result)) {
		$titulo = $row[1];
		$subtitulo = $row[2];
		$img = $row[3];
		$conteudo = $row[4];
		$missao = $row[5];
		$missaoimg = $row[6];
		$missaoconteudo = $row[7];
		$visao = $row[8];
		$visaoimg = $row[9];
		$visaoconteudo = $row[10];
		$valores = $row[11];
		$valoresimg = $row[12];
		$valoresconteudo = $row[13];
		
		echo "<output class=\"pagetitulo\">$titulo</output></br>";
		echo "<output class=\"pagesubtitulo\">$subtitulo</output></br>";
		if ($img != null) {
			echo "<img class=\"pageimg\" src=\"$img\">";
		}
		echo "<p><div class=\"pageconteudo\">$conteudo</div></p>";

		echo "<output class=\"pagesubtitulo\">$missao</output></br>";
		if ($missaoimg != null) {
			echo "<img class=\"pageimg\" src=\"$missaoimg\">";
		}
		echo "<p><div class=\"pageconteudo\">$missaoconteudo</div></p>";

		echo "<output class=\"pagesubtitulo\">$visao</output></br>";
		if ($visaoimg != null) {
			echo "<img class=\"pageimg\" src=\"$visaoimg\">";
		}
		echo "<p><div class=\"pageconteudo\">$visaoconteudo</div></p>";

		echo "<output class=\"pagesubtitulo\">$valores</output></br>";
		if ($valoresimg != null) {
			echo "<img class=\"pageimg\" src=\"$valoresimg\">";
		}
		echo "<p><div class=\"pageconteudo\">$valoresconteudo</div></p>";
	}
	
	if ((isset ($_SESSION['login']) == true) and (isset ($_SESSION['senha']) == true)) {
		$prioridade = $_SESSION['prioridade'];
		
		if ($prioridade == 0 or $prioridade == 1) {
			if (isset($_POST['enviar'])) {
				$titulo = $_POST['titulo'];
				$subtitulo = $_POST['subtitulo'];
				$imagem = $_POST['imagem'];
				$conteudo = $_POST['conteudo'];
				$missao = $_POST['missao'];
				$missaoconteudo = $_POST['missaoconteudo'];
				$visao = $_POST['visao'];
				$visaoconteudo = $_POST['visaoconteudo'];
				$valores = $_POST['valores'];
				$valoresconteudo = $_POST['valoresconteudo'];
				if($titulo == "") {
					$erro = "<div><span class=\"erro\">Informe o Titulo!</span></div>";
				}
				else if($subtitulo == "") {
					$erro = "<div><span class=\"erro\">Informe o Subtitulo!</span></div>";
				}
				else if($conteudo == "") {
				$erro = "<div><span class=\"erro\">Informe o Conteúdo!</span></div>";
				}
				else if($missao == "") {
					$erro = "<div><span class=\"erro\">Informe o título de \"Missão\"!</span></div>";
				}
				else if($missaoconteudo == "") {
					$erro = "<div><span class=\"erro\">Informe o conteúdo de \"Missão\"!</span></div>";
				}
				else if($visao == "") {
					$erro = "<div><span class=\"erro\">Informe o título de \"Visão\"!</span></div>";
				}
				else if($visaoconteudo == "") {
					$erro = "<div><span class=\"erro\">Informe o conteúdo de \"Visão\"!</span></div>";
				}
				else if($valores == "") {
					$erro = "<div><span class=\"erro\">Informe o título de \"Valores\"!</span></div>";
				}
				else if($valoresconteudo == "") {
					$erro = "<div><span class=\"erro\">Informe o conteúdo de \"Valores\"!</span></div>";
				}
				else {
					$result = mysqli_query($connection, "UPDATE `pagina` SET `id_pagina` = 3,`titulo_1` = '$titulo',`sub_titulo_1` = '$subtitulo',`imagem_1` = '$imagem',`paragrafo_1` = '$conteudo',`sub_titulo_2` = '$missao',`imagem_2` = '',`paragrafo_2` = '$missaoconteudo',`sub_titulo_3` = '$visao',`imagem_3` = '',`paragrafo_3` = '$visaoconteudo',`sub_titulo_4` = '$valores',`imagem_4` = '',`paragrafo_4` = '$valoresconteudo' WHERE `id_pagina` = 3;");
					header('location:index.php?pg=content/quem-somos.php');
				}
			}
			if ($erro != null) {
				echo "$erro";
			}
			echo "<div class=\"editar\">";
			echo "	<a href=\"#\"><input class=\"btnmostrar\" Onclick=\"$( '#item4' ).slideToggle(); $( '#item3' ).slideUp(); $( '#item2' ).slideUp(); $( '#item1' ).slideUp();\" type=\"submit\" value=\"Valores\" /></a>";
			echo "	<a href=\"#\"><input class=\"btnmostrar\" Onclick=\"$( '#item4' ).slideUp(); $( '#item3' ).slideToggle(); $( '#item2' ).slideUp(); $( '#item1' ).slideUp();\" type=\"submit\" value=\"Visão\" /></a>";
			echo "	<a href=\"#\"><input class=\"btnmostrar\" Onclick=\"$( '#item4' ).slideUp(); $( '#item3' ).slideUp(); $( '#item2' ).slideToggle(); $( '#item1' ).slideUp();\" type=\"submit\" value=\"Missão\" /></a>";
			echo "	<a href=\"#\"><input class=\"btnmostrar\" Onclick=\"$( '#item4' ).slideUp(); $( '#item3' ).slideUp(); $( '#item2' ).slideUp(); $( '#item1' ).slideToggle();\" type=\"submit\" value=\"Conteúdo\" /></a>";
			echo "	<form id=\"form\" method=\"post\" action=\"\">";
			echo "		<div id=\"item1\" style=\"display:none;\">";
			echo "			<input class=\"titulo\" type=\"text\" name=\"titulo\" placeholder=\"Titulo\" value=\"$titulo\" /></br>";
			echo "			<input class=\"subtitulo\" type=\"text\" name=\"subtitulo\" placeholder=\"Subtitulo\" value=\"$subtitulo\" /></br>";
			echo "			<input class=\"imagem\" type=\"text\" name=\"imagem\" placeholder=\"Imagem\" value=\"$img\" /></br>";
			echo "			<textarea class=\"text\" type=\"text\" name=\"conteudo\" placeholder=\"Conteúdo\" rows=\"8\">$conteudo</textarea></br>";
			//echo "			<div>";
			echo "				<input class=\"btnenviar\" type=\"submit\" name=\"enviar\" value=\"Enviar\" />";
			//echo "			</div>";
			echo "		</div>";
			echo "		<div id=\"item2\" style=\"display:none;\">";
			echo "			<input class=\"subtitulo\" type=\"text\" name=\"missao\" placeholder=\"Missão\" value=\"$missao\" /></br>";
			echo "			<textarea class=\"text\" type=\"text\" name=\"missaoconteudo\" placeholder=\"Conteúdo de 'Missão'\" rows=\"8\">$missaoconteudo</textarea></br>";
			//echo "			<div>";
			echo "				<input class=\"btnenviar\" type=\"submit\" name=\"enviar\" value=\"Enviar\" />";
			//echo "			</div>";
			echo "		</div>";
			echo "		<div id=\"item3\" style=\"display:none;\">";
			echo "			<input class=\"subtitulo\" type=\"text\" name=\"visao\" placeholder=\"Visão\" value=\"$visao\" /></br>";
			echo "			<textarea class=\"text\" type=\"text\" name=\"visaoconteudo\" placeholder=\"Conteúdo de 'Visão'\" rows=\"8\">$visaoconteudo</textarea></br>";
			//echo "			<div>";
			echo "				<input class=\"btnenviar\" type=\"submit\" name=\"enviar\" value=\"Enviar\" />";
			//echo "			</div>";
			echo "		</div>";
			echo "		<div id=\"item4\" style=\"display:none;\">";
			echo "			<input class=\"subtitulo\" type=\"text\" name=\"valores\" placeholder=\"Valores\" value=\"$valores\" /></br>";
			echo "			<textarea class=\"text\" type=\"text\" name=\"valoresconteudo\" placeholder=\"Conteúdo de 'Valores'\" rows=\"8\">$valoresconteudo</textarea></br>";
			//echo "			<div>";
			echo "				<input class=\"btnenviar\" type=\"submit\" name=\"enviar\" value=\"Enviar\" />";
			//echo "			</div>";
			echo "		</div>";
			echo "	</form>";
			echo "</div>";
		}
	}
?>