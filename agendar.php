<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<title>Agendar</title>
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
    $cons = $l1->recomenda();
?>
    </div>
    <div class="top-img">
        <div>AGENDAR</div>
    </div>
    <div class="conteudo1" style="text-align: center;justify-content: center;align-items: center;">
        <form method="GET" action="agendar2.php">
        <div>
        <h3>Coloque os dados abaixo para agendar a consulta</h3>
        <span style="font-size:2em;"><?php echo $usuario['nm_usuario'];?></span><br><br>
        <h3>Data recomendada</h3>
        <span style="font-size:2em;"><?php echo $usuario['nm_periodoconsulta']." : ".$cons;?></span><br><br>
        <span style="font-size:1.5em;"><?php echo $usuario['cd_cpf'];?></span><br><br>
        <input type="date" name="data" class="agenda-nome" required>
        <input type="time" name="time" class="agenda-nome" required>
        <input type="text" name="cdg" style="display:none;" value="<?php echo $codigo;?>">
        <br><br>
        <input type="submit" value="Agendar" class="post-botao" style="float: none;">        
        </div>
        </form>
    </div>
    <?php include "design/rodape.php" ?>
    