<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<title>Contato</title>
	<link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/_cadastro.css">
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
        <?php $menu=4; include "design/menu-full.php"; ?>
        <?php if ($l1 instanceof Administrador) { die ("<script>window.location='usuarios.php';</script>"); } ?> <!-- Se você for o admin, não pode acessa-la -->
    </div>
    <div class="top-img">
        <div>CONTATO</div>
    </div>
    <div class="conteudo3">
    <div class="tellme-box">
        <h2>Título Contato</h2>
    <form method="POST" action="contato2.php">
    <div class="tellme-form">
    <?php 
     if (!isset($l1)) 
     {
        echo
        '<p><h3 style="margin-bottom:0;">Nome</h3><input class="ct-nm" type="text" name="nome" placeholder="Completo" required=""></p>
        <p><h3 style="margin-bottom:0;">Email</h3><input class="ct-em" type="email" name="email" placeholder="E-mail" required="@"></p>';
    }
    else
    {
        echo
        '<input style="display:none;" type="text" name="nome" value="'.$l1->getNome().'" required="">
        <input style="display: none;" type="email" name="email" value="'.$l1->getEmail().'" placeholder="E-mail" required="@">';
    }
    ?>    
        <h3 style="margin-bottom:0;">Mensagem</h3><textarea class="ct-txt" name="mensagem" placeholder="Assunto" rows="10" cols="42"></textarea>
        <p><input class="ct-bt" type="submit" enviar="Enviar"></p>
    </div>
    </form>
    <div class="ct-texto">
    Envie uma mensagem pelo formulario ao lado e iremos lhe responder o mais breve possivel.<br><br>
    Email: email@email<br>
    Telefone: (13) xxxx-xxxx
    </div>
    </div>
    </div>
    <?php include "design/rodape.php" ?>
    