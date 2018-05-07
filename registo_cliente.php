<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Loja Virtual</title>
</head>
<body>
<?php
// inicia sessão 
session_start();

// ------------ registar utilizador ---------------
	if(isset($_REQUEST['registar'])) {
	// ligação à base de dados
	include ('ligacao_bd.php');
	// registar utilizador
	$sql_cliente = "INSERT INTO clientes(nome_login, palavra_passe, primeiro_nome, apelido, endereco, localidade, codigo_postal, 
	telefone, email, nivel_utilizador ) VALUES 
	( '".$_POST['nome_login']."', 
	'".$_POST['palavra_passe']."', 
	'".$_POST['primeiro_nome']."',
	'".$_POST['apelido']."',
	'".$_POST['endereco']."',
	'".$_POST['localidade']."',
	'".$_POST['codigo_postal']."',
	'".$_POST['telefone']."',
	'".$_POST['email']."',  '2') ";
	$consulta = mysqli_query($ligacao, $sql_cliente);

	// remeter para pagina
	header("Location: index.php");
	} 
	?>

<form id="form_registo" name="form_registo" method="POST" action="registo_cliente.php">
<table width="800" border="1" cellspacing="0" cellpadding="0" align="center">
  <th colspan="2">Registo de cliente</th>
  <tr>
    <td width="200">Nome de acesso:</td>
    <td width="600"><input type="text" name="nome_login" size="20"/></td>
  </tr>
  <tr>
    <td>Palavra-passe:</td>
    <td><input type="password" name="palavra_passe" size="8"  />(Máx: 8 carateres)</td>
  </tr>
  <tr>
    <td>Primeiro nome:</td>
    <td><input type="text" name="primeiro_nome" size="15" /></td>
  </tr>
  <tr>
    <td>Apelido:</td>
    <td><input type="text" name="apelido" size="25" /></td>
  </tr>
  <tr>
    <td>Endereço (Rua/Lugar):</td>
   <td><input type="text" name="endereco" size="50" /></td>
  </tr>
  <tr>
    <td>Localidade:</td>
    <td><input type="text" name="localidade" size="25" /></td>
  </tr>
  <tr>
    <td>Código postal:</td>
    <td><input type="text" name="codigo_postal" size="8" /></td>
  </tr>
  <tr>
    <td>Telefone:</td>
    <td><input type="text" name="telefone" size="25" /></td>
  </tr>
  <tr>
    <td>Endereço de correio eletrónico:</td>
    <td><input type="text" name="email" size="50" /></td>
  </tr>
	<td colspan="2" align="center"><input type="submit" name="registar" id="registar" value="Registar" />
	<input type="reset" name="apagar" id="apagar" value="Apagar" /></td>
</table>
</form>
</body>
</html>