<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<title>Lista de Consultas</title>
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
        <?php if (!isset($l1)) { die ("<script>window.history.go(-1);</script>");} elseif ($l1 instanceof Usuario) { die ("<script>window.history.go(-1);</script>"); }?>
    </div>
    <div class="top-img">
        <div>LISTA DE CONSULTAS</div>
    </div>
    <div class="conteudo1">
        <?php
        if($l1->verConsulta(@$_GET['pag'])==false){
            echo "Sem Consultas Agendadas";
        }else{
            $consult = $l1->verConsulta(@$_GET['pag']);
        while($cons = $consult->fetch(PDO::FETCH_ASSOC)){
            $cod = $cons['cd_usuario'];
            $nome = $cons['nm_usuario'];
            $data = $l1->verQuando($cons['hr_inicio_consulta']);
            $imagem = $cons['ds_imagem'];
            
        echo "<a style='text-decoration:none; color:black;' href='fazer-consultas.php?cdg=$cod'>";?>
        <div class="consultas">
            <div class="img-consulta" style="background-image: url(_fotosperfil/<?php echo $imagem;?>);float:left;"></div>
            <div class="titulo-consulta" style="float:left;">
                <div><?php echo $nome ;?></div>
                <div><?php echo $data ;?></div>
                <div>Tempo</div>
                <div>Status</div>
            </div>
            <div class="box-fantasma">....</div>
        </div>
        </a>
        <?php }} ?>
        <div class="paginacao-mestre">
        <?php
            if(isset($consult)){#se não houver POST não tem pq aparecer paginação
            $l1->paginacaoConsulta(@$_GET['pag']);#função que chama a paginação paginação.
            }?>
        </div>
    </div>
    <?php include "design/rodape.php" ?>
    