<?php
	$result = mysqli_query($connection, "SELECT * FROM pagina WHERE id_pagina = 3;");
	
	while ($row = mysqli_fetch_row($result)):
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
		if ($img != null):
			echo "<img class=\"pageimg\" src=\"$img\">";
		endif;
		echo "<p><div class=\"pageconteudo\">$conteudo</div></p>";

		echo "<output class=\"pagesubtitulo\">$missao</output></br>";
		if ($missaoimg != null):
			echo "<img class=\"pageimg\" src=\"$missaoimg\">";
		endif;
		echo "<p><div class=\"pageconteudo\">$missaoconteudo</div></p>";

		echo "<output class=\"pagesubtitulo\">$visao</output></br>";
		if ($visaoimg != null):
			echo "<img class=\"pageimg\" src=\"$visaoimg\">";
		endif;
		echo "<p><div class=\"pageconteudo\">$visaoconteudo</div></p>";

		echo "<output class=\"pagesubtitulo\">$valores</output></br>";
		if ($valoresimg != null):
			echo "<img class=\"pageimg\" src=\"$valoresimg\">";
		endif;
		echo "<p><div class=\"pageconteudo\">$valoresconteudo</div></p>";
	endwhile;
	
	if ((isset ($_SESSION['login']) == true) and (isset ($_SESSION['senha']) == true)):
		$prioridade = $_SESSION['prioridade'];
		
		if ($prioridade == 0 or $prioridade == 1):
			if (isset($_POST['enviar'])):
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
				if ($titulo == ""):
					$erro = "<div><span class=\"erro\">Informe o Titulo!</span></div>";
				elseif ($subtitulo == ""):
					$erro = "<div><span class=\"erro\">Informe o Subtitulo!</span></div>";
				elseif ($conteudo == ""):
				$erro = "<div><span class=\"erro\">Informe o Conteúdo!</span></div>";
				elseif ($missao == ""):
					$erro = "<div><span class=\"erro\">Informe o título de \"Missão\"!</span></div>";
				elseif ($missaoconteudo == ""):
					$erro = "<div><span class=\"erro\">Informe o conteúdo de \"Missão\"!</span></div>";
				elseif ($visao == ""):
					$erro = "<div><span class=\"erro\">Informe o título de \"Visão\"!</span></div>";
				elseif ($visaoconteudo == ""):
					$erro = "<div><span class=\"erro\">Informe o conteúdo de \"Visão\"!</span></div>";
				elseif ($valores == ""):
					$erro = "<div><span class=\"erro\">Informe o título de \"Valores\"!</span></div>";
				elseif ($valoresconteudo == ""):
					$erro = "<div><span class=\"erro\">Informe o conteúdo de \"Valores\"!</span></div>";
				else:
					$result = mysqli_query($connection, "UPDATE `pagina` SET `id_pagina` = 3,`titulo_1` = '$titulo',`sub_titulo_1` = '$subtitulo',`imagem_1` = '$imagem',`paragrafo_1` = '$conteudo',`sub_titulo_2` = '$missao',`imagem_2` = '',`paragrafo_2` = '$missaoconteudo',`sub_titulo_3` = '$visao',`imagem_3` = '',`paragrafo_3` = '$visaoconteudo',`sub_titulo_4` = '$valores',`imagem_4` = '',`paragrafo_4` = '$valoresconteudo' WHERE `id_pagina` = 3;");
					header('location:index.php?pg=content/quem-somos.php');
				endif;
			endif;
			?>

			<div class="editar <?php echo "$color"; ?>">
				<input class="btnmostrar" Onclick="$( '#item4' ).slideToggle(); $( '#item3' ).slideUp(); $( '#item2' ).slideUp(); $( '#item1' ).slideUp();" type="submit" value="Valores"/>
				<input class="btnmostrar" Onclick="$( '#item4' ).slideUp(); $( '#item3' ).slideToggle(); $( '#item2' ).slideUp(); $( '#item1' ).slideUp();" type="submit" value="Visão"/>
				<input class="btnmostrar" Onclick="$( '#item4' ).slideUp(); $( '#item3' ).slideUp(); $( '#item2' ).slideToggle(); $( '#item1' ).slideUp();" type="submit" value="Missão"/>
				<input class="btnmostrar" Onclick="$( '#item4' ).slideUp(); $( '#item3' ).slideUp(); $( '#item2' ).slideUp(); $( '#item1' ).slideToggle();" type="submit" value="Conteúdo"/>
				<form method="post" action="">
					<li style="display:block;">
						<div class="megamenu half-width" id="item1" style="display:none;">
							<div class="row">
								<input class="titulo" type="text" name="titulo" placeholder="Titulo" value="<?php echo "$titulo"; ?>"/></br>
								<input class="subtitulo" type="text" name="subtitulo" placeholder="Subtitulo" value="<?php echo "$subtitulo"; ?>"/></br>
								<input class="imagem" type="text" name="imagem" placeholder="Imagem" value="<?php echo "$img"; ?>" /></br>
								<textarea class="text" type="text" name="conteudo" placeholder="Conteúdo" rows="8"><?php echo "$conteudo"; ?></textarea>
								
								<?php
									if ($erro != null):
										echo "$erro";
									endif;
								?>

								<input class="btnenviar" type="submit" name="enviar" value="Enviar"/>
							</div>
						</div>
					</li>
					<li style="display:block;">
						<div class="megamenu half-width" id="item2" style="display:none;">
							<div class="row">
								<input class="subtitulo" type="text" name="missao" placeholder="Missão" value="<?php echo "$missao"; ?>"/></br>
								<textarea class="text" type="text" name="missaoconteudo" placeholder="Conteúdo de 'Missão'" rows="8"><?php echo "$missaoconteudo"; ?></textarea>
								
								<?php
									if ($erro != null):
										echo "$erro";
									endif;
								?>

								<input class="btnenviar" type="submit" name="enviar" value="Enviar"/>
							</div>
						</div>
					</li>
					<li style="display:block;">
						<div class="megamenu half-width" id="item3" style="display:none;">
							<div class="row">
								<input class="subtitulo" type="text" name="visao" placeholder="Visão" value="<?php echo "$visao"; ?>"/></br>
								<textarea class="text" type="text" name="visaoconteudo" placeholder="Conteúdo de 'Visão'" rows="8"><?php echo "$visaoconteudo"; ?></textarea>
								
								<?php
									if ($erro != null):
										echo "$erro";
									endif;
								?>

								<input class="btnenviar" type="submit" name="enviar" value="Enviar"/>
							</div>
						</div>
					</li>
					<li style="display:block;">
						<div class="megamenu half-width" id="item4" style="display:none;">
							<div class="row">
								<input class="subtitulo" type="text" name="valores" placeholder="Valores" value="<?php echo "$valores"; ?>"/></br>
								<textarea class="text" type="text" name="valoresconteudo" placeholder="Conteúdo de 'Valores'" rows="8"><?php echo "$valoresconteudo"; ?></textarea></br>
								
								<?php
									if ($erro != null):
										echo "$erro";
									endif;
								?>

								<input class="btnenviar" type="submit" name="enviar" value="Enviar"/>
							</div>
						</div>
					</li>
				</form>
			</div>

			<?php
		endif;
	endif;
?>