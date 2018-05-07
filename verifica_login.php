<?php
session_start();
// ligação à base de dados e cabeçalho
include("ligacao_bd.php");

// Verifica se houve POST ou se os campos do formulário estão vazios
if (!empty($_POST) AND (empty($_POST['nome']) OR empty($_POST['password']))) {
	header("Location: index.php"); exit;
}

// definir variáveis
$username=$_POST['nome'];
$password=$_POST['password'];

// consultar a base de dados
$sql="SELECT id_cliente, nome_login, palavra_passe, nivel_utilizador FROM clientes WHERE nome_login='$username' AND palavra_passe='$password' ";
$consulta = mysqli_query($ligacao, $sql);

// Guarda os dados encontados na variável $resultado
$resultado = mysqli_fetch_assoc($consulta);

// Atribui dados encontrados na sessão 
$_SESSION['id_cliente'] = $resultado['id_cliente'];
$_SESSION['nome_login'] = $resultado['nome_login'];
$_SESSION['nivel_utilizador'] = $resultado['nivel_utilizador'];

if (mysqli_num_rows($consulta) != 1) {
	// Volta à página de entrada se os dados são inválidos 
	header("Location: index.php"); exit;
	
	// redireciona conforme o nível
	}  elseif ($_SESSION['nivel_utilizador'] == 1) { 
			$_SESSION['id_cliente'] = $resultado['id_cliente'];
			header("Location: administrador/menu_admin.php"); 
			exit;
	} elseif ($_SESSION['nivel_utilizador'] == 2) { 
			$_SESSION['id_cliente'] = $resultado['id_cliente'];
			header("Location: index.php"); 
			exit;
} 


?>