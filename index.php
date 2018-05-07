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

// ligação à base de dados
include('ligacao_bd.php');

?>
<table width="800" border="1" cellspacing="0" cellpadding="0" align="center">
<tr>
<td width="200"><?php include('bandeiras.php'); ?></td>
<td width="600">
	<?php 
	// verifica se há idioma selecionado, senão define "PT"	
	if (!isset($_GET['idioma'])) {$idioma = 'PT';} else {$idioma = $_GET['idioma'];}
	
	// aplica definições conforme idioma
	switch ($idioma) {
	case 'PT':
	include('idiomas/pt.php');
	$_SESSION['idioma'] = 'PT';
	break;	
	
	case 'UK':
	include('idiomas/uk.php');
	$_SESSION['idioma'] = 'UK';
	break;
	}
	
	// verifica se já foi feita a autenticação
	if (isset($_SESSION['nivel_utilizador'])) {
	echo "Bem vindo, ".$_SESSION['nome_login'];
	echo " || <a href='lista_compras.php'>Ver lista de compras</a>";
	echo " || <a href='estado_encomenda.php'>Ver estado da encomenda</a>";
	echo " || <a href='logout.php'>Terminar sessão</a>";
	} else {
	
	// caso contrário, solicita o formulário de autenticação
	include('login.php'); 
	include('pesquisa_artigo.php'); 
		
	}
	?>
</td>
</tr>
<tr>
<td align="center"><strong>Categorias de artigos</strong></td>
<td align="center"><strong>Artigos em destaque</strong></td>
</tr>
<tr>
<td  width='50'><?php include('ver_categorias.php'); ?></td>
<td>
<?php 
	// procura 5artigos em promocao 
	$sql_artigo = "SELECT * FROM artigos WHERE promocao='S' ORDER BY RAND() LIMIT 5";
	$consulta = mysqli_query($ligacao, $sql_artigo);
	
	// mostra os artigos encontrados
	$pasta_imagens = "imagens/";
	echo "<table colspan='5' width='800 px' border='0' cellpadding='0' cellspacing='0' align='center'>";
	while ($mostrar = mysqli_fetch_array($consulta)) {
	echo "<th align='center' width='150' height='100' valign='middle'><a href='comprar.php?id_artigo=".$mostrar['id_artigo']."'>".$mostrar['nome_artigo']."</th>";
	echo "<a href='comprar.php?id_artigo=".$mostrar['id_artigo']."'>
	<img src='$pasta_imagens".$mostrar['imagem_artigo']."' border='0'>";
	}
	echo "</table>";
	?>
</table>
</body>
</html>