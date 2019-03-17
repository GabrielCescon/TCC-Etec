<?php
$arq = "tradutor.php";#nome do arquivo. Isso evita um acesso direto pela URL.
if (strcmp(basename($_SERVER['PHP_SELF']), basename($arq)) === 0)
{
    header('location:../index.php');
}

/*INICIO*/
$texto = str_replace("/citacao/","<BR><div class='citacao'>&ldquo;",$texto);//Citação
$texto = str_replace("/imagem/","<BR><img class='imagem-adc' src='all-img/",$texto);//Imagem
$texto = str_replace("/url/","<a class='postagemlink' href='",$texto);//Link

/*MEIO*/
$texto = str_replace("/link/","'>",$texto);//Link

/*FINAL*/
$texto = str_replace("/c/","&rdquo;</div><BR><BR><BR>",$texto);//Citação
$texto = str_replace("/i/","'/>",$texto);//Imagem
$texto = str_replace("/ul/","</a>",$texto);
?>