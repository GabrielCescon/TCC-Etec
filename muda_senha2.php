<?php
require_once ('classes/administrador.class.php');
require_once ('classes/usuario.class.php');
$email = $_POST['email'];
$senha = $_POST['senha'];
$cpf = $_POST['cpf'];

if(isset($email) && $email != "" && isset($senha) && $senha!="" && isset($cpf) && $cpf !=""){
    $l1 = new Administrador();
    if($l1->validaCPF($cpf)==false){
        die("<script>alert('CPF Invalido');window.history.go(-2);</script>");
    }
    if($l1->atualizarSenha($senha,$email,$cpf)==true){
        die("<script>alert('Senha alterada com sucesso');window.history.go(-2);</script>");
    }else{
        $l1 = new Usuario();
        if($l1->validaCPF($cpf)==false){
        die("<script>alert('CPF Invalido');window.history.go(-2);</script>");
        }
        if($l1->atualizarSenha($senha,$email,$cpf)==true){
            die("<script>alert('Senha alterada com sucesso');window.history.go(-2);</script>");
        }else{
            die("<script>alert('Dados Invalidos');window.history.go(-2);</script>");
        }
    }
}else{
    header("location:index.php");
}

?>