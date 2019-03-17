<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<title>Criar postagem</title>
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
    </div>
    <div class="top-img">
        <div>CRIAR POSTAGEM</div>
    </div>
    <div class="conteudo1">
        <div class="postagem-mestre">
        <div class="box-codigo"><?php $codigo = $l1->getCodigo();?>
        <form action="criar-post2.php?codigo=<?php echo $codigo;?>" name="p" method="POST" enctype="multipart/form-data">
        <div class="form1">
           <h1>Complete os campos abaixos</h1>
           <h2>Título</h2>
	       <input id="titulopost" name="titulopost" type="text" maxlength="150" class="botaotitulo" required=""/>
           <h2>Breve descrição da postagem</h2>
	       <input id="subtitulopost" name="subtitulopost" type="text" maxlength="300" class="botaotitulo" required=""/>
           <h2>Postagem</h2>
           <textarea id="post" name="post" type="text" alt="Poste aqui" maxlength="1000" class="caixapost" required=""></textarea>
           <h2>Imagem Principal</h2>
           <input type="file" name="upload" value="Imagens" class="botaoimagem" required="">
           <br>
           <h2>Outras Imagens</h2>
           <input type="file" multiple name="outras[]" value="Imagens" class="botaoimagem">
           <br>
           <input id="send" type="submit" alt="Publicar" value="Publicar" class="publicado">
           <div class="box-fantasma">........</div>
           </form>
           <br><br>
        </div>
        </div>
        </div>
        <div class="top-post">
            <h2 class="codigo-tit">Guia de códigos da postagem</h2>
            <div class="box-codigo2">
                <h3>Citação</h3>
                Antes do inicio da citação deve se colocar o código<div class="exibir">/citacao/</div>e no final o código<div class="exibir">/c/</div>
                <h4>exemplo</h4>
                /citacao/Exemplo/c/
                <h3>Imagem</h3>
                Faça o upload de suas imagens e coloque de inicio<div class="exibir">/imagem/</div>e no final use<div class="exibir">/i/</div>
                <h3>Links</h3>
            </div>
        </div>
    </div>
    <div class="box-fantasma">........</div>
    <?php include "design/rodape.php" ?>
    