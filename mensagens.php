<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<title>Mensagens</title>
	<link rel="stylesheet" href="css/estilo.css">
    <script type="text/javascript" src="js/funcoes.js"></script>
<?php
session_start();
require_once ('classes/usuario.class.php');
require_once ('classes/administrador.class.php');
require_once ('classes/mensagem.class.php');

$m1= new Mensagem;
$mens= $m1->verMensagens();
@$linha = count($mens);
?>
</head>
<body>
    <div class="bugfix-menu">
        <?php include "design/menu-half.php"; ?>
        <?php $menu=999; include "design/menu-full.php"; ?>
        <?php if (!isset($l1)) { die ("<script>window.history.go(-1);</script>");} elseif ($l1 instanceof Usuario) { die ("<script>window.history.go(-1);</script>"); } ?> <!-- Se você não for o admin, não pode acessa-la -->

    </div>
    <div class="top-img">
        <div>MENSAGEM</div>
    </div>
    <div class="conteudo1">
        <h1 class="msg-tit">Todas as mensagens enviadas em ordem de chegada</h1>
        <div class="msg-cont">
            <?php
                if (!$mens)
                {
                    echo "Sem mensagens no momento";
                }
                else
                {
                    for ($i=0; $i < $linha; $i++) 
                    {   $codigo=$mens[$i][0];
                        echo "<div class='bugfix-msg'><a style='text-decoration: none; color: white;' href='excluirmensagem.php?cdg=$codigo'><div class='bugfix-x'><div class='msg-x'>X</div></div>
                        </a><a style='text-decoration:none; color:black;' href='mensagem.php?msg=$codigo'>
                                    <div class='msg-box-lista' function=adawdw>
                                        <h2>".$mens[$i][1]."</h2>
                                        ".$mens[$i][2]."
                                    </div>
                                </a></div><div class='box-fantasma'>.........</div>";
                    }
                }
            ?>
            
        </div>
    </div>
    <?php include "design/rodape.php"; ?>

