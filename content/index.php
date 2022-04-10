<?php
	$result = mysqli_query($connection, "SELECT * FROM pagina WHERE id_pagina = 1;");
	
	while ($row = mysqli_fetch_row($result)):
		$titulo = $row[1];
		$subtitulo = $row[2];
		$img = $row[3];
		$conteudo = $row[4];
		
		echo "<output class=\"pagetitulo\">$titulo</output></br>";
		echo "<output class=\"pagesubtitulo\">$subtitulo</output></br>";
		if ($img != ""):
			echo "<img class=\"pageimg\" src=\"$img\">";
		endif;
		echo "<p><div class=\"pageconteudo\">$conteudo</div></p>";
	endwhile;
	
	if ((isset ($_SESSION['login']) == true) and (isset ($_SESSION['senha']) == true)):
		$prioridade = $_SESSION['prioridade'];

		if ($prioridade == 0 or $prioridade == 1):
			if (isset($_POST['enviar'])):
				$titulo = $_POST['titulo'];
				$subtitulo = $_POST['subtitulo'];
				$imagem = $_POST['imagem'];
				$conteudo = $_POST['conteudo'];
				if($titulo == ""):
					$erro = "<div><span class=\"erro\">Informe o Titulo!</span></div>";
				elseif($subtitulo == ""):
					$erro = "<div><span class=\"erro\">Informe o Subtitulo!</span></div>";
				elseif($conteudo == ""):
					$erro = "<div><span class=\"erro\">Informe o Conteúdo!</span></div>";
				else:
					$result = mysqli_query($connection, "UPDATE `pagina` SET `id_pagina` = 1,`titulo_1` = '$titulo',`sub_titulo_1` = '$subtitulo',`imagem_1` = '$imagem',`paragrafo_1` = '$conteudo' WHERE `id_pagina` = 1;");
					header('location:index.php');
				endif;
			endif;
			?>

			<div class="editar <?php echo "$color"; ?>">
				<input class="btnmostrar" Onclick="$('#item1').slideToggle();" type="submit" value=" Conteúdo "/>
				<form method="post" action="">
					<li style="display:block;">
						<div class="megamenu half-width" id="item1" style="display:none;">
							<div class="row">
								<input class="titulo" type="text" name="titulo" placeholder="Titulo" value="<?php echo "$titulo"; ?>"/></br>
								<input class="subtitulo" type="text" name="subtitulo" placeholder="Subtitulo" value="<?php echo "$subtitulo"; ?>"/></br>
								<input class="imagem" type="text" name="imagem" placeholder="Imagem" value="<?php echo "$img"; ?>"/></br>
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
				</form>
			</div>

			<?php
		endif;
	endif;
?>