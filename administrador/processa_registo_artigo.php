<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Loja Virtual</title>
</head>
<body>       

	<?php
	// estabelece ligação à base de dados
	include('../ligacao_bd.php');
	
	// captura dados enviados pelo formulário
	$cat_prod = $_POST["cat_prod"];
	$nome_prod = $_POST["nome_prod"];
	$desc_prod = $_REQUEST["desc_prod"];
	$preco_prod = $_POST["preco_prod"];
	$stock_prod = $_POST["stock_prod"];
	$img_nome = $_FILES["imagem"]["name"];
	$pasta_imagens = "imagens/";
	
	// determina o tamanho e o tipo de ficheiro enviado
	$img_tamanho = round($_FILES["imagem"]["size"] / 1000);
	$img_tipo = $_FILES["imagem"]["type"];
	$local_final = "../".$pasta_imagens.$img_nome ;
		
	// caso o tamanho ou tipo de ficheiro seja correto, permite upload
	if ($img_tamanho < 350 && ($img_tipo == "image/jpeg" or $img_tipo == "image/pjpeg")) {
	
	// copiar ficheiro para o destino
	(move_uploaded_file($_FILES['imagem']['tmp_name'], $local_final));
	
	// inserir hiperligação na base de dados
	$sql_regista ="INSERT INTO artigos (id_categoria, nome_artigo, descricao_artigo, preco_artigo, stock_artigo, imagem_artigo) VALUES 
	('$cat_prod', '$nome_prod', '$desc_prod', '$preco_prod' , '$stock_prod', '$img_nome') ";
	// atualiza valor do contador
	$consulta=mysqli_query($ligacao, $sql_regista);
		
	// confirmar registo do artigo
	echo "O registo foi efetuado com sucesso!";  
	} 
	// caso não seja feito o upload da imagem, informa sobre o erro
	else  {
	echo "<p>Não foi possível registar os dados devido a um erro no ficheiro de imagem.";
	
	if ($img_tamanho >350) {
	echo "<p>O ficheiro submetido tem o tamanho de ". $img_tamanho . " kB!</br>";} 
	else { 
	echo "<p>O ficheiro submetido é do tipo ". $img_tipo . "!</br>"; }
	echo "<p>O ficheiro submetido não pode ultrapassar os 350 kB ou ter formato diferente de JPEG!</br>";
	} ?>
	<p><a href="menu_admin.php">Clique aqui para continuar</a>
</body>
</html>
