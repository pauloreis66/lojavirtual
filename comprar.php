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

// captura código de artigo
$id_artigo = $_REQUEST['id_artigo']; 

// prepara sessão de compra
$sessao = session_id();

// pesquisa artigo selecionado
$sql_artigo = "SELECT * FROM artigos WHERE id_artigo =".$id_artigo ;
$consulta1 = mysqli_query($ligacao, $sql_artigo);
$mostrar = mysqli_fetch_array($consulta1);
$pasta_imagens = "imagens/";

// mostrar detalhes do artigo selecionado
	echo "<table width='800 px' border='1' align='center'>";
	echo "<p align='center'><a href=\"lista_compras.php\">Ver lista de compras</a></p>";
	echo "<p align='center'><a href=\"index.php\">Ver todos os artigos</a></p>";
	echo "<strong><p align='center'>Você selecionou os seguintes artigos:</strong></p><td align='center' width='100' height='100' valign='middle'>
	<img src='$pasta_imagens".$mostrar['imagem_artigo']."' border='0'>";
	echo "<td><align='center'>".$mostrar['nome_artigo']."</a></br>EUR ".$mostrar['preco_artigo']." 
	</br>".$mostrar['descricao_artigo']."</br>";
	
// seleciona quantidade temporaria 	
	$sql_quantidade = 'SELECT quantidade FROM compra_temporaria WHERE sessao = "'.$sessao.'" AND id_artigo = "'.$id_artigo. '"';
	$consulta2 = mysqli_query($ligacao, $sql_quantidade);
	$resultado = mysqli_fetch_assoc($consulta2);
	
// se houver quantidades já inseridas, extrai valores para mostrar
	if (mysqli_num_rows($consulta2) > 0) { $quantidade = $resultado['quantidade']; }
// se não houver quantidade já inserida, atribui valor zero
	else {$quantidade = 0;}

// inicia formulario para atualizar valores de quantidade
echo '<form method="POST" action="atualizar_compra.php">';

// apresenta quantidade a zero ou o número de vezes selecionado
echo '<p>Quantidade: <input type="text" name="quantidade" id="quantidade" size="2" value="'.$quantidade.'"/>';

// se a quantidade for positiva, permite alterar ou remover quantidade/artigo
	if ($quantidade > 0) {
	echo '<align="center"><input type="submit" name="submit" value="Alterar"/>';
	echo '<align="center"><input type="submit" name="submit" value="Remover artigo"/>';
		
// se a quantidade for nula, permite adicionar artigo
	} else {
	echo '<align="center"><input type="submit" name="submit" value="Adicionar"/>';
	}
	
echo '<input type="hidden" name="id_artigo" value="'.$id_artigo.'"/>';	
echo "</form>";
echo "</table>";
?>
</body>
</html> 