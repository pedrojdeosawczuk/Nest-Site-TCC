<?php
	if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)):
		unset($_SESSION['nome']);
		unset($_SESSION['login']);
		unset($_SESSION['senha']);
		unset($_SESSION['prioridade']);
		
		header('location:index.php?pg=content/login.php');
	endif;
	$prioridade = $_SESSION['prioridade'];
	
	if ($prioridade == 0 or $prioridade == 2):
		$result = mysqli_query($connection, "SELECT * FROM `mensagem`");

		$sms_all = 0;
		while ($sms = mysqli_fetch_array($result)):
			$sms_all = $sms_all + 1;
		endwhile;
?>
		<div id="notificacao">
		<label id="title_menssage">Mensagens (<?php echo $sms_all; ?>)</label>
		<?php
			if ($sms_all==0):
		?>
			<p><?php echo $nome; ?>, Sem mensagens recebidas recentemente, ou todas as mensagens foram apagadas do banco de dados!</p>
		<?php
			endif;

		$result = mysqli_query($connection, "SELECT * FROM `mensagem`");
			
		while ($sql = mysqli_fetch_array($result)):
			echo "<p>";
			$sms_all = $sms_all + 1;
		
			$fc_id = $sql[0];
			$fc_nome = $sql[1];
			$fc_email = $sql[2];
			$fc_assunto = $sql[3];
			$fc_conteudo = $sql[4];
			?>
				<div class="notificacoes">
					<a href="#">
						<label Onclick="$( '#<?php echo $fc_id; ?>' ).slideToggle()">Assunto da mensagem: "<?php echo $fc_assunto; ?>"</label></a></br>
					<div id="<?php echo $fc_id; ?>" style="display: none;">
						Código da mensagem: <?php echo $fc_id; ?> </br>
						Nome do remetente: <?php echo $fc_nome; ?> </br>
						E-mail: <?php echo $fc_email; ?> </br>
						Assunto: <?php echo $fc_assunto; ?> </br>
						Conteúdo: <?php echo $fc_conteudo; ?> </br>
					</div>
				</div>
			</p>
		<?php
		endwhile;
		?>
		</div>
		<?php
		if ((isset ($_SESSION['login']) == true) and (isset ($_SESSION['senha']) == true)):
			$prioridade = $_SESSION['prioridade'];
			
			if (isset($_POST['excluir'])):
				$id = $_POST['id'];
				if($id == ""):
					$erro = "<div><span class=\"erro\">Informe o Código da mensagem!</span></div>";
				else:
					$result = mysqli_query($connection, "DELETE FROM `mensagem` WHERE `id_msg` = '$id';");
					header('location:index.php?pg=authenticate/notificacao.php');
				endif;
			endif;

			$contato	= null;
			if(isset($_POST['enviar'])):
				require_once "PHPMailer/class.phpmailer.php";
				require_once "PHPMailer/class.smtp.php";
				require_once('system/smtp.php');
				
				$empresa	= "Grupo Nest";
				$mensagem	= null;
				$mensagem2	= null;
				
				//$nome		= addslashes(trim($_POST['nome']));
				$email		= addslashes(trim($_POST['email']));
				$assunto	= addslashes(trim($_POST['assunto']));
				$mensagem	= addslashes(trim($_POST['mensagem']));
				
				//$assunto2	= "Resposta Automatica \"".$assunto."\"";
				$assunto2	= "\"".$assunto."\"";
				//$words = explode(" ", $nome);
				//$primeironome = $words[0]; //<=Primeira palavra:
				//$sobrenome = $words[count($words)-1]; //<=Última palavra:
				/*
				if (empty($nome)):
					$erro = "<span class=\"erro\">Digite um nome</span>";
				else
				*/
				if (empty($email)):
					$erro = "<span class=\"erro\">Digite um email</span>";
				elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)):
					$erro = "<span class=\"erro\">E-mail invalido</span>";
				elseif (empty($assunto)):
					$erro = "<span class=\"erro\">Digite um assunto</span>";
				elseif (empty($mensagem)):
					$erro = "<span class=\"erro\">Digite uma mensagem</span>";
				else:
					$cabecalho	= "<!--<p>Email enviado por : ".$empresa." na data ".date("d/m/Y")."</p></br>\n-->";
					$mensagem2	.= "<div style=\"\">";
					$mensagem2	.= "	<div style=\"font-size: 30px; a:link {color: #777; text-decoration: none;} a:hover { color: #fff; text-decoration: underline; } a:active { color: #ddd; text-decoration: underline;} a:visited {color: #777; text-decoration: none;}\">";
					$mensagem2	.= "		<a href=\"https://nestsitetcc.herokuapp.com/\"><h2>".$empresa."</h2></a>";
					$mensagem2	.= "	</div>";
					$mensagem2	.= "	<div style=\"\">";
					/*
					$mensagem2	.= "<h3>Essa mensagem é automatica</h3>";
					$mensagem2	.= "Recebemos sua mensagem senhor(a) <b>".$primeironome." ".$sobrenome."</b>";
					$mensagem2	.= " sobre <b>\"".$assunto."\"</b>";
					*/
					$mensagem2	.= "<p>";
					$mensagem2	.= addslashes(trim($_POST['mensagem']));
					$mensagem2	.= "</p>";
					/*
					$mensagem2	.= "<br>Aguarde contato em breve";
					$mensagem2	.= "<br>";
					*/
					$mensagem2	.= "Atenciosamente,";
					$mensagem2	.= "<br>Grupo Nest.";
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
					
					if ($mail->Send()):
						//se mandou email cadastra no banco
						$contato = "Mensagem enviada com sucesso!";
					else:
						//se nao mandou mostra mensagem de erro
						$contato = "Erro \"".$mail->ErrorInfo."\", mensagem não pode ser enviada!";
					endif;
				endif; //empty arquivo
			endif;
			?>
			<div class="editar <?php echo "$color"; ?>">
				<input class="btnmostrar" Onclick="$( '#item2' ).slideToggle(); $( '#item1' ).slideUp();" type="submit" value="Enviar E-mail"/>
				<input class="btnmostrar" Onclick="$( '#item2' ).slideUp(); $( '#item1' ).slideToggle();" type="submit" value="Excluir"/>
				<li style="display:block;">
					<div class="megamenu half-width" id="item1" style="display:none;">
						<div class="row">
							<form method="post" action="">
								<input class="text" type="text" name="id" placeholder="Id"/></br>
								<?php
									if ($erro != null):
										echo "$erro";
									endif;
								?>
								<input class="btnenviar" type="submit" name="excluir" value="Excluir" />
							</form>
						</div>
					</div>
				</li>
				<li style="display:block;">
					<div class="megamenu half-width" id="item2" style="display:none;">
						<div class="row">
							<form id="form" method="post" action="">
								<input class="text" type="text" name="email" placeholder="Para" /></br>
								<input class="text" type="text" name="assunto" placeholder="Assunto" /></br>
								<textarea class="text" name="mensagem" rows="8" placeholder="Mensagem"></textarea>
								<!--<input class="text" type="file" name="arquivo" />-->
								<?php
									if ($contato != null):
										echo "<label>";
										echo "$contato";
										echo "</label>";
									elseif ($erro != null):
										echo $erro;
									else:
										echo "";
									endif;
								?>
								<input class="btnenviar" type="submit" name="enviar" value="Enviar" />
							</form>
						</div>
					</div>
				</li>
			</div>
		<?php
		endif;
	else:
		header('location:authenticate/logout.php');
	endif;
?>