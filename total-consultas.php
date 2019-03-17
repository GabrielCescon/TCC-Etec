<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<title>Histórico</title>
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
        <div>Histórico Consultas</div>
    </div>
    <div class="conteudo1" style="display: flex;flex-direction: row;justify-content: center;align-items: center;">
        
        <div class="usuarios-mestre">
        <div style="">
            <h2 class="codigo-tit">Realizar pesquisa de Usuarios</h2>
            <div>
                <form method="GET" action="total-consultas.php">
                    <h3>Nome</h3>
                    <input id="titulopost" name="titulopost" type="text" maxlength="150" class="botaotitulo"/><br><br>
                    <input id="send" type="submit" alt="Pesquisar" value="Pesquisar" class="publicado">
                    <br><br><br>
                </form>
            </div>
        </div>
        <div class="box-usuarioss">
        
            <?php
    $user = $l1->consultaUser(@$_GET['titulopost'],@$_GET['pag']);#função que chama os usuarios
        #$row = $user->rowCount();#verifica o numero de linhas da procura
        if(@$_GET['titulopost']=="" && isset($_GET['titulopost'])){#se não mandar nenhum texto ou não houver nenhuma linha
            echo"<h1 style='margin-top:0;'>Nenhum resultado na pesquisa</h1>";
        }else{
            echo "<h1 style='margin-top:0;'>Resultados da Pesquisa</h1>";
        }
            $dia = date("Y-m-d");
            while($mostra = $user->fetch(PDO::FETCH_ASSOC)){
                $codigo = $mostra['cd_usuario'];
                $foto = $mostra['ds_imagem'];
                $nome = $mostra['nm_usuario'];
                $email = $mostra['nm_email'];
                $resta = $mostra['qt_consultas'];
                $ativo = $mostra['ic_ativo'];
                $obs = $mostra['ds_obs'];
                $inicio = $mostra['hr_inicio_consulta'];
                $fim = $mostra['hr_fim_consulta'];
                $inicioD = $l1->verQuando2($inicio,$fim);
                $estado = $l1->estadoConsulta($inicio,$fim,$obs);
    
   echo "<a style='text-decoration:none; color:black;' href='ver-usuario.php?cdg=$codigo'>";?>
                <div class="box-usuario">
                    <div class="user-img10" style="background-image:<?php echo'url(_fotosperfil/'.$foto.')';?>;border-color:<?php if($ativo == '0') {echo 'red';} elseif($ativo == '1'){echo 'green';}elseif($ativo == '2'){echo 'yellow';}?>">
                    <div class="dados-usuario">
                        <div class="dado-user">
                        Nome: <?php echo $nome; ?>
                        </div><br>
                        <div class="dado-user">
                        Email: <?php echo $email; ?>
                        </div><br>
                        <div class="dado-user">
                        Data: <?php echo $inicioD; ?>
                        </div><br>
                        <div class="dado-user">
                        Estado: <?php if($estado == "ant"){echo "MARCADA";}elseif($estado == "mom"){echo "ACONTECENDO";}elseif($estado == "can"){echo "CANCELADA";}elseif($estado == "feito"){echo"REALIZADA";} ?>
                        </div><br>
                    </div>
                </div>
            </a>
            <div class="box-fantasma">...</div>
        </div>
        <br>
        <?php }?>
        <div class="paginacao-mestre">
        <?php
            if(@$_GET['titulopost']=="" || isset($_GET['titulopost'])){#se não houver titulopost não tem pq aparecer paginação
            $l1->consultasFullPag(@$_GET['titulopost'],@$_GET['pag']);#função que chama a paginação paginação.
            }?>
        </div>
        </div>
    </div>
    </div>
    <div class="box-fantasma">........</div>
    <?php include "design/rodape.php" ?>