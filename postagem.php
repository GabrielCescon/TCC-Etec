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
@$codigo = $_GET['ptgs'];
if (!isset($codigo))
{
    die ("<script>window.history.go(-1);</script>");
}
require_once ('classes/postagens.class.php');
$p1 = new Postagens();
    @$relevantes = $p1->relevancia();
    @$linha2 = count($p1->relevancia());
    $postagem = $p1->verPostagem($codigo);
    $comentarios=$p1->comentarios($codigo);
    $quantos=count($comentarios);
?>
</head>
<body>
<style>
.topper-post{
    background-image: url(post-img/<?php echo $postagem[0][5];?>);
    height: auto;
    background-size: cover;
    transition: all ease .2s;
    padding-top: 8em;
    padding-bottom: 4em;
    background-position: center;
}
</style>
    <div class="bugfix-menu">
        <?php include "design/menu-half.php"; ?>
        <?php $menu=999; include "design/menu-full.php"; ?>
        <?php if (isset($l1)) {  if ($l1 instanceof Usuario) { $p1->visualicacoes($postagem[0][6],$l1->getCodigo());}} ?> <!-- Conta +1 vizualização se vc ainda n viu e é um usuario -->
    </div>
    <div class="topper-post">
        <div class="titulotopper"><?php echo $postagem[0][1];?></div>
        <div class="subpost-topper"><?php echo $postagem[0][2];?></div>
    </div>
    <div class="conteudo2">
        <div class="postagem-mestre">
            <div class="ver-postagem"><?php $texto=$postagem[0][3];include "classes/tradutor.php"; echo $texto;?></div>
            <br><br><br><br>
            <div class="botao2" onclick="self.location='blog.php';">Voltar</div><br>
            <?php
            if (isset($l1) && $l1 instanceof Administrador)  // APAGAR POSTAGEM
            {
                echo "<a href='excluirpostagem.php?cdg=$codigo' class='botao2' style='background-color:red;border-bottom-color: #970000;text-decoration: none; color: white;width:10%;'>Apagar</a>";
            }
            ?>
            <div class="comentarios">
                <?php if ($quantos > 0){echo "<h2>Comentarios</h2>";}?>
                <?php
                if (isset($l1) && $l1 instanceof Usuario)  // COMENTAR
                {$codigoU=$l1->getCodigo();
                    echo '
                    <form action="comentar.php?cdgu='.$codigoU.'&cdgp='.$codigo.'" method="post">
                    <div class="comentario">
                        <textarea name="comentario" required class="criar-com" maxlength="300" placeholder="Adicionar um comentario"></textarea><br>
                        <input type="submit" value="Enviar"/>
                    </div></form><br>';
                }?>
                <?php
                        
                        
                        if (!$comentarios)      // CASO NÃO HAJA COMENTARIOS
                        {}
                        else
                        {
                            for ($i=0; $i < $quantos; $i++) 
                            {
                                    echo '<div class="comentario">
                                     <div class="img-com" style="background-image:url(_fotosperfil/'.$comentarios[$i][3].');"></div>
                                        <div class="stuff-com">
                                            <span>'.$comentarios[$i][2].'</span><br>
                                            '.$comentarios[$i][0].'    
                                        </div><div class="box-fantasma">...</div>';
                            }
                        }
                    ?>
                    
                </div>
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
    height: 10vh;
    width: auto;
    background-size: cover;
    transition: all ease .2s;
    padding-top: 8em;
    padding-bottom: 4em;
    margin: -.5vh;
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
