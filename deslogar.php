<?php
require_once ('classes/administrador.class.php');
require_once ('classes/usuario.class.php');
session_start();
    if (isset($_SESSION['objeto'])) 
    {
        @$l1 = unserialize($_SESSION['objeto']);
    }
if (isset($l1))
{
    if ($l1 instanceof Usuario) // Se quem estiver Logado for um Usuario
    {
        $email = $l1->getEmail();
        $senha = $l1->getSenha();
        $l1 = new Usuario;
        $l1->logar($email,$senha);
        $l1->deslogar();
    }
    if ($l1 instanceof Administrador) // Se quem estiver Logado for um Administrador
    {
        $email = $l1->getEmail();
        $senha = $l1->getSenha();
        $l1 = new Administrador;
        $l1->logar($email,$senha);
        $l1->deslogar();
    }
}
session_destroy();
unset($l1);
echo "<script>window.history.go(-1);</script>";
?>