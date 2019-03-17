<?php
    if (isset($_SESSION['objeto'])) 
    {
        @$l1 = unserialize($_SESSION['objeto']);
    }
?>
<nav class="menu">
    <div class="menu-full">
        <div class="full-titulo">
            <div class="titulo-menu1">Luciana França Cescon</div>
            <div class="titulo-menu2">Psicóloga - CRP 06/98202</div>
        </div>
        <div class="full-botoes">
<?php
if (isset($l1))
{
    if ($l1 instanceof Usuario) // Se quem estiver Logado for um Usuario 
    {
        if($l1->getAtivo()=='0')   // Se o usuario for desativado
        {
            header('location:deslogar.php');
        }
      echo '<div class="botao-full"><div class="botaoconta" onclick="contabox()">Conta ▼</div></div>';
        echo '<div class="conta-box-some">
          <div id="conta-box">
                <div class="img-user" style="background-image:url(_fotosperfil/'.$l1->getImagem().');border-bottom-right-radius: 1vh;border-top-right-radius: 1vh;"></div>
               <div class="cont-user">
               <div class="nome-user">'.$l1->getNome().'</div>
                  <a href="ver-dados.php" class="config-user">Config </a><br>
                  <a href="deslogar.php" class="config-user">Deslogar</a><br><br>
              </div>    
          </div>
            </div>';
    }
    if ($l1 instanceof Administrador) // Se quem estiver Logado for um Administrador
    {
      echo '<div class="botao-full"><div class="botaoconta" onclick="contabox()">Administrar ▼</div></div>';
        echo '<div class="conta-box-some">
    		  <div id="conta-box">
    		       <div class="cont-user">
    		       <div class="nome-user">'.$l1->getNome().'</div><br>';if ($menu!==123){echo '
    		          <a href="mensagens.php" class="config-adm">Mensagens</a><br>
                      <a href="criar-post.php" class="config-adm">Postar</a><br>
                      <a href="total-consultas.php" class="config-adm">Histórico</a><br>
                      <a href="ver-consultas.php" class="config-adm">Calendario</a><br>
                      <a href="#" class="config-adm">Atendimento</a><br>
                      <a href="usuarios.php" class="config-adm">Usuarios</a><br>';};echo '
                      <a href="deslogar.php" class="config-adm">Deslogar</a><br>
    		      </div>    
    		  </div>
    	      </div>';
    }
}
else // Senão estiver Logado
{
	echo '<div class="botao-full-log"><div id="botao-login" onclick="loginbox()">Login ▼</div></div>';
	echo '<form id="login-box" method="POST" action="usuario_adm.php">
    		<p class="p-log">
   		     	<input type="text" class="input-log" name="email" required="@" placeholder="E-mail">
 		</p>
    		<p class="p-log">
        			<input type="password" class="input-log" name="senha" id="pass" required="" placeholder="Senha">
    		</p>
    		<p class="p-log-p">
        			<input class="botao-log" id="entrar" type="submit" value="Entrar">
   		</p>
    		<p class="p-log-p">
        			<a href="cadastro-hub.php" class="botaol">Cadastre&ndash;se</a>
   		</p>
            <p class="p-log-p" style="text-align:center;"><a href="muda_senha.php" style="text-decoration:none;color:black;">Esqueci minha senha</a></p>
	          </form>';
}
?>
            <div class="botao-full">
            <?php
            if (isset($l1))
            {
                if ($l1 instanceof Administrador)
                {
                    echo '</div>';
                }
                else
                {
                    echo '<a href="contato.php" class="';if($menu==4){ echo 'botao-atual';}else{ echo 'botao-link';} echo '">Contato</a></div>';
                }
            }
            else
            {
                echo '<a href="contato.php" class="';if($menu==4){ echo 'botao-atual';}else{ echo 'botao-link';} echo '">Contato</a></div>';
            }?>
            <?php
            if (isset($l1))
            {
                if ($l1 instanceof Administrador)
                {}
                else
                {
                    echo '<div class="botao-full"><a href="sobre.php" class="';
                    if($menu==3){echo 'botao-atual';}
                    else{echo 'botao-link';};
                    echo '">Sobre</a></div>';
                }
            }else{
                echo '<div class="botao-full"><a href="sobre.php" class="';
                    if($menu==3){echo 'botao-atual';}
                    else{echo 'botao-link';};
                    echo '">Sobre</a></div>';
            };
            ?>
            <div class="botao-full"><a href="blog.php" class="<?php if($menu==2){echo 'botao-atual';}else{echo 'botao-link';} ; ?>">Blog</a></div>
            <div class="botao-full"><a href="index.php" class="<?php if($menu==1 || $menu==123){echo 'botao-atual';}else{echo 'botao-link';} ; ?>">Inicio</a></div>
        </div>
    </div>
</nav>