<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" >
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Nest</title>
	<link rel="shortcut icon" href="assets/img/logoAzul2.png"/>
	<link type="text/css" rel="stylesheet" href="assets/css/main.css"/>
	<script type="text/javascript" src="assets/js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery-migrate-1.2.1.min.js"></script>
	<!--
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	-->
<?php
	require_once('system/connection.php');

	$menulogin = null;
	$menulogin2 = null;
	$prioridade1 = null;
	$bemvindo = null;
	$erro = null;
	$color = "blue";

	function getGet($key){
		return isset( $_GET[$key] ) ? $_GET[$key] : null;
	}
	$pg = getGet('pg');
	if ($pg == null):
		$pg = "content/index.php";
	elseif ($pg != 'content/index.php'
	 || $pg != 'content/software.php'
	 || $pg != 'content/quem-somos.php'
	 || $pg != 'content/contato.php'
	 || $pg != 'content/login.php'
	 || $pg != 'authenticate/user.php'
	 || $pg != 'authenticate/funcionario.php'
	 || $pg != 'authenticate/notificacao.php'):
	else:
		$pg = "erro/erro_404.php";
	endif;

	$content = is_file( $pg.'.php' ) ? $pg.'.php' : $pg;
	
	$indexpage = "offpage";
	$softwarepage = "offpage";
	$quemsomospage = "offpage";
	$contatopage = "offpage";
	$loginpage = "offpage";
	$notificacaopage = "offpage";
	$funcionariopage = "offpage";
	$adminpage = "offpage";
	$userpage = "offpage";
	
	if ($pg == "content/index.php" && $content == "content/index.php"):
		$indexpage = "active";
	elseif ($pg == "content/software.php" && $content == "content/software.php"):
		$softwarepage = "active";
	elseif ($pg == "content/quem-somos.php" && $content == "content/quem-somos.php"):
		$quemsomospage = "active";
	elseif ($pg == "content/contato.php" && $content == "content/contato.php"):
		$contatopage = "active";
	elseif ($pg == "content/login.php" && $content == "content/login.php"):
		$loginpage = "active";
	elseif ($pg == "authenticate/notificacao.php" && $content == "authenticate/notificacao.php"):
		$adminpage = "active";
	elseif ($pg == "authenticate/funcionario.php" && $content == "authenticate/funcionario.php"):
		$adminpage = "active";
	elseif ($pg == "authenticate/user.php" && $content == "authenticate/user.php"):
		$userpage = "active";
	else:
	endif;
	
	session_start();
	if ((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)):
		unset($_SESSION['nome']);
		unset($_SESSION['login']);
		unset($_SESSION['senha']);
		unset($_SESSION['prioridade']);
		
		$welcome = "";
		$menulogin = "
		<li class=\"right fix-sub\" style=\"display: block;\">
			<a href=\"#\">Login</a>
			<div class=\"megamenu half-width login\">
				<div class=\"row\">
					<form action=\"\" method=\"post\">
		";
		
		if (isset($_POST['enviar'])):
			$login = $_POST['login'] = preg_replace('/[^[:alpha:]_]/', '',$_POST['login']);
			$senha = $_POST['senha'] = preg_replace('/[^[:alpha:]_]/', '',$_POST['senha']);
			if ($login == ""):
				$erro = "<div><span class=\"erro\">Informe seu Usuário!</span></div>";
			elseif ($senha == ""):
				$erro = "<div><span class=\"erro\">Informe sua Senha!</span></div>";
			else:
				$result = mysqli_query($connection, "SELECT * FROM `funcionario` WHERE `login_fun` = '$login' and `senha_fun` = '$senha' and `status_fun` = 0");
			
				if (mysqli_num_rows($result) != ""):
			
					while ($sql = mysqli_fetch_array($result)):
						$_SESSION['nome'] = $sql[1];
						$_SESSION['login'] = $sql[2];
						$_SESSION['senha'] = $sql[3];
						$_SESSION['prioridade'] = $sql[4];
						header('location:index.php?pg=authenticate/user.php');
					endwhile;

				else:
					$erro = "<div><span class=\"erro\">Usuário não existe!</span></div>";
				endif;
			endif;
			if ($erro != null):
			else:
				$erro = null;
			endif;
		endif;
		$menulogin2 = "
					<input type=\"text\" class=\"text\" name=\"login\" placeholder=\"Usuário\">
					<input type=\"password\" class=\"pass\" name=\"senha\" placeholder=\"Senha\" >
					$erro
					<input type=\"submit\" name=\"enviar\" value=\"Entrar\">
					</form>
				</div>
			</div>
		</li>";
	else:
		$nome = $_SESSION['nome'];
		$prioridade = $_SESSION['prioridade'];
		
		$prioridade1 = null;
		if ($prioridade == 1 or $prioridade == 3):
			$bemvindo = "
			<li class=\"right fix-sub\" id=\"$userpage\" style=\"\">
				<a class=\"$userpage\" href=\"#\">Bem-Vindo(a) $nome</a>
				<ul class=\"dropdown\" style=\"display: none;\">
					<li class=\"$userpage\" style=\"\">
						<a href=\"index.php?pg=authenticate/user.php\">Perfil</a>
					</li>
					<li class=\"\" style=\"\">
						<a href=\"authenticate/logout.php\">Sair</a>
					</li>
				</ul>
			</li>";
		elseif ($prioridade == 0 or $prioridade == 2):
			$bemvindo = "
			<li class=\"right fix-sub\" id=\"$userpage\" style=\"\">
				<a class=\"$userpage\" href=\"#\">Bem-Vindo(a) $nome</a>
				<ul class=\"dropdown\" style=\"display: none;\">
					<li class=\"$userpage\" style=\"\">
						<a href=\"index.php?pg=authenticate/user.php\">Perfil</a>
					</li>
					<li class=\"\" style=\"\">
						<a href=\"authenticate/logout.php\">Sair</a>
					</li>
				</ul>
			</li>";
			$prioridade1 = "
			<li class=\"$adminpage\" style=\"\">
				<a href=\"#\">Administrador</a>
				<ul class=\"dropdown\" style=\"display: none;\">
					<li class=\"$adminpage\" style=\"\">
						<a href=\"index.php?pg=authenticate/funcionario.php\">Funcionarios</a>
					</li>
					<li class=\"$adminpage\" style=\"\">
						<a href=\"index.php?pg=authenticate/notificacao.php\">Notificações</a>
					</li>
				</ul>
			</li>";
		else:
			$prioridade1 = "";
		endif;
	endif;
	
	$menu = "
	<ul id=\"jetmenu\" style=\"display: block;\" class=\"jetmenu $color\">
		<!--
		<li class=\"showhide\" style=\"display: none;\">
			<span class=\"title\">MENU</span>
			<span class=\"icon\">
				<em></em>
				<em></em>
				<em></em>
				<em></em>
			</span>
		</li>
		-->
		<li class=\"$indexpage\" style=\"\">
			<a href=\"index.php\">Nest</a>
		</li>
		<li class=\"$softwarepage\" style=\"\">
			<a href=\"index.php?pg=content/software.php\">Software</a>
		</li>
		<li class=\"$quemsomospage\" style=\"\">
			<a href=\"index.php?pg=content/quem-somos.php\">Quem Somos</a>
		</li>
		<li class=\"$contatopage\" style=\"\">
			<a href=\"index.php?pg=content/contato.php\">Contato</a>
		</li>
		$menulogin
		$menulogin2
		$prioridade1
		$bemvindo
	</ul>";
	?>

</head>
<body>
	<div class="content">
		<footer>
			Having issues with this website? Open a issue on <a id="logo" href="https://github.com/pedrojosawczuk/Nest-Site-TCC">GitHub</a>.</br>
			Made by <a id="logo" href="https://github.com/pedrojosawczuk">Pedro</a> and <a id="logo" href="https://github.com/Hugo-benjamim">Hugo</a> with ❤️
		</footer>

		<?php
			echo "$menu";
			echo "<div class=\"body-content\">";
			include_once($content);
			echo "</div>";
		?>

	</div>

<?php
	if($content == "content/index.php"):
		?>

		<link type="text/css" rel="StyleSheet" href="assets/slider/css/sldshw.css">
		<link type="text/css" rel="StyleSheet" href="assets/slider/css/supersized.css">
		<script type="text/javascript" src="assets/slider/js/sldshw.js"></script>
		<script src="assets/slider/js/supersized.3.2.7.min.js"></script>
		<script src="assets/slider/js/supersized-init.js"></script>
		
		<?php
	endif;
?>

</body>
	<script type="text/javascript" src="assets/js/script.js"></script>
	<script type="text/javascript" src="assets/js/jquery.cookie.js"></script>
	<script type="text/javascript" src="assets/js/jquery.outros.js"></script>
	
<?php
	//<script type="text/javascript" src="assets/js/jquery.editar.js"></script>
	//<script type="text/javascript" src="assets/slide/js/javascriptbackground.js"></script>
?>
</html>