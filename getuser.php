<?php
	$q = intval($_GET['q']);
	require_once('system/connection.php');
	$nulo = null;

$con = mysql_connect($server, $user, $pass, $bd) or die (header('location:index.php?pg=erro/erro_500.php'));
mysql_select_db($bd) or die(header('location:index.php?pg=content/index.php'));

if (!$con) {
  die('Could not connect: ' . mysql_error($con));
}

$result = mysqli_query($connection, "SELECT * FROM funcionario WHERE id_fun = '$q'");

while($row = mysqli_fetch_array($result)) {
	$nulo = 1;
	
	$id_pesquisar = $row[0];
	$nome_pesquisar = $row[1];
	$prioridade_pesquisar = $row[4];
	$cargo_pesquisar = $row[5];
	$salario_pesquisar = $row[6];
	$comentario_pesquisar = $row[7];
	$status_pesquisar = $row[8];
	
	?>
	<input class="text" name="id" placeholder="Id" onchange="showUser(this.value)" value="<?php echo $id_pesquisar; ?>" /></br>
	<input class="text" name="nome_fun" id="nome_pesquisar" placeholder="Nome"  value="<?php echo $nome_pesquisar; ?>" /></br>
		<select class="text" name="prioridade" id="prioridade_pesquisar">
			<option value="<?php echo $prioridade_pesquisar; ?>" disabled="disabled" selected="selected">Selecione a Prioridade</option>
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
		<input class="text" name="cargo" id="cargo_pesquisar" placeholder="Cargo" value="<?php echo $cargo_pesquisar; ?>" /></br>
		<input class="text" name="salario" id="salario_pesquisar" placeholder="Salario" value="<?php echo $salario_pesquisar; ?>" /></br>
		<textarea class="text" name="comentario" id="comentario_pesquisar" rows="8" placeholder="Comentario"><?php echo $comentario_pesquisar; ?></textarea>
		<div>
			<input class="btnenviar" type="submit" name="alterar" value="Alterar" />
		</div>
<script>
	mostrar();
	function mostrar(){
	document.getElementById("nome_pesquisar").value = "$nome_pesquisar";
	document.getElementById("prioridade_pesquisar").value = "$prioridade_pesquisar";
	document.getElementById("status_pesquisar").value = "$status_pesquisar";
	document.getElementById("cargo_pesquisar").value = "$cargo_pesquisar";
	document.getElementById("salario_pesquisar").value = "$salario_pesquisar";
	document.getElementById("comentario_pesquisar").value = "$comentario_pesquisar";
	}
</script>
<?php
}
if ($nulo == null){
?>
	<input class="text" name="id" placeholder="Id" onchange="showUser(this.value)" value="" /></br>
	<input class="text" name="nome_fun" id="nome_pesquisar" placeholder="Nome"  value="" /></br>
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
		<input class="text" name="cargo" id="cargo_pesquisar" placeholder="Cargo" value="" /></br>
		<input class="text" name="salario" id="salario_pesquisar" placeholder="Salario" value="" /></br>
		<textarea class="text" name="comentario" id="comentario_pesquisar" rows="8" placeholder="Comentario"></textarea>
		<div>
			<input class="btnenviar" type="submit" name="alterar" value="Alterar" />
		</div>	
<?php
}
mysql_close($connection);
?>