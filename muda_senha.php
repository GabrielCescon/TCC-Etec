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
?>
<div class="top-img">
    <div>Alterar Senha</div>
</div>
<div class="conteudo1">
    <div class="cad-ext">
<form method="post" action="muda_senha2.php">
        <div class="cad-elem">
        <input type="email" class="caixa" name="email" placeholder="Email" required>
        </div>
        <div class="cad-elem">
        <input type="text" class="caixa" name="cpf" id="cpf" placeholder="CPF" onblur="javascript: validarCPF(this.value);" onkeypress="javascript: mascara(this, cpf_mask);"  maxlength="14" required/>
        </div>
        <div class="cad-elem">
        <input type="password" id="chave" name="senha" class="caixa" required placeholder="Nova Senha">
        </div>
        <div class="cad-elem">
        <input type="password" id="chave2" name="s2" class="caixa"  placeholder="Confime nova senha" required oninput="validaSenha(this)">
        </div>
            <input type="submit" value="Alterar" id="envia">
        </form>
    </div>
</div>
<?php include "design/rodape.php" ?>    
    </body>
</html>