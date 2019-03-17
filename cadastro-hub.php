<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<title>Conta</title>
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
        <?php if (isset($l1)) { die ("<script>window.history.go(-1);</script>"); } ?> <!-- Se você já estiver logado, não pode acessa-la -->
    </div>
    <div class="top-img">
        <div>CONTA</div>
    </div>
    <div class="conteudo1">
        <div class="cadastro-log">
        <div class="log">
            <form method="POST" action="usuario_adm.php">
                <h3 class="titulo-ct-box">Já sou cadastrado</h3>
                <p><input type="email" class="box-text-ct" name="email" placeholder="Email" required="@"></p>
                <p><input type="password" class="box-text-ct" name="senha" placeholder="Senha" required ></p>
                <p><a href="muda_senha.php" style="text-decoration:none;color:black;">Esqueci minha senha</a></p>
                <p><input type="submit" class="bt-ct-pg" value="Acessar"></p>
            </form>
        </div>
        <div class="cadastro">
            <form method="POST" action="cadastro-full.php">
                <h3 class="titulo-ct-box">Criar uma nova conta</h3>
                <p><input type="text" class="box-text-ct" name="nome" placeholder="Nome Completo" required></p>
                <p><input type="email" class="box-text-ct" name="email" placeholder="Email" required="@"></p>
                <p><input type="password" class="box-text-ct" name="senha" placeholder="Senha" required ></p>
                <p><input type="submit" value="Cadastrar" class="bt-ct-pg"></p>
            </form>
        </div>
        </div>
        <div class="box-fantasmac">.</div>
    </div>
    <?php include "design/rodape.php" ?>