<div class="content">
	<meta name="robots" content="noindex">
	<meta name="googlebot" content="noindex">
	<link type="text/css" rel="StyleSheet" href="assets/css/user.css">
	<?php
	if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)) {
		unset($_SESSION['nome']);
		unset($_SESSION['login']);
		unset($_SESSION['senha']);
		unset($_SESSION['prioridade']);
		
		header('location:index.php');
	}
	
	$login = $_SESSION['login'];
	$senha = $_SESSION['senha'];
	
	/*
	$con = mysql_connect("localhost", " root", "") or die (header('location:index.php?pg=erro/erro_500.php'));
	$select = mysql_select_db("bd_nest_site") or die(header('location:index.php?pg=content/login.php'));
	*/
	$result = mysqli_query($connection, "SELECT * FROM `funcionario` WHERE `login_fun` = '$login' AND `senha_fun`= '$senha'");
	
	echo "<div id=\"user\">";
	while ($sql = mysqli_fetch_array($result)) {
	echo "<p>";
		$fun_id = $sql[0];
		$fun_nome = $sql[1];
		$fun_login = $sql[2];
		//$fun_senha = $sql[3];
		$fun_prioridade = $sql[4];
		$fun_cargo = $sql[5];
		$fun_salario = $sql[6];
		$fun_comentario = $sql[7];
		$fun_cadastro_data = $sql[9];
		$fun_alterar_data = $sql[10];
		if($fun_cadastro_data == null):
			$fun_cadastro_data = "Não foi cadastrado pelo site";
		endif;
		if($fun_alterar_data == null):
			$fun_alterar_data = "Nunca foi alterado";
		endif;
		echo "<br>";
		echo "<br>";
		echo "<br>";
		echo "<br>";
		echo "<div id=\"perfil\">";
		echo "<output class=\"pagetitulo\">Perfil</output>";
		echo "<p>";
		echo "	<p><label>Id: </label><span>$fun_id</span></p>";
		echo "	<label>Nome: </label><span>$fun_nome</span>";
		echo "	<p><label>Login: </label><span>$fun_login</span></p>";
		//echo "	<p><label>Senha: </label><span>$fun_senha</span></p>";
		echo "	<label>Senha: </label><span>*********</span></p>";
		echo "	<p><label>Data de cadastro: </label><span>$fun_cadastro_data</p>";
		echo "	<label>Última alteração: </label><span>$fun_alterar_data </br>";
		if ($fun_prioridade == 0) {
			$fun_prioridade = "Administrador Total";
		}
		else if ($fun_prioridade == 1) {
			$fun_prioridade = "Administrador do Site";
		}
		else if ($fun_prioridade == 2 ) {
			$fun_prioridade = "Administrador de Pessoal";
		}
		else {
			$fun_prioridade = "Acesso Basíco";
		}
		echo "	<p><label>Prioridade: </label><span>$fun_prioridade</span></p>";
		echo "	<p><label>Cargo: </label><span>$fun_cargo</span></p>";
		echo "	<p><label>Salário: </label><span>$fun_salario</span></p>";
		echo "	<p><label>Comentario: </label><span>$fun_comentario</span></p>";
		echo "</p></div>";
	}
	echo "</div>";
	echo "<br>";
	
	if($fun_id != 1) {
		if(isset($_POST['alterar'])) {
			$loginatual = $_POST['loginatual'] = preg_replace('/[^[:alpha:]_]/', '',$_POST['loginatual']);
			$senhaatual = $_POST['senhaatual'] = preg_replace('/[^[:alpha:]_]/', '',$_POST['senhaatual']);
			$novologin = $_POST['novologin'] = preg_replace('/[^[:alpha:]_]/', '',$_POST['novologin']);
			$novasenha = $_POST['novasenha'] = preg_replace('/[^[:alpha:]_]/', '',$_POST['novasenha']);
			$repetirnovasenha = $_POST['repetirnovasenha'] = preg_replace('/[^[:alpha:]_]/', '',$_POST['repetirnovasenha']);
			$alterar_data = date('j F Y');
		
			if($loginatual == ""):
				$erro = "<div><span class=\"erro\">Informe o 'Login atual'!</span></div>";
			elseif($senhaatual == ""):
				$erro = "<div><span class=\"erro\">Informe o 'Senha atual'!</span></div>";
			elseif($novologin == ""):
				$erro = "<div><span class=\"erro\">Informe o 'novo Login'!</span></div>";
			elseif($novasenha == ""):
				$erro = "<div><span class=\"erro\">Informe o 'nova Senha'!</span></div>";
			elseif($repetirnovasenha == ""):
				$erro = "<div><span class=\"erro\">Informe o 'repetir nova Senha'!</span></div>";
			elseif($loginatual != $login):
				$erro = "<div><span class=\"erro\">Login atual invalido!</span></div>";
			elseif($senhaatual != $senha):
				$erro = "<div><span class=\"erro\">Senha atual invalida!</span></div>";		
			elseif($novasenha != $repetirnovasenha):
				$erro = "<div><span class=\"erro\">Campos 'Nova Senha' e 'Repetir nova Senha' estão diferentes!</span></div>";
			else:
				$result = mysqli_query($connection, "UPDATE `funcionario` SET `login_fun` = '$novologin',`senha_fun` = '$novasenha',`alterar_fun` = '$alterar_data' WHERE `id_fun` = '$fun_id';");
				$_SESSION['login'] = $novologin;
				$_SESSION['senha'] = $novasenha;
				header('location:authenticate/logout.php');
				//header('location:index.php?pg=authenticate/user.php');
			endif;
		}
	?>
	<div class="editar">
		<a href="#"><input class="btnmostrar" Onclick="$( '#item2' ).slideUp(); $( '#item1' ).slideToggle();" type="submit" value="Dados de autenticação" /></a>
		<form method="post" action="">
			<div id="item1" style="display:none;">
				<input class="text" name="loginatual" placeholder="Login atual" /></br>
				<input class="text" name="senhaatual" placeholder="Senha atual" type="password" /></br>
				<input class="text" name="novologin" placeholder="Novo login" /></br>
				<input class="text" name="novasenha" placeholder="Nova senha" type="password" /></br>
				<input class="text" name="repetirnovasenha" placeholder="Repetir nova senha" type="password" /></br>
				<div>
	<?php
		if ($erro != null):
			echo "$erro";
		endif;
	?>
					<input class="btnenviar" type="submit" name="alterar" value="Alterar" />
				</div>
			</div>
		</form>
	</div>
	<?php
		}
	?>
</div>