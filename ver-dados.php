<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<title>Dados</title>
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
        <?php  include "design/menu-full.php"; ?>
        <?php if (!isset($l1)) { die ("<script>window.location='index.php';</script>"); } ?> <!-- Se você for o admin, não pode acessa-la -->
</div>
<div class="top-img" >
    <div><?php echo $l1->getNome(); ?></div>
</div>
<div class="conteudo1">
    <div class="box-usuario">
        <?php echo "<img src='_fotosperfil/".$l1->getImagem()."'>";?>
        <div class="box-total">
        <div class="box-dados">
            <span>Apelido</span><br>
            <?php echo $l1->getApelido(); ?>
        </div>
        <div class="box-dados">
            <span>Email</span><br>
            <?php echo $l1->getEmail(); ?>
        </div>
        <div class="box-dados">
            <span>Nascimento</span><br>
            <?php echo implode("/",array_reverse(explode("-",$l1->getNasc())));?>
        </div>
        <div class="box-dados">
            <span>Periodo de Consulta</span><br>
            <?php echo $l1->getPeriodo(); ?>
        </div>
        </div>
        <div class="box-total">
        <div class="pack-botoes">
            <a style='text-decoration:none; color:black;' href="editar-dados.php"><div class="publicado" style="width:40vh;text-align:center;">Editar Dados</div></a>
        <a style='text-decoration:none; color:black;' href="excluirusuario.php"><div class="publicado" style="width:40vh;text-align:center;background-color: #ff4141;border-bottom-color: #b71d1d;">Desativar Conta</div></a>
        </div>
        </div>
        <div class="box-fantasma">.......</div>
    </div>
</div>
<?php include "design/rodape.php" ?>    