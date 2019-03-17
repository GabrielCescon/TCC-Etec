<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<title>Home</title>
	<link rel="stylesheet" href="css/estilo.css">
    <script type="text/javascript" src="js/funcoes.js"></script>
<?php
session_start();
require_once ('classes/usuario.class.php');
require_once ('classes/administrador.class.php');
?>
</head>
<body>
    <header>
        <div>
        <?php include "design/menu-half.php"; ?>
        <?php $menu=1; include "design/menu-full.php"; ?>
        <?php if ($l1 instanceof Administrador) { die ("<script>window.location='index-adm.php';</script>"); } ?> <!-- Se você for o admin, é movido para o index-adm -->
        </div>
        <div class="home-page">
            <a href="#" class="botao1">Botão Ancora</a>
        </div>
    </header>
    <div class="conteudo1">
        <div class="box-news">
            <h1>Título</h1>
        </div>
    </div>
    <div class="box-fantasma">........</div>
    <?php include "design/rodape.php" ?>