<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Loja Virtual</title>
</head>
<body>
<?php
	// ligação à base de dados
	include('ligacao_bd.php');
		
	// captura valor da categoria
	$id_cat = $_GET['id_cat'];
	
	// procura artigos disponíveis
	$sql_cat = 'SELECT * FROM artigos WHERE id_categoria="' . $id_cat . '"ORDER BY nome_artigo ASC';
	$consulta = mysqli_query($ligacao, $sql_cat);
	
	$pasta_imagens = "imagens/";
	
// verificar se existem resultados e mostrá-los
if ($consulta) {
	echo "<table width='800 px' border='1' align='center'>";
	echo "<th>Artigos disponíveis para venda</th>";
	// apresenta artigos disponíveis
	while ($mostrar = mysqli_fetch_array($consulta)) {
	echo "<table width='800 px' border='1' align='center'>";
		echo "<tr>";
		echo "<td align='center' width='100' height='100' valign='middle'>
		<img src='$pasta_imagens".$mostrar['imagem_artigo']."' border='0' width='100' height='100'></td>";
		echo "<td><align='center'>".$mostrar['nome_artigo']."</a></br>EUR ".$mostrar['preco_artigo']." 
		</br>".$mostrar['descricao_artigo']."</td>";
		echo "<td width='200' align='center' valign='middle'></br><a href='comprar.php?
		id_artigo=".$mostrar['id_artigo']."'><img border=0 src='icones/carrinho.png'></td></tr>";
		echo "</table>";
	}		
}

// se não houver registos, informa o utilizador
else { 
echo('<table width="800 px" border=0 align="center" class="tabela_geral" cellspacing=0>');
echo ('<td class="tabela_geral" colspan="2" align="center">Lista de endereços registados</td>');
echo ('<tr><td>A base de dados não contém registos!</td></tr>');
echo ('<tr><td><a href="index.php">Clique para continuar</a></td></tr>');
}

?>
</body>
</html>
	
	
	
	