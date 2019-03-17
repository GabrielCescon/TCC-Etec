<?php
$codigo=$_GET['cdg'];
require_once ('classes/postagens.class.php');
$p2= new Postagens;
$p2->deletar($codigo);
header("Location: blog.php");
?>