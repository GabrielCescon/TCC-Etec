<?php
$codigo=$_GET['cdg'];
require_once ('classes/mensagem.class.php');
$m2= new Mensagem;
$m2->deletar($codigo);
header("Location: mensagens.php");
?>