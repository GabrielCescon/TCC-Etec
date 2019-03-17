<?php
session_start();
require_once ('classes/administrador.class.php');
require_once ('classes/usuario.class.php');
if (isset($_SESSION['objeto'])) 
{
      @$l1 = unserialize($_SESSION['objeto']);
}
else
{
	echo "<script>window.history.go(-1);</script>";
}
$codigo=$_GET['cdg'];
$comando = $_GET['com'];
if ($l1 instanceof Administrador){
    if($comando == "ativa"){
        if ($l1->ativarUsuario($codigo) == true)
	   {
		  echo "<script>window.history.go(-1);</script>";
	   }
	   else
	   {
		  echo "<script>alert('Falha ao ativar o usuario');</script>";
	   }
    }elseif($comando == "deleta"){
        if ($l1->deletarUsuario($codigo) == true)
	   {
		  echo "<script>window.history.go(-1);</script>";
	   }
	   else
	   {
		  echo "<script>alert('Falha ao desativar o usuario');</script>";
	   }
    }
}elseif($l1 instanceof Usuario){
    if($l1->deletar($l1->getEmail(),$l1->getCPF())== true){
        $l1->deslogar();
    }else{
        echo "<script>alert('Falha ao desativar o usuario');</script>";
    }
}
else
{
    header("location:index.php");
}
?>
