<div class="content">
	<link href="assets/css/quem-somos.css" rel="stylesheet" type="text/css">
	<?php
		//echo "Quem Somos";
		require_once('system\connection.php');
		$result = mysqli_query($connection, "SELECT * FROM pagina WHERE id_pagina = 3;");
	
		echo "<div id=\"quem_somos\">";
		while ($sql = mysqli_fetch_array($result)) {
		echo "<p>";
			$titulo = $sql[1];
			$subtitulo = $sql[2];
			$img = $sql[3];
			$conteudo = $sql[4];
			$missao = $sql[5];
			$missaoimg = $sql[6];
			$missaoconteudo = $sql[7];
			$visao = $sql[8];
			$visaoimg = $sql[9];
			$visaoconteudo = $sql[10];
			$valores = $sql[11];
			$valoresimg = $sql[12];
			$valoresconteudo = $sql[13];
			
			$ttitulo = "<output class=\"pagetitulo\">$titulo</output><br>";
			$ssubtitulo = "<output class=\"pagesubtitulo\">$subtitulo</output>";
			$image = "<img class=\"pageimg\" src=\"$img\">";
			$cconteudo = "<p><div class=\"pageconteudo\">$conteudo</div></p>";
			$mmissao = "<output class=\"pagesubtitulo\">$missao</output>";
			$mmissaoimage = "<img class=\"pageimg\" src=\"$missaoimg\">";
			$mmissaoconteudo = "<p><div class=\"pageconteudo\">$missaoconteudo</div></p>";
			$vvisao = "<output class=\"pagesubtitulo\">$visao</output>";
			$vvisaoimage = "<img class=\"pageimg\" src=\"$visaoimg\">";
			$vvisaoconteudo = "<p><div class=\"pageconteudo\">$visaoconteudo</div></p>";
			$vvalores = "<output class=\"pagesubtitulo\">$valores</output>";
			$vvaloresimage = "<img class=\"pageimg\" src=\"$valoresimg\">";
			$vvaloresconteudo = "<p><div class=\"pageconteudo\">$valoresconteudo</div></p>";
			
			echo "<div>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<center>";
				echo "$ttitulo";
				echo "$ssubtitulo";
			echo "</div>";
			if ($img != null) {
				echo "<center>";
					echo "$image";
			}
				echo "</center>";
			echo "$cconteudo";
			echo "$mmissao";
			if ($missaoimg != null) {
				echo "$mmissaoimage";
			}
			echo "$mmissaoconteudo";
			echo "$vvisao";
			if ($visaoimg != null) {
				echo "$vvisaoimage";
			}
			echo "$vvisaoconteudo";
			echo "$vvalores";
			if ($valoresimg != null) {
				echo "$vvaloresimage";
			}
			echo "$vvaloresconteudo";
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
					
						/*
						$con = mysql_connect("localhost", " root", "") or die (header('location:index.php?pg=erro/erro_500.php'));
						$select = mysql_select_db("bd_nest_site") or die(header('location:index.php?pg=content/login.php'));
						*/
						$result = mysqli_query($connection, "UPDATE `pagina` SET `id_pagina` = 3,`titulo_1` = '$titulo',`sub_titulo_1` = '$subtitulo',`imagem_1` = '$imagem',`paragrafo_1` = '$conteudo',`sub_titulo_2` = '$missao',`imagem_2` = '',`paragrafo_2` = '$missaoconteudo',`sub_titulo_3` = '$visao',`imagem_3` = '',`paragrafo_3` = '$visaoconteudo',`sub_titulo_4` = '$valores',`imagem_4` = '',`paragrafo_4` = '$valoresconteudo' WHERE `id_pagina` = 3;");
						header('location:index.php?pg=content/quem-somos.php');
					}
				}
				echo "<div class=\"editar\">";
				echo "<a href=\"#\"><input class=\"btnmostrar\" Onclick=\"$( '#item4' ).slideToggle(); $( '#item3' ).slideUp(); $( '#item2' ).slideUp(); $( '#item1' ).slideUp();\" type=\"submit\" value=\"Valores\" /></a>";
				echo "<a href=\"#\"><input class=\"btnmostrar\" Onclick=\"$( '#item4' ).slideUp(); $( '#item3' ).slideToggle(); $( '#item2' ).slideUp(); $( '#item1' ).slideUp();\" type=\"submit\" value=\"Visão\" /></a>";
				echo "<a href=\"#\"><input class=\"btnmostrar\" Onclick=\"$( '#item4' ).slideUp(); $( '#item3' ).slideUp(); $( '#item2' ).slideToggle(); $( '#item1' ).slideUp();\" type=\"submit\" value=\"Missão\" /></a>";
				echo "<a href=\"#\"><input class=\"btnmostrar\" Onclick=\"$( '#item4' ).slideUp(); $( '#item3' ).slideUp(); $( '#item2' ).slideUp(); $( '#item1' ).slideToggle();\" type=\"submit\" value=\"Conteúdo\" /></a>";
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
				echo "		<div id=\"item2\" style=\"display:none;\">";
				echo "			<input class=\"subtitulo\" type=\"text\" name=\"missao\" placeholder=\"Missão\" value=\"$missao\" /></br>";
				echo "			<textarea class=\"text\" type=\"text\" name=\"missaoconteudo\" placeholder=\"Conteúdo de 'Missão'\" rows=\"8\">$missaoconteudo</textarea></br>";
				echo "		<div>";
				if ($erro != null) {
					echo "$erro";
				}
				echo "			<input class=\"btnenviar\" type=\"submit\" name=\"enviar\" value=\"Enviar\" />";
				echo "		</div>";
				echo "		</div>";
				echo "		<div id=\"item3\" style=\"display:none;\">";
				echo "			<input class=\"subtitulo\" type=\"text\" name=\"visao\" placeholder=\"Visão\" value=\"$visao\" /></br>";
				echo "			<textarea class=\"text\" type=\"text\" name=\"visaoconteudo\" placeholder=\"Conteúdo de 'Visão'\" rows=\"8\">$visaoconteudo</textarea></br>";
				echo "		<div>";
				if ($erro != null) {
					echo "$erro";
				}
				echo "			<input class=\"btnenviar\" type=\"submit\" name=\"enviar\" value=\"Enviar\" />";
				echo "		</div>";
				echo "		</div>";
				echo "		<div id=\"item4\" style=\"display:none;\">";
				echo "			<input class=\"subtitulo\" type=\"text\" name=\"valores\" placeholder=\"Valores\" value=\"$valores\" /></br>";
				echo "			<textarea class=\"text\" type=\"text\" name=\"valoresconteudo\" placeholder=\"Conteúdo de 'Valores'\" rows=\"8\">$valoresconteudo</textarea></br>";
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