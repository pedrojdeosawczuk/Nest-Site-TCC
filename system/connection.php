<?php
	// Maquina a qual o banco de dados está //
	$server =  getenv("HOST_DB");

	// Usuário do banco de dados MySql //
	$user =  getenv("USERNAME_DB");

	// Senha do banco de dados MySql //
	$pass =  getenv("PASSWORD_DB");
	
	// Seleciona o banco de dados a ser usado //
	$bd = getenv("DATABASE");
	
	// Conecta no banco de dados MySql //
	$connection = mysqli_connect($server, $user, $pass, $bd) or die (header('location:index.php?pg=erro/erro_500.php'));
	// Seleciona o banco de usado //
	mysqli_select_db($connection, $bd) or die(header('location:index.php?pg=content/index.php'));
?>