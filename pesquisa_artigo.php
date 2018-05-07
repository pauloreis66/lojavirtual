<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Loja Virtual</title>
</head>
<body> 

	<?php
	// ------------ pesquisar artigo ---------------
	if(isset($_REQUEST['pesquisar'])) {
	// ligação à base de dados
	include ('ligacao_bd.php');
	
	// pesquisar termo inserido
	$termo_pesquisa = '%'.$_POST['termo_pesquisa'].'%';
	$sql_artigo = "SELECT * FROM artigos WHERE nome_artigo LIKE '$termo_pesquisa'";
	$consulta = mysqli_query($ligacao, $sql_artigo);
	$resultado = mysqli_num_rows($consulta);
	
	if ($resultado != 0) {
	echo "<table width='800 px' border='1' align='center'>";
	echo "<th>Artigos encontrados na pesquisa com o termo ".$_POST['termo_pesquisa']."</th>";
	// apresenta artigos disponíveis
	while ($mostrar = mysqli_fetch_array($consulta)) {
	echo "<table width='800 px' border='1' align='center'>";
		echo "<tr>";
		echo "<td align='center' width='100' height='100' valign='middle'>
		<img src='$pasta_imagens".$mostrar['imagem_artigo']."' border='0'></td>";
		echo "<td><align='center'>".$mostrar['nome_artigo']."</a></br>EUR ".$mostrar['preco_artigo']." 
		</br>".$mostrar['descricao_artigo']."</td>";
		echo "<td width='200' align='left' valign='middle'></br><a href='comprar.php?
		id_artigo=".$mostrar['id_artigo']."'><img border=0 src='icones/carrinho.jpg'></td></tr>";
		echo "</table>";
	}}		
	else {
	echo "<table width='800 px' border='1' align='center'>";
	echo "<td align='center'>Não foram encontrados artigos que correspondam ao critério!"; } 
	}
	?>
	<table width='800 px' border='1' align='center'>
	<form id="form_registo" name="form_registo" method="POST" action="pesquisa_artigo.php">
    <td>Pesquisar...<input type="text" name="termo_pesquisa" size="20" /> (campo obrigatório) </td>
    <p><td><input type="submit" name="pesquisar" id="pesquisar" value="Pesquisar" />
	<input type="reset" name="apagar" id="apagar" value="Apagar" /></td></tr>
	</form>
	
	</table>
</body>
</html>