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

//verificar se o cliente fez a autenticação
if(isset($_SESSION['id_cliente']) == FALSE) {
	
	echo "<p>Tem de se autenticar para poder continuar a compra!</p>";
	echo "<p><a href='login.php'>Clique para voltar à página inicial.</a></p>";
} 
else {
	$id_cliente = $_SESSION['id_cliente'];
	$sql_cliente = "SELECT * FROM clientes WHERE id_cliente=".$id_cliente;
	$consulta = mysqli_query($ligacao, $sql_cliente);
	$mostrar = mysqli_fetch_array($consulta);
	extract($mostrar);
	
	//apresentar tabela com os dados do utilizador
	echo "<table width='800 px' border='1' align='center'>";
	echo "<tr><td><strong>Passo 1 - Dados para envio</strong></td></tr>";
	
	?>
	
	<tr><td>
	<table>
		<tr><td>Primeiro Nome: <?php echo $primeiro_nome; ?></td></tr>
		<tr><td>Apelido: <?php echo $apelido; ?></td></tr>
		<tr><td>Rua/Lugar: <?php echo $endereco; ?></td></tr>
		<tr><td>Localidade: <?php echo $localidade; ?></td></tr>
		<tr><td>Código Postal: <?php echo $codigo_postal; ?></td></tr>
		<tr><td>Endereço de correio eletrónico: <?php echo $email; ?></td></tr>
	</table>
	
	<?php
	
		//pesquisar artigos no carrinho
		$sql_carrinho = "SELECT * FROM compra_temporaria temp JOIN artigos prod ON temp.id_artigo = prod.id_artigo WHERE sessao ='".$sessao. "' ORDER BY temp.id_artigo ASC";
		$consulta = mysqli_query($ligacao, $sql_carrinho);
		$resultado = mysqli_num_rows($consulta);
		$pasta_imagens = "imagens/";
		
		//apresentar os artigos adicionados ao carrinho
		if ($resultado > 0) {
			$total = 0;
			echo "<table width='800 px' border='1' align='center'>";
			echo "<th>Imagem Artigo</th><th>Detalhe Artigo</th><th>Quantidade</th><th>Preço unitário</th><th>Total a pagar</th>";
	
			while ($mostrar = mysqli_fetch_array($consulta)) {
		
				extract($mostrar);
		
				echo "<tr><td align='center' width='100' height='100' valign='middle'>
				<img src='$pasta_imagens".$mostrar['imagem_artigo']."' border='0' width='100' height='100'>";
				
				echo "<td align='center'>".$descricao_artigo."</td>";				
				echo "<td align='center'>".$quantidade."</td>";			
				echo "<td align='center'>EUR ".$preco_artigo."</td>";
				
				//calcular sub-total
				$subtotal = number_format($preco_artigo * $quantidade, 2);
				echo "<td align='center'>EUR ".$subtotal."</td>";
				
				//calcular valor total de compras
				$total = $total + $preco_artigo * $quantidade;
			}
				
			echo "<tr><td colspan='5' align='right'>O valor total a pagar é de: <strong>EUR ".number_format($total,2)."</strong></td></tr>";
		}
		
		//formulario que permite o registo final dos dados da encomenda
		?>	
		<form method="POST" action="finalizar_compra2.php">
		<tr><td colspan="2"><input type="submit" name="submit" value="Concluir a compra"/></td></tr>
		</form>
		</table>
	<?php
		}
	?>
</body>
</html>