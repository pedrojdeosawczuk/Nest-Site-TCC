<div class="content">
<script>
function showUser(str) {

	var nome_var;
	var prioridade_var;
	var status_var;
	var cargo_var;
	var salario_var;
	var comentario_var;
	
	if (str=="") {
		document.getElementById("item2").innerHTML="";
		return;
	} 
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("item2").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","getuser.php?q="+str,true);
	xmlhttp.send();
	
}
</script>
	<meta name="robots" content="noindex">
	<meta name="googlebot" content="noindex">
	<link type="text/css" rel="StyleSheet" href="assets/css/funcionario.css">
	<?php
	if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)) {
		unset($_SESSION['nome']);
		unset($_SESSION['login']);
		unset($_SESSION['senha']);
		unset($_SESSION['prioridade']);
		
		header('location:index.php?pg=content/login.php');
	}
	$prioridade = $_SESSION['prioridade'];
	
	if ($prioridade == 0 or $prioridade == 2) {
		/*
		$con = mysql_connect("localhost", " root", "") or die (header('location:index.php?pg=erro/erro_500.php'));
		$select = mysql_select_db("bd_nest_site") or die(header('location:index.php?pg=content/login.php'));
		*/
		$result = mysqli_query($connection, "SELECT * FROM `funcionario` WHERE `status_fun` = 0");

		$sms_all = 0;
		while ($sms = mysqli_fetch_array($result)) {
			$sms_all = $sms_all + 1;
		}
		$sms_all = $sms_all - 1;
		
		/*
		$con = mysql_connect("localhost", " root", "") or die (header('location:index.php?pg=erro/erro_500.php'));
		$select = mysql_select_db("bd_nest_site") or die(header('location:index.php?pg=content/login.php'));
		*/
		$result = mysqli_query($connection, "SELECT * FROM  `funcionario` WHERE `status_fun` = 0");
	
		echo "<br>";
		echo "<br>";
		echo "<br>";
		echo "<br>";
		echo "<div id=\"funcionarios\">";
		echo "<label id=\"title_funcionario\">Funcionarios Ativos ($sms_all)</label>";
		echo "<p>";
		while ($sql = mysqli_fetch_array($result)) {
			$sms_all = $sms_all + 1;
		
			$fun_id = $sql[0];
			$fun_nome = $sql[1];
			$fun_login = $sql[2];
			$fun_senha = $sql[3];
			$fun_prioridade = $sql[4];
			$fun_cargo = $sql[5];
			$fun_salario = $sql[6];
			$fun_comentario = $sql[7];
			$fun_cadastro_data = $sql[9];
			$fun_alterar_data = $sql[10];
			if ($fun_prioridade != 0) {
				echo "<div class=\"funcionario\">";
				echo "<a href=\"#\"<label Onclick=\"$( '#$fun_id' ).slideToggle()\">Funcionario(a): $fun_nome</label></a></br>";
				echo "<div id=\"$fun_id\" style=\"display: none;\">";
				echo "	Código: $fun_id </br>";
				echo "	Nome: $fun_nome </br>";
				echo "	Data de cadastro: $fun_cadastro_data </br>";
				echo "	Última alteração: $fun_alterar_data </br>";
				if($fun_prioridade == 1):
					$fun_prioridade = "Administrador Web";
				elseif($fun_prioridade == 2):
					$fun_prioridade = "Administrador de RH";
				else:
					$fun_prioridade = "Usuário";
				endif;
				
				echo "	Prioridade: $fun_prioridade </br>";
				echo "	Cargo: $fun_cargo </br>";
				echo "	Salario: R$$fun_salario </br>";
				echo "	Comentario: $fun_comentario </br>";
				echo "</div>";
				echo "</div>";
				echo "</p>";
			}
		}
		echo "</div>";
		
		/*
		$id_pesquisar			= null;
		$nome_pesquisar			= null;
		$status_pesquisar		= null;
		$prioridade_pesquisar	= null;
		$cargo_pesquisar		= null;
		$salario_pesquisar		= null;
		$comentario_pesquisar	= null;
		*/
		
		if ((isset ($_SESSION['login']) == true) and (isset ($_SESSION['senha']) == true)) {
			$prioridade = $_SESSION['prioridade'];
			
			$erro = "vazio";
			
			if ($prioridade == 0 or $prioridade == 2) {
				if (isset($_POST['cadastrar'])) {
					//$id = $_POST['id'];
					$nome = $_POST['nome'];
					$login = preg_replace('/[^[:alpha:]_]/', '',$_POST['login']);
					$senha = preg_replace('/[^[:alpha:]_]/', '',$_POST['senha']);
					$prioridade = $_POST['prioridade'];
					$cargo = $_POST['cargo'];
					$salario = $_POST['salario'];
					$comentario = $_POST['comentario'];
					$cadastro_data = date('j F Y');
					if($nome == "") {
						$erro = "<div><span class=\"erro\">Informe o Nome!</span></div>";
					}
					else if($login == "") {
						$erro = "<div><span class=\"erro\">Informe o Login!</span></div>";
					}
					else if($senha == "") {
						$erro = "<div><span class=\"erro\">Informe a Senha!</span></div>";
					}
					else if($prioridade == "" or $prioridade != 1 and $prioridade != 2 and $prioridade != 3) {
						$erro = "<div><span class=\"erro\">Informe a Prioridade('1','2','3')!</span></div>";
					}
					else if($cargo == "") {
						$erro = "<div><span class=\"erro\">Informe o Cargo!</span></div>";
					}
					else if($salario == "") {
						$erro = "<div><span class=\"erro\">Informe o Salárioo!</span></div>";
					}
					else {
						/*
						$con = mysql_connect("localhost", " root", "") or die (header('location:index.php?pg=erro/erro_500.php'));
						$select = mysql_select_db("bd_nest_site") or die(header('location:index.php?pg=content/login.php'));
						*/
						$result = mysqli_query($connection, "INSERT INTO `funcionario`(`id_fun`, `nome_fun`, `login_fun`, `senha_fun`, `prioridade_fun`, `cargo_fun`, `salario_fun`, `comentario_fun`, `cadastro_fun`) VALUES ('$id',  '$nome',  '$login',  '$senha',  '$prioridade',  '$cargo', '$salario', '$comentario', '$cadastro_data');");
						header('location:index.php?pg=authenticate/funcionario.php');
					}
				}
				if (isset($_POST['alterar'])) {
					$id = $_POST['id'];
					$nome_fun = $_POST['nome_fun'];
					$prioridade = $_POST['prioridade'];
					$status = $_POST['status'];
					$cargo = $_POST['cargo'];
					$salario = $_POST['salario'];
					$comentario = $_POST['comentario'];
					$alterar_data = date('j F Y');
					if($id == "") {
						$erro = "<div><span class=\"erro\">Informe o Código!</span></div>";
					}
					else if($id == 1) {
						$erro = "<div><span class=\"erro\">Informe um Código valido!</span></div>";
					}
					else if($nome_fun == "") {
						$erro = "<div><span class=\"erro\">Informe o Nome!</span></div>";
					}
					else if($prioridade == "" or $prioridade != 1 and $prioridade != 2 and $prioridade != 3) {
						$erro = "<div><span class=\"erro\">Informe a Prioridade('1','2','3')!</span></div>";
					}
					else if($cargo == "") {
						$erro = "<div><span class=\"erro\">Informe o Cargo!</span></div>";
					}
					else if($salario == "") {
						$erro = "<div><span class=\"erro\">Informe o Salárioo!</span></div>";
					}
					else {
						$result = mysqli_query($connection, "UPDATE `funcionario` SET `nome_fun` = '$nome_fun',`prioridade_fun` = '$prioridade', `status_fun` = '$status',`cargo_fun` = '$cargo',`salario_fun` = '$salario',`comentario_fun` = '$comentario',`alterar_fun` = '$alterar_data' WHERE `id_fun` = '$id';");
						header('location:index.php?pg=authenticate/funcionario.php');
					}
				}
				/*
				if (isset($_POST['excluir'])) {
					$id = $_POST['id'];
					$status = $_POST['status'];
					
					if($id == "") {
						$erro = "<div><span class=\"erro\">Informe o Id!</span></div>";
					}
					else if($id == 0) {
						$erro = "<div><span class=\"erro\">A conta de código $id não pode ser deletada!</span></div>";
					}
					else {
						$result = mysql_query("UPDATE `funcionario` SET `status_fun` = '$status_fun' WHERE `id_fun` = '$id';");
						header('location:index.php?pg=authenticate/funcionario.php');
					}
				}
				*/
				?>
				<div id="alteracoes">
				<div id="alteracoes2">
				<div class="editar">
				<a href="#"><input class="btnmostrar" Onclick="<?php echo "$( '#item2' ).slideToggle(); $( '#item1' ).slideUp();" ?>" type="submit" value="Alterar" /></a>
				<a href="#"><input class="btnmostrar" Onclick="<?php echo "$( '#item2' ).slideUp(); $( '#item1' ).slideToggle();" ?>" type="submit" value="Cadastrar" /></a>
					<form id="form" method="post" action="">
						<div id="item1" style="display:none;">
							<input class="text" name="nome" placeholder="Nome" /></br>
							<input class="text" name="login" placeholder="Login"/></br>
							<input class="text" name="senha" type="password" placeholder="Senha" /></br>
							<select class="text" name="prioridade">
								<option value="" disabled="disabled" selected="selected">Selecione a Prioridade</option>
								<option value="1">Administrador Web</option>
								<option value="2">Administrador de RH</option>
								<option value="3">Usuário</option>
							</select>
							<!--<input class="text" name="prioridade" placeholder="Prioridade"/></br>-->
							<input class="text" name="cargo" placeholder="Cargo"/></br>
							<input class="text" name="salario" placeholder="Salario"/></br>
							<textarea class="text" name="comentario" rows="8" placeholder="Comentario"></textarea>
							<div>
				<?php
				if ($erro !="vazio") {
					echo "$erro";
				}
				?>
								<input class="btnenviar" type="submit" name="cadastrar" value="Enviar" />
							</div>
						</div>
					</form>
					<form id="form" method="post" action="">
						<div id="item2" style="display:none;">
							<input class="text" name="id" placeholder="Id" onchange="showUser(this.value); Mostrar();" /></br>
							<input class="text" name="nome_fun" id="nome_pesquisar" placeholder="Nome" /></br>
							<select class="text" name="prioridade" id="prioridade_pesquisar">
								<option value="" disabled="disabled" selected="selected">Selecione a Prioridade</option>
								<option value="1">Administrador Web</option>
								<option value="2">Administrador de RH</option>
								<option value="3">Usuário</option>
							</select>
							<select class="text" name="status" id="status_pesquisar">
								<option value="" disabled="disabled" selected="selected">Selecione o Status</option>
								<option value="0">Ativo</option>
								<option value="1">Inativo</option>
							</select>
							<!--<input class="text" name="prioridade" placeholder="Prioridade" value="$prioridade_pesquisar" /></br>-->
							<input class="text" name="cargo" id="cargo_pesquisar" placeholder="Cargo" /></br>
							<input class="text" name="salario" id="salario_pesquisar" placeholder="Salario" /></br>
							<textarea class="text" name="comentario" id="comentario_pesquisar" rows="8" placeholder="Comentario"></textarea>
							<div>
				<?php
				if ($erro !="vazio") {
					echo "$erro";
				}
				?>
								<input class="btnenviar" type="submit" name="alterar" value="Alterar" />
							</div>
						</div>
					</form>
				</div>
				<?php
			}
		}
	}
	else {
		header('location:authenticate/logout.php');
	}
	
	?>
</div>