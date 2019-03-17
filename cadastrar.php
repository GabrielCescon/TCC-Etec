<meta charset="UTF-8">
<pre>
<?php
if(!isset($_POST['nome'])||!isset($_POST['email'])||!isset($_POST['cpf'])||!isset($_POST['senha'])){
    header('location:index.php');
}
require_once ('classes/usuario.class.php');

$l1 = new Usuario;
$l1->setNome($_POST['nome']);
$l1->setEmail($_POST['email']);
$l1->setCPF($_POST['cpf']);
$l1->setPeriodo($_POST['consulta']);
$l1->tel($_POST['tel1']);
$l1->cel($_POST['tel2']);
$l1->setApelido($_POST['apelido']);
$l1->setEstado($_POST['estado']);
$l1->setCidade($_POST['cidade']);
$l1->setNasc($_POST['data']);
$l1->setUser($_POST['user']);
$l1->setSenha(sha1($_POST['senha']));


if($l1->verificaEmail()==false){
    
    die("<script>alert('Email Invalido');window.history.go(-1);</script>");
    
}elseif($l1->verificaCPF()==false || $l1->validaCPF($l1->getCPF()) == false){
    
    die("<script>alert('Erro ao cadastrar-se');window.history.go(-1);</script>");
    
}elseif($l1->verificaApelido()==false){
    
    die("<script>alert('Apelido Invalido');window.history.go(-1);</script>");
    
}elseif($l1->verificaSkype()==false){
    
    die("<script>alert('Skype Invalido');window.history.go(-1);</script>");
    
}else{


if($l1->verificaCadastro()==true){
$l1->cadastroUser();

// LOGANDO
if($l1->logar($_POST['email'],$_POST['senha']) == true){
	$_SESSION['objeto'] = serialize($l1);
	header('location:index.php');
}else{
	die("<script>alert('Erro ao Logar');</script>");
    header('location:index.php');
}

}else{
    die("<script>alert('Erro ao cadastrar-se');window.history.go(-1);</script>");
}
}

?>
</pre>