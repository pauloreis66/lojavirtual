<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Loja Virtual</title>
</head>
<body> 
	<table width='800 px' border='1' align='center'>
	<form action="processa_registo_artigo.php" method="POST" enctype="multipart/form-data">
	<tr>
    <td>Nome do artigo</td>
    <td><input type="text" name="nome_prod" size=50/></td>
	</tr>
	<tr>
    <td>Descrição do artigo</td>
    <td><textarea name="desc_prod" rows="10" cols="40" /></textarea></td>
	<tr>
	</tr>
	<tr>
    <td>Preço do artigo</td>
    <td><input type="text" name="preco_prod" size=10/></td>
	</tr>
	<tr>
    <td>Total de unidades do artigo ("stock")</td>
    <td><input type="text" name="stock_prod" size=10/></td>
	</tr>
    <td>Categoria do artigo:
    <?php
	// estabelece ligação à base de dados
	include('../ligacao_bd.php');
	// procura categorias disponíveis
	$sql = "SELECT * FROM categorias ORDER BY nome_categoria ASC;";
	$consulta = mysqli_query($ligacao, $sql);
	
	// cria seleção de categorias 
	echo '<td><select name="cat_prod">';
	while ($mostrar = mysqli_fetch_assoc($consulta)) {
	echo "<option value=" . $mostrar['id_categoria'] . ">  " . $mostrar['nome_categoria'] . "</option>";
	}
	?>
	<tr>
	<td>Imagem do artigo (formato .JPEG e tamanho máx. = 350 kB!) </td>
	<td><input name="imagem" size="40" type="file" /></td>
	</tr>
	<td><input name="enviar" type="submit" value="Registar artigo" />
	<input name="resetar" type="reset" value="Apagar" /></td>
	</form>
	<td colspan="4" align="center"><p>Clique <a href="menu_admin.php">aqui</a> para voltar ao menu de administração</p>
	</table>
</body>
</html>
