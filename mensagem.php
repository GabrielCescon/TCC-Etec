<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<title>Mensagem</title>
	<link rel="stylesheet" href="css/estilo.css">
    <script type="text/javascript" src="js/funcoes.js"></script>
<?php
session_start();
require_once ('classes/usuario.class.php');
require_once ('classes/administrador.class.php');

@$codigo = $_GET['msg']; 
if (!isset($codigo)) // Se não tiver o código da mensagem na url, ele volta pra pagina anterior (mensagens.php)
{
    die ("<script>window.history.go(-1);</script>");
}
require_once ('classes/mensagem.class.php');
$m1= new Mensagem;
$mensagem= $m1->verMensagem($codigo);
if ($mensagem == false) // Checando se existe a mensagem
{
    die ("<script>window.history.go(-1);</script>");
}

?>
</head>
<body>
    <div class="bugfix-menu">
        <?php include "design/menu-half.php"; ?>
        <?php $menu=999; include "design/menu-full.php"; ?>
        <?php if (!isset($l1)) { die ("<script>window.history.go(-1);</script>");} elseif ($l1 instanceof Usuario) { die ("<script>window.history.go(-1);</script>"); } ?> <!-- Se você não for o admin, não pode acessa-la -->
        
    </div>
    <div class="top-img">
        <div><?php echo $mensagem[0][0]; ?></div>
    </div>
    <div class="conteudo1">
        <div class="msg-cont">
            <div class="msg-box">
                 <?php echo "<a style='text-decoration: none; color: white;' href='excluirmensagem.php?cdg=$codigo'>
                			<div class='msg-x'>X</div>
                		</a>";?>
                <h2>Email</h2>
                	<?php echo $mensagem[0][1]; ?>
                <h2>Mensagem</h2>
                	<?php echo $mensagem[0][2]; ?>
            </div>
            <div class="box-fantasma">.........</div>
            <a href="mensagens.php" class="post-botao" style="position: absolute;text-decoration:none;">Voltar</a>
        </div>
    </div>
    <?php include "design/rodape.php" ?>
    