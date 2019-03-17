<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<title>Administrador</title>
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
        <?php $menu=123; include "design/menu-full.php"; ?>
    </div>
    <div class="top-img">
        <div class="tit-bugfix">ADMINISTRADOR</div>
    </div>
    <div class="conteudo1">
        <div class="central">
        <a href="usuarios.php">
            <div style="float: left;margin:2.5%;">
                <div class="box-tool" style="background-image: url(imagens/usuario.png);"></div>
                <div class="adm-tit">USUARIOS</div>
            </div>
        </a>
        <a href="criar-post.php">
            <div style="float: left;margin:2.5%;">
                <div class="box-tool" style="background-image: url(imagens/postar.png);"></div>
                <div class="adm-tit">POSTAGEM</div>
            </div>
        </a>
        <a href="mensagens.php">
            <div style="float: left;margin:2.5%;">
                <div class="box-tool" style="background-image: url(imagens/mensagem.png);"></div>
                <div class="adm-tit">MENSAGENS</div>
            </div>
        </a>
        <a href="">
            <div style="float: left;margin:2.5%;">
                <div class="box-tool" style="background-image: url(imagens/consulta.png);"></div>
                <div class="adm-tit">ATENDIMENTO</div>
            </div>
        </a>
        <a href="total-consultas.php">
            <div style="float: left;margin:2.5%;">
                <div class="box-tool" style="background-image: url(imagens/historico.png);"></div>
                <div class="adm-tit">HISTORICO</div>
            </div>
        </a>
        <a href="ver-consultas.php">
            <div style="float: left;margin:2.5%;">
                <div class="box-tool" style="background-image: url(imagens/calendario.png);"></div>
                <div class="adm-tit">CALENDARIO</div>
            </div>
        </a>
        </div>
        <div class="box-fantasma">...</div>
    </div>
    <?php include "design/rodape.php" ?>
    