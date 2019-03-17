<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
	<title>Dados</title>
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
    </script>
    
<?php
session_start();
require_once ('classes/usuario.class.php');
require_once ('classes/administrador.class.php');
require_once ('classes/estado.class.php');
    $e1 = new Estado();
    $linha=count($e1->estados());
    $uf=$e1->estados();
?>
</head>
<body>
<div class="bugfix-menu">
        <?php include "design/menu-half.php"; ?>
        <?php $menu=999; include "design/menu-full.php"; ?>
</div>
<div class="top-img">
    <div>Editar Dados</div>
</div>
<form action="editar-dados2.php" name="edita" method="POST" enctype="multipart/form-data">
<?php $_SESSION['objeto'] = serialize($l1); ?>
    <div class="conteudo1">
        <div class="box-usuario">
            <div style="200px;float:left;">
            <img src="_fotosperfil/<?php echo $l1->getImagem() ;?>"/>
            </div>
            <div class="box-total">
            <div class="box-dados">
                <span>Nome</span><br>
                <input type="text" class="caixa" id="n" name="nome" placeholder="Nome Completo" value="<?php echo $l1->getNome() ;?>">
            </div>
            <div class="box-dados">
                <span>Apelido</span><br>
                <input type="text" class="caixa" name="apelido" value="<?php echo $l1->getApelido() ;?>" maxlength="13">
            </div>
            <div class="box-dados">
                <span>Periodo de Consulta</span><br>
                <input type="radio" id="man" name="consulta" value="Manhã" <?php if($l1->getPeriodo() == 'Manhã'){ echo 'checked';} ?>><label for="man"> Manhã</label>
            <input type="radio" id="tar" name="consulta" value="Tarde" <?php if($l1->getPeriodo() == 'Tarde'){ echo 'checked';} ?>><label for="tar"> Tarde</label>
            <input type="radio" id="noi" name="consulta" value="Noite" <?php if($l1->getPeriodo() == 'Noite'){ echo 'checked';} ?>><label for="noi"> Noite</label>
            </div>
            <div class="box-dados">
                <span>Telefone</span><br>
                <input type="text" class="caixa" name="tel1" value="<?php if($l1->getDDD1() != null &&$l1->getResidencial() != null){echo "(".$l1->getDDD1().")".$l1->getResidencial();}?>" maxlength="14" placeholder="Residencial" onchange="mascara(this,mtel)"><br>
                <input type="text" name="tel2" class="tel"  maxlength="15" onchange="mascara(this,mtel)" placeholder="Celular" style="width:40vh;" value="<?php if($l1->getDDD2() != null &&$l1->getCel() != null){echo '('.$l1->getDDD2().')'.$l1->getCel();}?>" />
            </div>
            <div class="box-dados">
                <span>Endereço</span><br>
                <?php
                    echo "
                        <select name='estado' id='estado' onchange='buscar_cidades()'>";      // Estado
                            echo "<option>Selecione o Estado</option>";
                            for( $este=0 ; $este < $linha ; $este++)
                            {       $e=$uf[$este][0];
                               echo "<option value='$e'>".$uf[$este][1]."</option><br>";
                            }
                         echo "</select>";	
                ?>
            <div id="load_cidades">     <!-- Cidades -->
                <select name="cidade" id="cidade">
                  <option value='N'>Selecione a Cidade</option>
                </select>
            </div>
            </div>
            <div class="box-dados">
                <span>Meio de Contato</span><br>
                <input type="text" id="user" name="user" placeholder="Skype"value="<?php echo $l1->getUser();?>">
            </div>
            <div class="box-dados">
                <span>Nova Foto de Perfil:</span><br>
                <input type="file" name="upload" value="Imagens" class="botaoimagem">
            </div>
            </div>
            <div class="box-total">
            <div class="pack-botoes">
            <input class="publicado" style="width:40vh;text-align:center;" type="submit" value="Salvar Alterações">
                <a href="javascript:history.go(-1)" style='text-decoration:none; color:black;'><div class="publicado" style="width:38vh;text-align:center;background-color: #ff4141;border-bottom-color: #b71d1d;">Cancelar Alterações</div></a>
            </div>
            </div>
            <div class="box-fantasma">.......</div>
        </div>
    </div>
</form>
<?php include "design/rodape.php" ?>    