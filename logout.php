<?php
// iniciar sess�o
session_start();
 
// destruir a sess�o
session_destroy();
 
// enviar o utilizador para p�gina de autentica��o
header('Location: index.php');
?>