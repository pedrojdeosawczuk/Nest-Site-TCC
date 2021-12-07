<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" >
<head>
	<meta charset="utf-8">
	<?php
		require_once('system/connection.php');
		require_once('system/smtp.php');
		$menulogin = null;
		$menulogin2 = null;
		$prioridade1 = null;
		$bemvindo = null;
		$erro = null;
	?>
<!--
	<meta name="robots" content="noindex">
	<meta name="googlebot" content="noindex">
-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Nest</title>
	<link rel="shortcut icon" href="assets/img/logoAzul2.png"/>
	<link type="text/css" rel="stylesheet" href="assets/css/css"/>
	<link type="text/css" rel="StyleSheet" href="assets/css/index.css"/>
<!--
	<link type="text/css" rel="StyleSheet" href="assets/css/black.css"/>
	<link type="text/css" rel="StyleSheet" href="assets/css/grey.css"/>
	<link type="text/css" rel="StyleSheet" href="assets/css/green.css"/>
-->
	<link type="text/css" rel="StyleSheet" href="assets/css/blue.css"/>
<!--
	<link type="text/css" rel="StyleSheet" href="assets/css/emerald.css"/>
	<link type="text/css" rel="StyleSheet" href="assets/css/red.css"/>
	<link type="text/css" rel="StyleSheet" href="assets/css/pox.css"/>
	<link type="text/css" rel="StyleSheet" href="assets/css/orange.css"/>
	<link type="text/css" rel="StyleSheet" href="assets/css/sunburst.css"/>
	<link type="text/css" rel="StyleSheet" href="assets/css/deeper.css"/>
	<link type="text/css" rel="StyleSheet" href="assets/css/yellow.css"/>
	<link type="text/css" rel="StyleSheet" href="assets/css/purple.css"/>
	<link type="text/css" rel="StyleSheet" href="assets/css/pink.css"/>
-->
	<link type="text/css" rel="stylesheet" href="http://www.webpulse.com.br/jet/css/main.css"/>
	<script type="text/javascript" src="assets/js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery-migrate-1.2.1.min.js"></script>
	<!--<script type="text/javascript" src="assets/slide/js/javascript.js"></script>-->
<!--
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
-->
<?php
	$prioridade1 = null;
	$bemvindo = null;
			function getGet($key){
				return isset( $_GET[$key] ) ? $_GET[$key] : null;
			}
			$pg = getGet('pg');
			if ($pg == null) {
				$pg = "content/index.php";
			}
			else if ($pg != 'content/index.php'
			 || $pg != 'content/software.php'
			 || $pg != 'content/quem-somos.php'
			 || $pg != 'content/contato.php'
			 || $pg != 'content/login.php'
			 || $pg != 'authenticate/user.php'
			 || $pg != 'authenticate/funcionario.php'
			 || $pg != 'authenticate/notificacao.php') {
			}
			else {
				$pg = "erro/erro_404.php";
			}
			
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
			
			if ($pg == "content/index.php" && $content == "content/index.php") {
				$indexpage = "active";
			}
			else if ($pg == "content/software.php" && $content == "content/software.php") {
				$softwarepage = "active";
			}
			else if ($pg == "content/quem-somos.php" && $content == "content/quem-somos.php") {
				$quemsomospage = "active";
			}
			else if ($pg == "content/contato.php" && $content == "content/contato.php") {
				$contatopage = "active";
			}
			else if ($pg == "content/login.php" && $content == "content/login.php") {
				$loginpage = "active";
			}
			else if ($pg == "authenticate/notificacao.php" && $content == "authenticate/notificacao.php") {
				$adminpage = "active";
			}
			else if ($pg == "authenticate/funcionario.php" && $content == "authenticate/funcionario.php") {
				$adminpage = "active";
			}
			else if ($pg == "authenticate/user.php" && $content == "authenticate/user.php") {
				$userpage = "active";
			}
			else {
			}
			
			session_start();
			if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)) {
				unset($_SESSION['nome']);
				unset($_SESSION['login']);
				unset($_SESSION['senha']);
				unset($_SESSION['prioridade']);
				
				$welcome = "";
				$menulogin = "
				<li class=\"right fix-sub\" style=\"display: block;\">
					<a href=\"#\">Login</a>
						<div class=\"megamenu half-width login\">
							<form action=\"\" method=\"post\">
				";
				
				$erro = null;
				
				if(isset($_POST['enviar'])){
					$login = $_POST['login'] = preg_replace('/[^[:alpha:]_]/', '',$_POST['login']);
					$senha = $_POST['senha'] = preg_replace('/[^[:alpha:]_]/', '',$_POST['senha']);
					if($login == "") {
						$erro = "<div><span class=\"erro\">Informe seu Usuário!</span></div>";
					}
					else if($senha == "") {
						$erro = "<div><span class=\"erro\">Informe sua Senha!</span></div>";
					}
					else {
						$result = mysqli_query($connection, "SELECT * FROM `funcionario` WHERE `login_fun` = '$login' and `senha_fun` = '$senha' and `status_fun` = 0");
					
						if(mysqli_num_rows($result) != "") {
					
							while ($sql = mysql_fetch_array($result)) {
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
					if ($erro != null) {
					}
					else {
						$erro = null;
					}
				}
				$menulogin2 = "
							<input type=\"text\" class=\"text\" name=\"login\" placeholder=\"Usuario\">
							<input type=\"password\" class=\"pass\" name=\"senha\" placeholder=\"Senha\" >
							$erro
							<input id=\"btn_enviar\" type=\"submit\" name=\"enviar\" value=\"Logar\">
							</form>
						</div>
				</li>";				
			}
			else {
				$nome = $_SESSION['nome'];
				$prioridade = $_SESSION['prioridade'];
				
				$prioridade1 = null;
				if ($prioridade == 1 or $prioridade == 3) {
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
				}
				else if ($prioridade == 0 or $prioridade == 2) {
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
					</li>
					";
				}
				else {
					$prioridade1 = "";
				}
				
			}
			
				$menu = "
<ul id=\"jetmenu\" style=\"display: block;\" class=\"jetmenu blue\">


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

<!--
<li style=\"\">
<a href=\"content/gallery.php\">Galeria</a>
<div style=\"text-align: justify; display: hide; opacity: 1;\" class=\"megamenu half-width\">
	<div class=\"row\">
		<div class=\"col2\">
			<a href=\"#\">
				<img src=\"assets/img/galeria/1.jpg\" alt=\"image\">
			</a>
		</div>
		<div class=\"col2\">
			<a href=\"#\">
				<img src=\"assets/img/galeria/2.jpg\" alt=\"image\">
			</a>
		</div>
		<div class=\"col2\">
			<a href=\"#\">
				<img src=\"assets/img/galeria/3.jpg\" alt=\"image\">
			</a>
		</div>
	</div>
	<div class=\"row\">
		<div class=\"col2\">
			<a href=\"#\">
				<img src=\"assets/img/galeria/4.jpg\" alt=\"image\">
			</a>
		</div>
	<div class=\"col2\">
		<a href=\"#\">
			<img src=\"assets/img/galeria/5.jpg\" alt=\"image\">
		</a>
	</div>
	<div class=\"col2\">
		<a href=\"#\">
			<img src=\"assets/img/galeria/6.jpg\" alt=\"image\">
		</a>
	</div>
</div>
</div>
</li>
-->
<!--
<li style=\"\">
<a href=\"#\">Galeria</a>
<div style=\"text-align: justify; display: hide; opacity: 1;\" class=\"megamenu half-width\">
	<div class=\"row\">
		<div class=\"col2\">
			<a href=\"#\">
				<img src=\"assets/img/galeria/1.jpg\" alt=\"image\">
			</a>
		</div>
		<div class=\"col2\">
			<a href=\"#\">
				<img src=\"assets/img/galeria/2.jpg\" alt=\"image\">
			</a>
		</div>
		<div class=\"col2\">
			<a href=\"#\">
				<img src=\"assets/img/galeria/3.jpg\" alt=\"image\">
			</a>
		</div>
	</div>
	<div class=\"row\">
		<div class=\"col2\">
			<a href=\"#\">
				<img src=\"assets/img/galeria/4.jpg\" alt=\"image\">
			</a>
		</div>
	<div class=\"col2\">
		<a href=\"#\">
			<img src=\"assets/img/galeria/5.jpg\" alt=\"image\">
		</a>
	</div>
	<div class=\"col2\">
		<a href=\"#\">
			<img src=\"assets/img/galeria/6.jpg\" alt=\"image\">
		</a>
	</div>
</div>
</div>
</li>
-->
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
</ul>


<!--
<div class=\"options\" style=\"left: -310px;\">
<span class=\"tools\">
<i style=\"margin-top:9px; display: block\" class=\"icon-cog\"></i>
</span>
<div class=\"align\">
<span>Menu alignment</span>
<input id=\"left\" type=\"radio\" name=\"align\" value=\"left\" checked=\"\">Left<input id=\"right\" type=\"radio\" name=\"align\" value=\"right\">Right</div>
<div class=\"submenu-indicator\">
<span>Indicators</span>
<input id=\"indicator\" type=\"checkbox\" name=\"indicator\" value=\"indicator\" checked=\"\">Submenu indicators</div>
<div class=\"speed\">
<span>Submenu speed (ms)</span>
<input id=\"speed300\" type=\"radio\" name=\"speed\" value=\"300\" checked=\"\">300<input id=\"speed500\" type=\"radio\" name=\"speed\" value=\"500\">500<input id=\"speed800\" type=\"radio\" name=\"speed\" value=\"800\">800</div><div class=\"submenu-trig\"><span>Submenu trigger</span><input id=\"hover\" type=\"radio\" name=\"trig\" value=\"hover\" checked=\"\">Hover<input id=\"click\" type=\"radio\" name=\"trig\" value=\"click\">Click</div><div class=\"submenu-delay\"><span>Submenu show delay (ms)</span><input id=\"delay0\" type=\"radio\" name=\"delay\" value=\"0\" checked=\"\">0<input id=\"delay200\" type=\"radio\" name=\"delay\" value=\"200\">200<input id=\"delay400\" type=\"radio\" name=\"delay\" value=\"400\">400</div>
<div class=\"panel\">
<a href=\"#\" class=\"\" title=\"default\" style=\"opacity: 0.3;\"></a>
<a href=\"#\" class=\"black\" title=\"black\" style=\"opacity: 0.3;\"></a>
<a href=\"#\" class=\"grey\" title=\"grey\" style=\"opacity: 0.3;\"></a>
<a href=\"#\" class=\"blue\" title=\"blue\" style=\"opacity: 1;\"></a>
<a href=\"#\" class=\"deeper\" title=\"deeper\" style=\"opacity: 0.3;\"></a>
<a href=\"#\" class=\"green\" title=\"green\" style=\"opacity: 0.3;\"></a>
<a href=\"#\" class=\"emerald\" title=\"emerald\" style=\"opacity: 0.3;\"></a>
<a href=\"#\" class=\"red\" title=\"red\" style=\"opacity: 0.3;\"></a>
<a href=\"#\" class=\"pox\" title=\"pox\" style=\"opacity: 0.3;\"></a>
<a href=\"#\" class=\"orange\" title=\"orange\" style=\"opacity: 0.3;\"></a>
<a href=\"#\" class=\"sunburst\" title=\"sunburst\" style=\"opacity: 0.3;\"></a>
<a href=\"#\" class=\"yellow\" title=\"yellow\" style=\"opacity: 0.3;\"></a>
<a href=\"#\" class=\"purple\" title=\"purple\" style=\"opacity: 0.3;\"></a>
<a href=\"#\" class=\"pink\" title=\"pink\" style=\"opacity: 0.3;\">
</a>
</div>
<div class=\"reset\">
<a id=\"btReset\" href=\"javascript:void(0)\">Reset</a>
</div>
-->


</div>";

		/*if ($pg == "content/index.php") {
			 echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"assets/slide/css/style2.css\" />";
			 echo "<script type=\"text/javascript\" src=\"assets/slide/js/modernizr.custom.86080.js\"></script>";
		}*/
		?>
</head>
<body onload="rola()">
	<?php
		/*if ($pg == "content/index.php") {
			 echo "<ul class=\"cb-slideshow\">";
			 echo "    <li><span>Image 01</span><div><h3>se·ren·i·ty</h3></div></li>";
			 echo "    <li><span>Image 02</span><div><h3>com·po·sure</h3></div></li>";
			 echo "    <li><span>Image 03</span><div><h3>e·qua·nim·i·ty</h3></div></li>";
			 echo "    <li><span>Image 04</span><div><h3>bal·ance</h3></div></li>";
			 echo "    <li><span>Image 05</span><div><h3>qui·e·tude</h3></div></li>";
			 echo "    <li><span>Image 06</span><div><h3>re·lax·a·tion</h3></div></li>";
			 echo "</ul>";
		}*/
		
		echo "$menu";
	?>
<div id="master">
  <?php
		//echo '$pg = ';
		//echo "$pg";
		//echo "</br>";
		//echo '$content = ';
		//echo "$content";
		include_once($content);
	?>
</div>
</div>
<div id="rodape">
  <div class="foot">
	<a id="logo" href="index.php?pg=content/index.php">Nest</a><br>
	Copyright &copy;
    <!-- Copyright &copy; - Todos Os direitos Reservados. -->
  </div>
	<script type="text/javascript" src="assets/js/script.js"></script>
	<script type="text/javascript" src="assets/js/jquery.cookie.js"></script>
	<script type="text/javascript" src="assets/js/jquery.editar.js"></script>
	<script type="text/javascript" src="assets/js/jquery.outros.js"></script>
</body>
<?php
	if($content == "content/index.php") {
		echo "	<link type=\"text/css\" rel=\"StyleSheet\" href=\"assets/slider/css/sldshw.css\">";
		echo "	<link type=\"text/css\" rel=\"StyleSheet\" href=\"assets/slider/css/supersized.css\">";
		echo "	<script type=\"text/javascript\" src=\"assets/slider/js/sldshw.js\"></script>";
		echo "	<script src=\"assets/slider/js/supersized.3.2.7.min.js\"></script>";
		echo "	<script src=\"assets/slider/js/supersized-init.js\"></script>";
	}
?>
		<!--<script type=\"text/javascript\" src=\"assets/slide/js/javascriptbackground.js\"></script>-->
</html>