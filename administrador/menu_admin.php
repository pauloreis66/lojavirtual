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

// verifica se o utilizador já realizou o acesso
if(isset($_SESSION['id_utilizador'])) {
	echo "<tr>Não está autorizado a aceder a esta página! </tr>";
	echo "<tr><a href='../index.php'>Clique para voltar à pagina inicial!</a></tr>";
	}
else {
// verifica nivel de utilizador e atribui variavel
if(isset($_SESSION['nivel_utilizador'])) {  $nivel = $_SESSION['nivel_utilizador']  ; } 

?>
	<table width="800 px" border="1" align="center">
	<td align="l">Menu de administrador</td><br />
	<tr><td><a href='adicionar_categoria.php'>Adicionar categoria</a>
	<p><a href='adicionar_artigo.php'>Adicionar artigo</a>
	<p><a href='../estado_encomenda.php'>Ver encomendas</a>
	<p><a href='../logout.php'>Terminar sessão</a>  
	</td></tr>
<?php } ?>

</body>
</html>
