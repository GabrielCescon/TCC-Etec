<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<title>Pesquisar Usuarios</title>
	<link rel="stylesheet" href="css/estilo.css">
    <script type="text/javascript" src="js/cpf.js"></script>
    <script type="text/javascript" src="js/funcoes.js"></script>
</head>
<body>
<div class="bugfix-menu">
        <?php include "design/menu-half.php"; ?>
        <?php $menu=999; include "design/menu-full.php"; ?>
</div>
    <?php
require_once ('classes/usuario.class.php');
 if(isset($_GET['email'])&& $_GET['email']!=""){
$login = $_GET['email'];
    }else{
        header("location:index.php");
    }
?>
<div class="top-img">
    <div>Reativar Conta</div>
</div>
<div class="conteudo1">
    <div class="cad-ext">
<form method="post" action="ativa_user2.php">
        <input type="text" style="display:none;" name="email" value="<?php echo $login ?>">
        <div class="cad-elem">
        <input type="text" class="caixa" name="cpf" id="cpf" placeholder="CPF" onblur="javascript: validarCPF(this.value);" onkeypress="javascript: mascara(this, cpf_mask);"  maxlength="14" />
        </div>
        <div class="cad-elem">
        <input type="password" class="caixa" name="senha" placeholder="Senha" required>
        </div>
            <input type="submit" value="Reativar" id="envia">
        </form>
    </div>
</div>
<?php include "design/rodape.php" ?>    
    </body>
</html>