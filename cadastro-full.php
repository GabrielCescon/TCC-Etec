<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<title>Cadastro</title>
	<link rel="stylesheet" href="css/estilo.css">
    <script type="text/javascript" src="js/funcoes.js"></script>
    <script type="text/javascript" src="js/cpf.js"></script>
    <script src="js/jquery-3.1.1.js"></script>
    <script>
	    function buscar_cidades(){
	      var estado = $('#estado').val();
	      if(estado){
	        var url = 'cidade.php?estado='+estado;
	        $.get(url, function(dataReturn) {
	          $('#load_cidades').html(dataReturn);
	        });
	      }
	    }
	    function formatar(mascara, documento) // Arrumar a Data
	    {
	      var i = documento.value.length;
	      var saida = mascara.substring(0,1);
	      var texto = mascara.substring(i)
	      
	      if (texto.substring(0,1) != saida)
	      {
	                documento.value += texto.substring(0,1);
	      }
	      
	    }
    </script>
</head>
<body>
    <div class="bugfix-menu">
        <?php include "design/menu-half.php"; ?>
        <?php $menu=999; include "design/menu-full.php"; ?>
        <?php if (isset($l1)) { die ("<script>window.history.go(-1);</script>"); } ?> <!-- Se você já estiver logado, não pode acessa-la -->
    </div>
    <div class="top-img">
        <div><br>CADASTRO</div>
    </div>
<div class="conteudo1">
<?php
@$nome = $_POST['nome'];
@$email = $_POST['email'];
@$senha = $_POST['senha'];
date_default_timezone_set('America/Sao_Paulo');
$certo = date("d/m")."/".(date("Y") - 18);
require_once ('classes/estado.class.php');
    $e1 = new Estado();
    $linha=count($e1->estados());
    $uf=$e1->estados();
?>
<div class="cad-ext">
<form method="POST" action="cadastrar.php" id="cad" name="f1">
    <h3>Digite os dados abaixo</h3>
    <div class="cad-elem"><h4>Nome</h4>
        <input type="text" class="caixa" id="n" name="nome" placeholder="Nome Completo" required="" value="<?php echo $nome ;?>">
    </div>
    <div class="cad-elem"><h4>Email</h4>
        <input type="email" class="caixa" id="e" name="email" required="@" value="<?php echo $email ?>" placeholder="Email" onload="javascript: validaemail(this.value)" onchange="javascript: validaemail(f1.email)">
    </div>
    <div class="cad-elem"><h4>Apelido</h4>
        <input type="text" class="caixa" name="apelido" placeholder="Apelido User" required  maxlength="13">
    </div>
    <div class="cad-elem"><h4>CPF</h4>
        <input type="text" class="caixa" name="cpf" id="cpf" placeholder="CPF" onblur="javascript: validarCPF(this.value);" onkeypress="javascript: mascara(this, cpf_mask);"  maxlength="14" required/>
    </div>
    <div class="cad-elem">
        <h4>Melhor horario para a consulta: </h4>
        <input type="radio" id="man" name="consulta" value="Manhã" required><label for="man"> Manhã</label>
        <input type="radio" id="tar" name="consulta" value="Tarde" required><label for="tar"> Tarde</label>
        <input type="radio" id="noi" name="consulta" value="Noite" required><label for="noi"> Noite</label>
    </div>
    <div class="cad-elem"><h4>(DDD)Telefone</h4>
        <input type="text" name="tel1" class="tel"  maxlength="10" size="13" onblur="mascara(this,mtel)" placeholder="Residencial" onfocus="mascara2(this,mtel2)">
    </div>
    <div class="cad-elem">
        <input type="text" name="tel2" class="tel"  maxlength="11" size="14" onblur="mascara(this,mtel)" placeholder="Celular" onfocus="mascara2(this,mtel2)">
    </div>
    <div class="cad-elem">
        
    </div>
    <div class="cad-elem"><h4>Endereço</h4>
    <?php
		echo "
        <select name='estado' id='estado' onchange='buscar_cidades()' onload='reset'>";      // Estado
            echo "<option>Selecione o Estado</option>";
            for( $este=0 ; $este < $linha ; $este++)
            {       $e=$uf[$este][0];
               echo "<option value='$e'>".$uf[$este][1]."</option><br>";
            }
         echo "</select>";	
?>
        <div id="load_cidades">     <!-- Cidades -->
            <select name="cidade" id="cidade" onclick='buscar_cidades()' required>
              <option>Selecione a Cidade</option>
            </select>
        </div>
    </div>
    <div class="cad-elem"><h4>Data de Nascimento</h4>
        <input type="text"  id="data" name="data" maxlength="10" size="12" min="<?php echo $certo ;?>" placeholder="dd-mm-aaaa" OnKeyPress="formatar('##/##/####', this)" onkeydown="javascript: return verificadata(this.event)" onblur="javascript: checaridade(this.value)" required>
    </div>
    <div class="cad-elem"><h4>Meio de Contato</h4>
        <label for="u">Usuario:</label>
        <input type="text" id="user" name="user" placeholder="Skype" required=""> 
    </div>
    <div class="cad-elem"><h4>Confirme sua senha</h4>
        <input type="password" id="chave" name="senha" class="caixa" required value="<?php echo $senha ?>" placeholder="Senha">
        <input type="password" id="chave2" name="s2" class="caixa"  placeholder="Confime a Senha" required oninput="validaSenha(this)">
    </div>
    <div class="cad-elem">
        <input type="checkbox" name="maior" id="mai" required>
        <label for="mai" required>Eu afirmo que li e concordo com os</label><br>
        <a href="termos-de-uso.php" target="_blank">Termos de uso</a>
    </div>
        <input type="submit" value="Cadastrar" id="envia">
</form>
</div>
</div>
    <?php include "design/rodape.php" ?>
</body>
</html>