<?php
require_once ('classes/administrador.class.php');
require_once ('classes/usuario.class.php');
@$login = $_POST['email'];
@$senha = $_POST['senha'];

$l1 = new Administrador();	// $l1 = vai testar o log in do admin
if ($l1->logar($login,$senha) == true) // vai ver se deu certo o log in do admin
{
	$_SESSION['objeto'] = serialize($l1);
	header('location:index-adm.php');
}
else
{
$l1 = new Usuario();  // se não deu certo tenta o log in pra usuario
	if ($l1->logar($login,$senha) == '1')
	{
		$_SESSION['objeto'] = serialize($l1);
		header('location:index.php');
	}elseif($l1->logar($login,$senha) == '2'){
        header("location:ativa_user.php?email=$login");
    }elseif($l1->logar($login,$senha) == '0'){
        die("<script>alert('Você foi desativado pelo administrador');window.history.go(-1);</script>");
    }
	elseif($l1->logar($login,$senha) == "nao")
	{
		die("<script>alert('Dados Invalidos');window.history.go(-1);</script>");
	}
}
?>