
<div class="megamenu half-width login">
<div class="row">
<ul id="login" style="padding-left: 0px;">
<li style="display: block;">
	<form action="" method="post">
	<?php
		$erro = "vazio";
		
		if(isset($_POST['enviar'])){
			$login = $_POST['login'];
			$senha = $_POST['senha'];
			if($login == "") {
				$erro = "<div><span class=\"erro\">Informe seu Usuário!</span></div>";
			}
			else if($senha == "") {
				$erro = "<div><span class=\"erro\">Informe sua Senha!</span></div>";
			}
			else {
				//require_once('system\connection.php');
				// $connection = mysql_connect("localhost", "root", "") or die ("<p>Sem conexão com o servidor, desculpe-nos o transtorno</p>");
				// $select = mysql_select_db("bd_nest_site") or die("<p>Sem acesso ao DataBase, Entre em contato com os Administradores:<br> pedrojoaodeoliveira@gmail.com</p>");
				$result = mysqli_query($connection, "SELECT * FROM `funcionario` WHERE `login_fun` = '$login' and `senha_fun` = '$senha'");

				if(mysqli_num_rows($result) != "") {
					while ($sql = mysqli_fetch_array($result)) {
						$_SESSION['nome'] = $sql[1];
						$_SESSION['login'] = $sql[2];
						$_SESSION['senha'] = $sql[3];
						$_SESSION['prioridade'] = $sql[4];
						header('location:index.php?pg=authenticate/user.php');
					}
				}
				else {
					$erro = "<div><span class=\"erro\">Usuário não existe!</span></div>";
				}
			}	
		}
		
	?>
		<input type="text" name="login" placeholder="Usuário"/><br>
		<input type="password" name="senha" placeholder="Senha" /><br>
			<?php
			if ($erro != "vazio") {
				echo "$erro";
			}
			?>
			<input type="submit" name="enviar" value="Logar" />
	</form>
</li>
</ul>
</div>
</div>