<?php
    if (isset($_SESSION['objeto'])) 
    {
        @$l1 = unserialize($_SESSION['objeto']);
    }
?>
<div class="menu-half">
    <nav id="botao-slide" onclick="menuhalf()">
        <div></div>
        <div></div>
        <div></div>
    </nav>
    <div class="titulo">
        <?php //<div class="logomenu1"></div> ?>
        <div class="titulo-half">
            <div class="titulo1">Luciana França Cescon</div>
            <div class="titulo2">Psicóloga - CRP 06/98202</div>
        </div>
    </div>
</div>
<section id="menu-slide" class="menu-slide">
<?php 
if (isset($l1))
{
            if ($l1 instanceof Usuario) // Se quem estiver Logado for um Usuario
            {
                if($l1->getAtivo()=='0')   // Se o usuario for desativado
                {
                    header('location:deslogar.php');
                }
                echo'<div class="img-user" style="background-image:url(_fotosperfil/'.$l1->getImagem().');border-bottom-right-radius: 1vh;border-top-right-radius: 1vh;margin:0;"></div>
                <div class="cont-user-half">
                    <div class="nome-user">'.$l1->getNome().'</div>
                    <div class="config-user">Config</div>
                </div>';
            }
    elseif ($l1 instanceof Administrador) // Se quem estiver Logado for um Administrador (N TEM DIFERENÇA POR ENQUANTO)
    {
         echo'<div class="img-user-half" style="background-image:url('.$l1->getImagem().');border-bottom-right-radius: 1vh;border-top-right-radius: 1vh;margin:0;"></div>
        <div class="cont-user-half">
            <div class="nome-user">'.$l1->getNome().'</div>
            <div class="config-user">Config</div>
        </div>';
    }
}
?>
    <p class="link-slide"><a href="index.php">Inicio</a></p>
    <p class="link-slide"><a href="blog.php">Blog</a></p>
    <p class="link-slide"><a href="sobre.php">Sobre</a></p>
    <p class="link-slide"><a href="contato.php">Contato</a></p>
<?php
if (!isset($l1))
{
    echo '<p class="link-slide"><a href="cadastro-hub.php">Conta</a></p>';
}
elseif ($l1 instanceof Administrador) 
{
    echo '<p class="link-slide"><a href="mensagens.php">Mensagens</a></p>
             <p class="link-slide"><a href="criar-post.php">Postar</a></p>
             <p class="link-slide"><a href="usuarios.php">Usuarios</a></p>
             <p class="link-slide"><a href="#">Solicitação</a></p>
             <p class="link-slide"><a href="#">Atendimento</a></p>';
}
?>
</section>