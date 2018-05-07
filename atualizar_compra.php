 <?php
// inicia sessão 
session_start();

// ligação à base de dados
include('ligacao_bd.php');

// verifica número de sessão
$sessao = session_id();

// captura valores da compra
$quantidade = $_REQUEST['quantidade'];
$id_artigo = $_REQUEST['id_artigo']; 
$acao = $_REQUEST['submit']; 

switch ($acao) {
case 'Adicionar':
    $sql_adicionar = "INSERT INTO compra_temporaria (sessao, id_artigo, quantidade) VALUES ('$sessao', '$id_artigo', '$quantidade')";
    $consulta = mysqli_query($ligacao, $sql_adicionar); 
    header("Location:".$_SERVER['HTTP_REFERER']);
    exit();
    break;

case 'Alterar':
    if ($quantidade > 0) {
        $sql_alterar1 = "UPDATE compra_temporaria SET quantidade = '$quantidade' WHERE sessao = '$sessao' AND id_artigo = '$id_artigo'";
        $consulta1 = mysqli_query($ligacao, $sql_alterar1); } 
		else {
        $sql_alterar2 = "DELETE FROM compra_temporaria WHERE sessao = '$sessao' AND id_artigo = '$id_artigo'";
		$consulta2 = mysqli_query($ligacao, $sql_alterar2); 
	}
    header("Location:".$_SERVER['HTTP_REFERER']);
    exit();
    break;

case 'Remover artigo':
    $sql_remover = "DELETE FROM compra_temporaria WHERE sessao = '$sessao'  AND id_artigo = '$id_artigo'";
    $consulta = mysqli_query($ligacao, $sql_remover); 
    header("Location:".$_SERVER['HTTP_REFERER']);
    exit();
    break;
}
?>