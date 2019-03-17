<?php
require_once ('classes/usuario.class.php');
@$login = $_POST['email'];
@$cpf = $_POST['cpf'];
@$senha = $_POST['senha'];
if(isset($login) && $login != "" && isset($senha) && $senha!="" && isset($cpf) && $cpf !=""){
    $l1 = new Usuario();
    if($l1->validaCPF($cpf)==false){
        die("<script>alert('Dados incorretos');window.history.go(-2);</script>");
    }
    if($l1->deletar($login,$cpf,$senha)==true){
        $l1->logar($login,$senha);
        $_SESSION['objeto'] = serialize($l1);
	   header('location:index.php');
    }else{
        die("<script>alert('Dados incorretos');window.history.go(-1);</script>");
    }        
}else{
    die("<script>alert('Você Não tem acesso');window.history.go(-1);</script>");
}

?>