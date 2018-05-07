<?php
	// ligação à base de dados
	include('ligacao_bd.php');
	
	// procura categorias disponíveis
	$sql_cat = "SELECT * FROM categorias ORDER BY nome_categoria ASC";
	$consulta = mysqli_query($ligacao, $sql_cat);
	
	// apresenta categorias disponíveis
	while ($mostrar = mysqli_fetch_array($consulta)) {
	$nome_categoria = $mostrar['nome_categoria'];
	$id_categoria = $mostrar['id_categoria'];
	echo "<p><a href=\"artigos_categoria.php?id_cat=$id_categoria\">$nome_categoria</a>";
	}
	
	
?>