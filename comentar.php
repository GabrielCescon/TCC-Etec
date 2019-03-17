<?php
require_once ('classes/usuario.class.php');
require_once ('classes/postagens.class.php');
	$codigoPostagem=$_GET['cdgp'];
	$codigoUsuario=$_GET['cdgu'];
	$comentario=$_POST['comentario'];
$p1 = new Postagens();
$p1->comentar($codigoPostagem,$codigoUsuario,$comentario);
echo "<script>window.location='postagem.php?ptgs=".$codigoPostagem."';</script>";