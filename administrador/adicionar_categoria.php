<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Loja Virtual</title>
</head>
<body> 

	<?php
	// ------------ registar categoria ---------------
	if(isset($_REQUEST['registar'])) {
	// ligação à base de dados
	include ('../ligacao_bd.php');
	// verificar se já existe categoria
	$sql_categoria = "SELECT nome_categoria FROM categorias";
	$consulta1 = mysqli_query($ligacao, $sql_categoria);
	$resultado = mysqli_fetch_array($consulta1);
	if ($resultado['nome_categoria'] == $_POST['nome_cat']) {
	echo "Já existe uma categoria com o nome que inseriu!"; } 
	else {
	// registar nova categoria
	$sql_nova_cat = "INSERT INTO categorias(nome_categoria) VALUES( '".$_POST['nome_cat']."') ";
	$consulta2 = mysqli_query($ligacao, $sql_nova_cat);
	// remeter para menu 
	header("Location: menu_admin.php");
	} }
	?>
	<table width='800 px' border='1' align='center'>
	<form id="form_registo" name="form_registo" method="POST" action="adicionar_categoria.php">
    <td>Nome da categoria: <input type="text" name="nome_cat" size="20" id="nome_cat" /> (obrigatório) </td>
    <p><td><input type="submit" name="registar" id="registar" value="Registar" />
	<input type="reset" name="apagar" id="apagar" value="Apagar" /></td></tr>
	</form>
	<td colspan="4" align="center"><p>Clique <a href="menu_admin.php">aqui</a> para voltar ao menu de administração</p>
	</table>
</body>
</html>