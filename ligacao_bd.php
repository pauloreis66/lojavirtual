<?php
// credenciais de acesso à base de dados
$servidor = "localhost";
$base_dados = "lojinha";
$nome_administrador = "root";
$password_administrador = "root";

// estabelecer ligação à base de dados
$ligacao = mysqli_connect($servidor, $nome_administrador, $password_administrador, $base_dados) or die ('Não foi possivel ligar à base de dados');

// ativar a base de dados pretendida
mysqli_select_db($ligacao, $base_dados) or die (mysqli_error($ligacao));

?>