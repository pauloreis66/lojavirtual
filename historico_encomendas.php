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

// ligação à base de dados e cabeçalho
include("ligacao_bd.php");

// verifica se o utilizador já realizou o acesso
if(!isset($_SESSION['nivel_utilizador'])) {
	echo "<tr>Não está autorizado a aceder a esta página! </tr>";
	echo "<tr><a href='../index.php'>Clique para voltar à pagina inicial!</a></tr>";
	}
else {


// pesquisa a base de dados 
$sql_encomendas = "SELECT * FROM compra_confirmada WHERE estado_compra='2'";
$consulta = mysqli_query($ligacao, $sql_encomendas);
$resultado = mysqli_num_rows($consulta);

// caso não existam resultados, avisa
if ($resultado == 0) {
echo "<tr>Não existem compras! </tr>";
echo "<tr><a href='index.php'>Clique para voltar à pagina inicial!</a></tr>"; }

// caso contrário, exibe os resultados encontrados
else {
echo "<table width='800 px' border='1' align='center'>";
echo "<tr><td colspan='4' align='center'>Histórico de encomendas</td></tr>";
echo "<th>Nº Encom.</th><th>Nº cliente</th><th>Data compra</th><th>Estado da compra</th>";
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
	// apresenta hiperligação para voltar ao menu
	echo '<p align="center">Clique <a href="administrador/menu_admin.php">aqui</a> para voltar ao menu de administração</p>'; 
	echo "</table>";
	} }

?>

</body>
</html>
