<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<title>Blog</title>
	<link rel="stylesheet" href="css/estilo.css">
    <script type="text/javascript" src="js/funcoes.js"></script>
<?php
session_start();
require_once ('classes/usuario.class.php');
require_once ('classes/administrador.class.php');
require_once ('classes/postagens.class.php');
$p1 = new Postagens();
    @$posts = $p1->feedPostagens(@$_GET['pag']);
    @$relevantes = $p1->relevancia();
	@$linha = count($posts);
	@$linha2 = count($relevantes);
?>
</head>
<body>
    <div class="bugfix-menu">
        <?php include "design/menu-half.php"; ?>
        <?php $menu=2; include "design/menu-full.php"; ?>
    </div>
    <div class="top-img">
        <div>BLOG</div>
    </div>
    <div class="conteudo2">
        <div class="postagem-mestre">
            <H1>Ultimas postagens</H1>
           <?php
            if (!$posts)
            {
                echo "Sem postagens no momento";
            }
            else
            {
                for ($i=0; $i < $linha; $i++) 
                {
                    $codigo=$posts[$i][6];
                    $titulo=$posts[$i][1];
                    $nso=$posts[$i][1];
                    $nso=str_replace(" ","",$nso);
                   echo"<style>
                        .".$nso."{
                        background-image: url(post-img/".$posts[$i][5].");
                        width: 100%;
                        height: auto;
                        background-size: cover;
                        transition: all ease .2s;
                        padding-top: 16em;
                        padding-bottom: 4em;
                        border-top-left-radius: 1vh;
                        border-top-right-radius: 1vh;
                        background-position: center;
                        }</style>
                       <div class='postagem'>";
                       if (isset($l1) && $l1 instanceof Administrador)  // APAGAR POSTAGEM
                        {
                            echo "<a style='text-decoration: none; color: white;' href='excluirpostagem.php?cdg=$codigo'><div class='msg-x' style='border-top-right-radius: 1vh;'>X</div></a>";
                        }
                       echo "<div class='".$nso."'></div>
                                <div class='post-titulo'>$titulo</div>
                                <div class='post-text'>".$posts[$i][2]."</div>
                                <a style='text-decoration:none'  href='postagem.php?ptgs=$codigo'><div class='post-botao'>Continue Lendo</div></a><div class='box-fantasma'>...</div><br><br>
                            </div><br>";
                }
            }  
            ?>
        <div class="paginacao-mestre">
        <?php
            if(isset($posts)&&$posts != false){#se não houver POST não tem pq aparecer paginação
            $p1->paginacaoBlog(@$_GET['pag']);#função que chama a paginação paginação.
            }?>
        </div>
        </div>
        <div class="top-post">
            <h2>Mais visitados</h2>
            <?php
                if (!$relevantes)
                {
                    echo "Sem postagens no momento";
                }
                else
                {
                    for ($i=0; $i < $linha2; $i++) 
                    {
                    $codigo=$relevantes[$i][0];
                    $nsod=$relevantes[$i][1];
                    $nsod=str_replace(" ","-",$nsod);
                    echo"<style>
    .".$nsod."{
    background-image: url(post-img/".$relevantes[$i][2].");
    background-position: center;
    height: 0px;
    width: auto;
    background-size: cover;
    transition: all ease .2s;
    padding-top: 8em;
    padding-bottom: 4em;
    margin: -.5vh;
    border-top-left-radius: 1vh;
    border-top-right-radius: 1vh;
    }</style>
                    <a style='text-decoration:none' href='postagem.php?ptgs=$codigo'><div class='top-box'>
                                    <div class='".$nsod."'></div>
                                    <div class='top-txt'>".$relevantes[$i][1]."</div>
                                </div></a>";
                    }
                }  
            ?>
        </div>
        
    </div>
    <div class="box-fantasma">........</div>
    <?php include "design/rodape.php" ?>
    

