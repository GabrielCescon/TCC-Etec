<meta charset="utf-8">
<?php
session_start();
require_once ('classes/administrador.class.php');
if (isset($_SESSION['objeto'])) 
{
      @$l1 = unserialize($_SESSION['objeto']);
}
else
{
	die("<script>window.history.go(-1);</script>");
}
$codigo=$_GET['cdg'];
$ativado=$l1->pegarUsuario($codigo);
$ativo=$ativado['ic_ativo'];
if ($ativo == '0') 
{
	die("<script>alert('Usuario desativado');window.history.go(-1);</script>");
}
?>
<form method="POST" action="#" id="desc">
	<input type="text" name="desc" placeholder="Insira a descrição"/><br>
	<input type="submit" value="Atualizar" id="envia">
</form>
<?php
@$descricao=$_POST['desc'];
if (isset($descricao)) 
{
	$l1->atualizarDescricao($descricao,$codigo);
	header("location:ver-usuario.php?cdg=$codigo");
}
?>