<meta charset="utf-8">
<?php
session_start();
require_once ('classes/usuario.class.php');
	if (isset($_SESSION['objeto'])) 
	{
	     @$l1 = unserialize($_SESSION['objeto']);
	}
	else
	{
		header('location:index.php');
	}
	@$nome=$_POST['nome'];
	if (!isset($nome)) 
	{
		$nome = 0;
	}
	@$apelido=$_POST['apelido'];
	if (!isset($apelido)) 
	{
		$apelido= 0;
	}
	@$consulta=$_POST['consulta'];
	if (!isset($consulta)) 
	{
		$consulta= 0;
	}
	@$tel1=$_POST['tel1'];
	if (!isset($tel1)) 
	{
		$tel1= 0;
	}
	@$tel2=$_POST['tel2'];
	if (!isset($tel2)) 
	{
		$tel2= 0;
	}
	@$cidade=$_POST['cidade'];
	if (!isset($cidade)) 
	{
		$cidade= 'N';
	}
	@$user=$_POST['user'];
	if (!isset($user)) 
	{
		$user= 0;
	}
	@$upload=array("arqName"=>$_FILES['upload']['name'], "arqType" => $_FILES['upload']['type'], "arqSize" => $_FILES['upload']['size'], "arqTemp" => $_FILES['upload']['tmp_name']);
	if (!isset($upload)) 
	{

		$upload= 0;
	}
	
	$l1->atualizarUsuario($nome,$apelido,$consulta,$tel1,$tel2,$cidade,$user,$upload);
	$_SESSION['objeto'] = serialize($l1);
	header('location:ver-dados.php');
