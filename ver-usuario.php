<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<title>Usuario</title>
	<link rel="stylesheet" href="css/estilo.css">
    <script type="text/javascript" src="js/funcoes.js"></script>
<?php
session_start();
require_once ('classes/usuario.class.php');
require_once ('classes/administrador.class.php');
?>
</head>
<body>
<div class="bugfix-menu">
        <?php include "design/menu-half.php"; ?>
        <?php $menu=999; include "design/menu-full.php"; ?>
        <?php if (!isset($l1)) { die ("<script>window.history.go(-1);</script>");} elseif ($l1 instanceof Usuario) { die ("<script>window.history.go(-1);</script>"); } ?> <!-- Se você não for o admin, não pode acessa-la -->
<?php
$codigo=$_GET['cdg'];
    if ($l1 instanceof Usuario){
        header("location:ver-dados.php?cdg=$codigo");
    }
    $usuario=$l1->pegarUsuario($codigo);
    $ativo=$usuario['ic_ativo'];
?>
</div>
<div class="top-img">
    <div><?php echo $usuario['nm_usuario'];?></div>
</div>
<div class="conteudo1">
    <div class="box-usuario">
        <?php echo "<img src='_fotosperfil/".$usuario['ds_imagem']."'/>'";?>
        <div class="box-total">
        <div class="box-dados">
            <span>Apelido</span><br>
            <?php echo $usuario['nm_usuario'];?>
        </div>
        <div class="box-dados">
            <span>Email</span><br>
            <?php echo $usuario['nm_email'];?>
        </div>
        <div class="box-dados">
            <span>Nascimento</span><br>
            <?php echo implode("/",array_reverse(explode("-",$usuario['dt_nascimento'])));?>
        </div>
        <div class="box-dados">
            <span>Cadastro</span><br>
            <?php echo substr($usuario['dt_chegada'],11,16)."<br>".implode("/",array_reverse(explode("-",substr($usuario['dt_chegada'],0,10))));?>
        </div>
        <div class="box-dados">
            <span>Periodo de Consulta</span><br>
            <?php echo $usuario['nm_periodoconsulta'];?>
        </div>
        <div class="box-dados">
            <span>Contato</span><br>
            <?php echo "<b>Skype:</b> ".$usuario['nm_virtual'];?><br>
            <?php echo "<b>Telefone Fixo:</b> ".$usuario['cd_ddd_tel']." ".$usuario['cd_telefone'];?><br>
            <?php echo "<b>Telefone Celular:</b> ".$usuario['cd_ddd_cel']." ".$usuario['cd_celular'];?>
        </div>
        </div>
        <div class="box-total">
        <div class="box-descricao">
            <span>Descrição</span><br>
            <?php echo $usuario['ds_usuario'];?>
        </div>
        <br><br><br>
        <div class="pack-botoes">
        <?php echo "<a href='descricaousuario.php?cdg=$codigo'";?> class="publicadoclone" style="text-decoration:none;width:40vh;text-align:center;">Modificar Descrição</a>
        <?php 
        if($ativo == '1') // USUARIO ATIVO 
        {
            echo "<a href='excluirusuario.php?cdg=$codigo&com=deleta' class='publicadoclone' style='width:40vh;text-decoration:none;text-align:center;background-color: #ff4141;border-bottom-color: #b71d1d;'>Desativar Usuario</a>";
        }
        elseif($ativo == '2')  // USUARIO INATIVO
        {
            echo "<a href='excluirusuario.php?cdg=$codigo&com=deleta' class='publicadoclone' style='width:40vh;text-align:center;text-decoration:none;background-color: #ff4141;border-bottom-color: #b71d1d;'>Desativar Usuario</a>";
            echo "<a style='text-decoration:none; color:black;' href='excluirusuario.php?cdg=$codigo&com=ativa'><div class='publicadoclone' style='width:40vh;text-align:center;background-color: #57ff41;border-bottom-color: #1db723;'>Reativar Usuario</div></a>";
        }else{
            echo "<a href='excluirusuario.php?cdg=$codigo&com=ativa' class='publicadoclone' style='width:40vh;text-align:center;background-color: #57ff41;border-bottom-color: #1db723;text-decoration:none;'>Reativar Usuario</a>";
        }
        ?>
        <?php echo '
        <a href="agendar.php?cdg='.$codigo;?>"class="publicadoclone" style="text-decoration:none;width:40vh;text-align:center;background-color:#ffd341;color:black;border-bottom-color: #b79f1d;">Marcar Consulta</a>
        </div>
        </div>
        <div class="box-fantasma">.......</div>
    </div>
</div>
<div class="box-fantasma">.......</div>
<?php include "design/rodape.php" ?>    


