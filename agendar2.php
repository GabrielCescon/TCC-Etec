<?php
$cod = $_GET['cdg'];
$data = $_GET['date'];
$hora = $_GET['time'];
<?php if (!isset($l1)||!isset($cod)||$cod==''||!isset($data)||$data==''||!isset($hora)||$hora=='') { die ("<script>window.history.go(-1);</script>");} elseif ($l1 instanceof Usuario) { die ("<script>window.history.go(-1);</script>"); } 
require_once ('classes/administrador.class.php');

if($l1->marcaConsulta($data,$hora,$cod))

?>