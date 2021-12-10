<?php
	$erro = null;
	$editarerro = null;
	$contatoerro = null;
	$email_validar = null;

	$result = mysqli_query($connection, "SELECT * FROM pagina WHERE id_pagina = 4;");
	
	while ($row = mysqli_fetch_row($result)):
		$titulo = $row[1];
		$subtitulo = $row[2];
		$img = $row[3];
		$conteudo = $row[4];
		
		echo "<output class=\"pagetitulo\">$titulo</output></br>";
		echo "<output class=\"pagesubtitulo\">$subtitulo</output></br>";
		if ($img != null):
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
				if($titulo == null):
					$editarerro = "<div><span class=\"erro\">Informe o Titulo!</span></div>";
				elseif($subtitulo == null):
					$editarerro = "<div><span class=\"erro\">Informe o Subtitulo!</span></div>";
				elseif($conteudo == null):
					$editarerro = "<div><span class=\"erro\">Informe o Conteúdo!</span></div>";
				else:
					$result = mysqli_query($connection, "UPDATE `pagina` SET `id_pagina` = 4,`titulo_1` = '$titulo',`sub_titulo_1` = '$subtitulo',`imagem_1` = '$imagem',`paragrafo_1` = '$conteudo' WHERE `id_pagina` = 4;");
					header('location:index.php?pg=content/contato.php');
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
								<input class="imagem" type="text" name="imagem" placeholder="Imagem" value="<?php echo "$img"; ?>" /></br>
								<textarea class="text" type="text" name="conteudo" placeholder="Conteúdo" rows="8"><?php echo "$conteudo"; ?></textarea>

								<?php
									if ($erro !="vazia"):
										echo "$editarerro";
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
	else:
		$contato	= null;
		if(isset($_POST['falar'])):
			require_once "PHPMailer/class.phpmailer.php";
			require_once "PHPMailer/class.smtp.php";
			require_once('system/smtp.php');

			$empresa	= "Grupo Nest";
			$mensagem	= null;
			$mensagem2	= null;
			
			$nome		= addslashes(trim($_POST['nome']));
			$email		= addslashes(trim($_POST['email']));
			$assunto	= addslashes(trim($_POST['assunto']));
			$mensagem	= addslashes(trim($_POST['mensagem']));
			
			$assunto2	= "Resposta Automatica \"".$assunto."\"";
			$words = explode(" ", $nome);
			$primeironome = $words[0]; //<=Primeira palavra:
			$sobrenome = $words[count($words)-1]; //<=Última palavra:
			
			if (empty($nome)):
				$erro = "<span class=\"erro\">Digite um nome</span>";
			elseif (empty($email)):
				$erro = "<span class=\"erro\">Digite um email</span>";
			elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)):
				$erro = "<span class=\"erro\">E-mail invalido</span>";
			elseif (empty($assunto)):
				$erro = "<span class=\"erro\">Digite um assunto</span>";
			elseif (empty($mensagem)):
				$erro = "<span class=\"erro\">Digite uma mensagem</span>";
			elseif (empty($mensagem)):
				$erro = "<span class=\"erro\">Digite uma mensagem</span>";
			else:
				$cabecalho	= "<!--<p>Email enviado por : ".$empresa." na data ".date("d/m/Y")."</p></br>\n-->";
				$mensagem2	.= "<div style=\"\">";
				$mensagem2	.= "	<div style=\"font-size: 30px; a:link {color: #777; text-decoration: none;} a:hover { color: #fff; text-decoration: underline; } a:active { color: #ddd; text-decoration: underline;} a:visited {color: #777; text-decoration: none;}\">";
				$mensagem2	.= "		<a href=\"https://nestsitetcc.herokuapp.com/\"><h2>".$empresa."</h2></a>";
				$mensagem2	.= "	</div>";
				$mensagem2	.= "	<div style=\"\">";
				$mensagem2	.= "<h3>Essa mensagem é automatica</h3>";
				$mensagem2	.= "Recebemos sua mensagem senhor(a) <b>".$primeironome." ".$sobrenome."</b>";
				$mensagem2	.= " sobre <b>\"".$assunto."\"</b>";
				$mensagem2	.= ", sua mensagem </p><b>\"";
				$mensagem2	.= addslashes(trim($_POST['mensagem']));
				$mensagem2	.= "\"</b></p>. ";
				$mensagem2	.= "Aguarde contato em breve";
				$mensagem2	.= "";
				$mensagem2	.= "Atenciosamente,";
				$mensagem2	.= "Grupo Nest.";
				$mensagem2	.= "	</div>";
				$mensagem2	.= "</div>";
				$erro		= array();
				
				//mandar o email se passar nas validacoes
				$mail = new PHPMailer();
				//$mail->IsMail();
				//$mail->SMTPDebug = 2;
				$mail->CharSet = "UTF-8";
				$mail->SMTPSecure = "tls";
				$mail->IsSMTP();
				$mail->Host = $host;
				//$mail->Port = $port;
				$mail->SMTPAuth = true;
				$mail->Username = $usuario;
				$mail->Password = $ahnes;
				$mail->IsHTML(true);
				$mail->SetFrom($email);
				//$mail->From = $email;
				$mail->FromName = $empresa;
				$mail->AddAddress($email);
				$mail->Subject = $assunto2;
				//$mail->AddAttachment($arquivo_temporario,$arquivo);
				$mail->Body = $cabecalho.$mensagem2;
				
				// Insere no banco de dados a mensagem de contato
				$result = mysqli_query($connection, "INSERT INTO `mensagem`(`id_msg`, `nome_msg`, `email_msg`, `tema_msg`, `mensagem_msg`) VALUES ('', '$nome', '$email', '$assunto', '$mensagem');");
				
				if ($mail->Send()):
					//Se mandou email cadastra no banco
					$contato = "Mensagem enviada com sucesso!";
				else:
					//Se não mandou mostra mensagem de erro
					$contato = "Erro \"".$mail->ErrorInfo."\", mensagem não pode ser enviada!";
				endif;
			endif; //empty arquivo
		endif;
		echo "<center>";
		echo "<div class=\"$color\">";
		echo "<li style=\"display: block;\">";
		echo "<div class=\"megamenu half-width\">";
		echo "<div class=\"row\">";
		echo "<form method=\"post\" action=\"\">";
		echo "	<input id=\"nome\" type=\"text\" name=\"nome\" placeholder=\"Nome\"/>";
		echo "	<input id=\"email\" type=\"text\" name=\"email\" placeholder=\"E-mail\"/>";
		echo "	<input id=\"assunto\" type=\"text\" name=\"assunto\" placeholder=\"Assunto\"/>";
		//if ($infonotificacao != null) {
		//	echo "$infonotificacao";
		//}
		echo "	";
		echo "	<textarea class=\"text\" type=\"text\" name=\"mensagem\" rows=\"8\" placeholder=\"Mensagem\"></textarea>";
		if ($contato != null):
			echo "<label>";
			echo "$contato";
			echo "</label>";
			/*
		elseif ($erro != null):
			echo $erro;
			*/
		else:
			echo "";
		endif;
		echo "		<input class=\"btnfalar\" type=\"submit\" name=\"falar\" value=\"Enviar\" />";
		echo "</form>";
		echo "</div>";
		echo "</div>";
		echo "</li>";
		echo "</div>";
		echo "</center>";
	endif;
?>