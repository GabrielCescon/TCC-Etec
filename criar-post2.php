<?php
require_once("classes/postagens.class.php");

$codigo=$_GET['codigo'];
$titulo=$_POST['titulopost'];
$subtitulo=$_POST['subtitulopost'];
$post=$_POST['post'];
$imagem=array("arqName"=>$_FILES['upload']['name'], "arqType" => $_FILES['upload']['type'], "arqSize" => $_FILES['upload']['size'], "arqTemp" => $_FILES['upload']['tmp_name']);

$p1=new Postagens;
$p1->criarPostagem($titulo,$subtitulo,$post,$imagem,$codigo);
$i = 0;
foreach ($_FILES["outras"]["error"] as $arqError => $error)   #Analisa cada arquivo
{
    
	$num=$i+1;
	if ($error==4)
	{
		die("<script>self.location='blog.php';</script>");
	}
	else if ($error!=0) 
	{
		$num=$i+1;
		die("<script>alert('A ".$num."º imagem teve um problema');self.location='blog.php';</script>");
	}
	else
	{
		$arqName = $_FILES['outras']['name'][$i]; // O nome original do arquivo no computador do usuário
		$arqTemp = $_FILES['outras']['tmp_name'][$i]; // O nome temporário do arquivo, como foi guardado no servidor
		$arqType = $_FILES['outras']['type'][$i]; // O tipo mime do arquivo. Um exemplo pode ser "image/gif"
		$arqSize = $_FILES['outras']['size'][$i]; // O tamanho, em bytes, do arquivo

  		$pasta = 'all-img/';
      		$up = move_uploaded_file($arqTemp, $pasta . $arqName); // Essa função pega o nome dado pelo servidos e a 	pasta que ficará o arquivo junto com seu novo nome (caso for mudar o nome lembre de pegar sua extensão)
	
		$i++;  #Próximo arquivo a ser analisado
	}
}
header("location:blog.php");
?>

