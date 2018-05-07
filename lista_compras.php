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

// prepara sessão de compra
$sessao = session_id();

// pesquisar artigos no carrinho
$sql_carrinho = "SELECT * FROM compra_temporaria temp JOIN artigos prod ON temp.id_artigo = prod.id_artigo WHERE sessao ='".$sessao. "' ORDER BY temp.id_artigo ASC";
$consulta = mysqli_query($ligacao, $sql_carrinho);
$resultado = mysqli_num_rows($consulta);
$pasta_imagens = "imagens/";

if ($resultado > 0) {
	$total = 0;
	echo "<table width='800 px' border='1' align='center'>";
	echo "<th>Imagem Artigo</th><th>Quantidade</th><th>Preço unitário</th><th>Total a pagar</th>";
	
	while ($mostrar = mysqli_fetch_array($consulta)) {
		
		extract($mostrar);
		
		echo "<tr><td align='center' width='100' height='100' valign='middle'>
		<img src='$pasta_imagens".$mostrar['imagem_artigo']."' border='0' width='100' height='100'>";
		echo "<td align='center'><a href='comprar.php?id_artigo=$id_artigo&quantidade=$quantidade&submit=Alterar'>".$descricao_artigo."</a></td>";
		
		//formulario que permite alterar dados da compra
		echo "<form method='POST' action='atualizar_compra.php'>";
		echo "<td align='center'><input type='text' name='quantidade' size='2' value='".$quantidade."'/>";
		echo "<input type='hidden' name='id_artigo' value='".$id_artigo."'/>";
		echo "<input type='submit' name='submit' value='Alterar'/>";
		echo "</form>";
		
		//apresentar preço de cada artigo
		echo "<td align='center'>EUR ".$preco_artigo."</td>";
		
		//calcular sub-total
		$subtotal = number_format($preco_artigo * $quantidade, 2);
		echo "<td align='center'>EUR ".$subtotal."</td>";
		
		//calcular valor total de compras
		$total = $total + $preco_artigo * $quantidade; 
		}
	
		
	echo "<p align='center'>O valor total a pagar pelos artigos listados é de: <strong>EUR ".number_format($total,2)."</strong></p></td></tr>";
		
	echo "<form method='POST' action='finalizar_compra.php'>";
	echo "<tr><td colspan='5' align='center'><p><input type='submit' name='submit' value='Finalizar compra'></p></td></tr>";
	echo "</form>";
	echo "</table>";
	
	} else {
			echo "<table width='800 px' border='1' align='center'>";
			echo "<th>O seu carrinho de compras está vazio. Clique <a href='index.php'>aqui</a> para adicionar artigos!</th>";
	}
	

?>
</body>
</html>