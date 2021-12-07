<div class="content">
		<link type="text/css" rel="StyleSheet" href="assets/css/index2.css">
		<script type="text/javascript" src="assets/js/javascript.js"></script>
	<?php
		//echo "Index";
		//require_once('system\connection.php');
		
		$result = mysqli_query($connection, "SELECT * FROM pagina WHERE id_pagina = 1;");
	
		echo "<div id=\"index\">";
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
			
			echo "<center>";
			echo "<div>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "$ttitulo";
			echo "$ssubtitulo";
			echo "</center>";
			?>
			<div class="slideshow">
			</div>
			
			<?php
			echo "</div>";
			if ($img != "") {
				echo "$image";
			}
			echo "$cconteudo";		
			?>
			
			
	<?php	
/*	
		<div id="item1" class="item">
			<a name="item1"></a>
			<div class="content">item1 
				<a href="#item1" class="panel">1</a> | 
				<a href="#item2" class="panel">2</a> | 
				<a href="#item3" class="panel">3</a>
			</div>
		</div>
		
		<div class="item"></div>
		<div class="item"></div>
		<div class="clear"></div>

		<!-- second row -->		
		
		<div class="item"></div>

		<div id="item2" class="item">
			<a name="item2"></a>
			<div class="content">item2 <a href="#item1" class="panel">back</a></div>
		</div>

		<div class="item"></div>
		<div class="clear"></div>
		
		<!-- third row -->

		<div class="item"></div>
		<div class="item"></div>

		<div id="item3" class="item">
			<a name="item3"></a>
			<div class="content">item3 <a href="#item1" class="panel">back</a></div>
		</div>
		
		<div class="clear"></div>

	</div>
</div>
*/?>
		<?php
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
						$result = mysqli_query($connection, "UPDATE `pagina` SET `id_pagina` = 1,`titulo_1` = '$titulo',`sub_titulo_1` = '$subtitulo',`imagem_1` = '$imagem',`paragrafo_1` = '$conteudo' WHERE `id_pagina` = 1;");
						header('location:index.php');
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
 <script type="text/javascript" src="assets/js/javascriptbackground.js"></script>
</div>