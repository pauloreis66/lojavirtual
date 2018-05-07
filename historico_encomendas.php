<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Loja Virtual</title>
</head>
<body>
<?php
// inicia sess�o 
session_start();

// liga��o � base de dados e cabe�alho
include("ligacao_bd.php");

// verifica se o utilizador j� realizou o acesso
if(!isset($_SESSION['nivel_utilizador'])) {
	echo "<tr>N�o est� autorizado a aceder a esta p�gina! </tr>";
	echo "<tr><a href='../index.php'>Clique para voltar � pagina inicial!</a></tr>";
	}
else {


// pesquisa a base de dados 
$sql_encomendas = "SELECT * FROM compra_confirmada WHERE estado_compra='2'";
$consulta = mysqli_query($ligacao, $sql_encomendas);
$resultado = mysqli_num_rows($consulta);

// caso n�o existam resultados, avisa
if ($resultado == 0) {
echo "<tr>N�o existem compras! </tr>";
echo "<tr><a href='index.php'>Clique para voltar � pagina inicial!</a></tr>"; }

// caso contr�rio, exibe os resultados encontrados
else {
echo "<table width='800 px' border='1' align='center'>";
echo "<tr><td colspan='4' align='center'>Hist�rico de encomendas</td></tr>";
echo "<th>N� Encom.</th><th>N� cliente</th><th>Data compra</th><th>Estado da compra</th>";
	while ($mostrar = mysqli_fetch_array($consulta)) {
	extract($mostrar);
	echo'<tr><td>$id_compra</td>
	<td align=\"center\" width=\"50px\">$id_cliente</td>
	<td align=\"center\" >$data_compra</td>
	<td align=\"center\" >';
	
	// assinala de forma colorida cada estado
	if ($estado_compra == '0') {echo "<font color='#FFFF00'>Pendente";
	} elseif ($estado_compra == '1') {echo "<font color='#009900'>Expedida";
	} elseif ($estado_compra == '2') {echo "<font color='#FF0000'>Terminada";
	} 
	
	echo "</td></tr>";
	}
	// apresenta hiperliga��o para voltar ao menu
	echo '<p align="center">Clique <a href="administrador/menu_admin.php">aqui</a> para voltar ao menu de administra��o</p>'; 
	echo "</table>";
	} }

?>

</body>
</html>
