<?php
require_once ('classes/mensagem.class.php');

$nome=$_POST['nome'];
$email=$_POST['email'];
$mensagem=$_POST['mensagem'];

$m1 = new Mensagem();
$m1->criarMensagem($nome,$email,$mensagem);
header("location:index.php");