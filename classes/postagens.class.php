<?php
require_once('conexao.class.php');
date_default_timezone_set('America/Sao_Paulo');
$arq = "postagens.class.php";#nome do arquivo. Isso evita um acesso direto pela URL.
if (strcmp(basename($_SERVER['PHP_SELF']), basename($arq)) === 0)
{
	header('location:../index.php');
}

Class Postagens extends Conexao
{
	// Atributos
		private $codigopostagens;
		private $nomepostagens;
		private $descricaopostagens;
		private $horapostagens;
		private $datapostagens;
	//

	// Metodos
		public function criarPostagem($titulo,$subtitulo,$post,$imagem,$codigo)
		{
			$sql = "SELECT * FROM tb_admin WHERE cd_admin = :codigo";
				$verifica= Conexao::conectar()->prepare($sql);
				$verifica->bindValue(':codigo',$codigo);
				$verifica->execute();
				$row = $verifica->rowCount();
			if ($row == 0)
			{
				return "<script>Não é possivel postar, não é administrador</script>";
			}
			else
			{
				list($width, $height) = getimagesize($imagem["arqTemp"]); // Mudando a Resolução da Imagem
				$image_p = imagecreatetruecolor(1440, 544);
				switch($imagem["arqType"])
				{
					case 'image/gif':
						$image = imagecreatefromgif($imagem["arqTemp"]);
						$tipo=".gif";
					break;
					case 'image/jpeg':
						$image = imagecreatefromjpeg($imagem["arqTemp"]);
						$tipo=".jpg";
					break;
					case 'image/png':
						$image = imagecreatefrompng($imagem["arqTemp"]);
						$tipo=".png";
					break;
					default:
				       		return false;
				}
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, 1440, 544, $width, $height);
				$pasta = "post-img/";
				$nomeimg=rand(10000000000,99999999999).$tipo;
				switch($imagem["arqType"]) // Aqui ele insere na pasta
				{
					case 'image/gif':
						imagegif($image_p, $pasta.$nomeimg);
					break;
					case 'image/jpeg':
						imagejpeg($image_p, $pasta.$nomeimg);
					break;
					case 'image/png':
						imagepng($image_p, $pasta.$nomeimg);
					break;
					default:
				       		return false;
				}
				$sql2 = "INSERT INTO tb_posts (nm_titulo,nm_subtitulo,ds_post,ds_imagem,hr_post,dt_post,cd_admin) VALUES (:titulo,:subtitulo,:descricao,:imagem,:hora,:data,:codigo)";
					$postagem= Conexao::conectar()->prepare($sql2);
					$postagem->bindValue(':titulo',$titulo);
					$postagem->bindValue(':subtitulo',$subtitulo);
					$postagem->bindValue(':descricao',$post);
					$postagem->bindValue(':imagem',$nomeimg);
					$postagem->bindValue(':hora',$hora=date('H:i:s'));
					$postagem->bindValue(':data',$date=date('Y-m-d'));
					$postagem->bindValue(':codigo',$codigo);
					$postagem->execute();
					
			}
		}
		public function feedPostagens($pag) 
		{
		            if(!isset($pag)){
						$pag = 1;
					}
					$post = 5;
					$inicio = ($pag*$post)-$post;
					$sql="SELECT nm_admin, nm_titulo, nm_subtitulo,ds_post, dt_post, tb_posts.ds_imagem, cd_post FROM tb_posts INNER JOIN tb_admin ON tb_posts.cd_admin = tb_admin.cd_admin order by cd_post desc LIMIT :inicio,:post";
						$postagem= Conexao::conectar()->prepare($sql);
		                			$postagem->bindValue(":inicio",$inicio,PDO::PARAM_INT);
		               			$postagem->bindValue(":post",$post,PDO::PARAM_INT);
						$postagem->execute();
						$posts = $postagem->fetchAll(PDO::FETCH_BOTH);
						$row = count($postagem);
						if ($row == 0) 
						{
							return false;
						}
						else
						{
							return $posts;
						}
		}
        public function paginacaoBlog($pag)
        {
            	if(!isset($pag)){
						$pag = 1;
					}
		       	 $post = 5;
			try{
				$pager = Conexao::conectar()->prepare("SELECT * FROM tb_posts INNER JOIN tb_admin ON tb_posts.cd_admin = tb_admin.cd_admin order by cd_post desc");                
				$pager->execute();
				$count = $pager->rowCount();
				$count = ceil($count/$post);
			}catch(PDOException $e){
				$e->getMessage();
			}
			if($pag>=1 && $pag<5){
				for($i=1;$i<=$count;$i++){
				if($i == 6){
		            echo". . . <a href='?pag=$count' class='paginacao'>$count</a>";
					$i = $count;
				}else{
					if($pag == $i){
					echo"<span class='paginacao' style='background-color:#5c5ceb;border-bottom-color:darkblue;'>$i</span> ";
				}else{
					echo"<a href='?pag=$i' class='paginacao'>$i</a> ";
				}
				}
			}

				}elseif($pag >= 5 && $pag<($count - 4)){
				echo"<a href='?pag=1' class='paginacao'>1</a> . . . ";
				$ant = $pag - 2;
				$dep = $pag + 2;
				for($i=$ant;$i<=$dep;$i++){
					if($pag == $i){
						echo"<span class='paginacao' style='background-color:#5c5ceb;border-bottom-color:darkblue;'>$i</span> ";
					}else{
						echo"<a href='?pag=$i' class='paginacao'>$i</a> ";
					}
				}echo". . . <a href='?pag=$count' class='paginacao'>$count</a>";
			}elseif($pag>=($count-5)){
				if(($count - 5)<=1){
					$ant = $count - 4;
				}else{
				echo"<a href='?pag=1' class='paginacao'>1</a> . . . ";
				$ant = $count - 5;
			}
				for($i=$ant;$i<=$count;$i++){
					if($pag == $i){
						echo"<span class='paginacao' style='background-color:#5c5ceb;border-bottom-color:darkblue;'>$i</span> ";
					}else{
						echo"<a href='?pag=$i' class='paginacao'>$i</a> ";
					}
				}
			}        
        }
		public function relevancia() 	// Precisa arrumar de acordo com o banco. 27/09
		{
			$sql = "SELECT tb_posts.cd_post, nm_titulo, ds_imagem, count(*) as 'Visualizações' FROM tb_visualizacao INNER JOIN tb_posts ON tb_posts.cd_post = tb_visualizacao.cd_post GROUP BY cd_post ORDER BY count(*) desc LIMIT 3";
				$relevancia= Conexao::conectar()->prepare($sql);
				$relevancia->execute();
				$relevante = $relevancia->fetchAll(PDO::FETCH_BOTH);
				$row = count($relevante);
				if ($row < 3) 
				{
					$sql="SELECT cd_post, nm_titulo, ds_imagem FROM tb_posts order by cd_post desc LIMIT 3";
					$postagem= Conexao::conectar()->prepare($sql);
					$postagem->execute();
					$posts = $postagem->fetchAll(PDO::FETCH_BOTH);
					$row2=count($posts);
					if ($row2 == 0) 
					{
						return false;
					}
					else
					{
						return $posts;
					}
				}
				else
				{
	        				return $relevante;
				}
		}
		public function verPostagem($codigop)
		{
			$sql="SELECT nm_admin, nm_titulo, nm_subtitulo,ds_post, dt_post, tb_posts.ds_imagem, cd_post FROM tb_posts INNER JOIN tb_admin ON tb_posts.cd_admin = tb_admin.cd_admin WHERE cd_post = :cdpost";
				$postagem= Conexao::conectar()->prepare($sql);
				$postagem->bindValue(':cdpost',$codigop);
				$postagem->execute();
				$post = $postagem->fetchAll(PDO::FETCH_BOTH);
			return $post;
		}
		public function visualicacoes($codigoP,$codigoU)  // BUGADO
		{
			$viu="SELECT * FROM tb_visualizacao WHERE cd_usuario = :cdusuario AND cd_post = :cdpost"; // Aqui vai ver se a pessoa ja viu esse post
			        	$visualizado= Conexao::conectar()->prepare($viu);
				$visualizado->bindValue(':cdpost',$codigoP);
				$visualizado->bindValue(':cdusuario',$codigoU);
				$visualizado->execute();
				$visu = $visualizado->fetchAll(PDO::FETCH_BOTH);
				$row = count($visu);
				if ($row != 0) 
				{
					return false;	
				}
				else
				{
					$new="INSERT INTO tb_visualizacao (cd_usuario, cd_post) VALUES (:cdusuario, :cdpost)";
						$visualiza= Conexao::conectar()->prepare($new);
						$visualiza->bindValue(':cdpost',$codigoP);
						$visualiza->bindValue(':cdusuario',$codigoU);
						$visualiza->execute();
						return true;
				}
		}
		public function comentar($cp,$cu,$com)
		{
			$new="INSERT INTO tb_comentario (ds_comentario,dt_comentario,cd_usuario,cd_post) VALUES (:comen,sysdate(),:cu, :cp)";
						$comentario= Conexao::conectar()->prepare($new);
						$comentario->bindValue(':cp',$cp);
						$comentario->bindValue(':cu',$cu);
						$comentario->bindValue(':comen',$com);
						$comentario->execute();
				return true;
		}
		public function comentarios($c)
		{
			$sql="SELECT ds_comentario, dt_comentario, nm_usuario, tb_usuario.ds_imagem as imagem FROM tb_posts RIGHT OUTER JOIN tb_comentario ON tb_posts.cd_post = tb_comentario.cd_post LEFT OUTER JOIN tb_usuario ON tb_comentario.cd_usuario = tb_usuario.cd_usuario WHERE tb_comentario.cd_post = $c";
				$comentario= Conexao::conectar()->prepare($sql);
				$comentario->bindValue(':cod',$c);
				$comentario->execute();
				$comentarios = $comentario->fetchAll(PDO::FETCH_BOTH);
			return $comentarios;

		}

		public function deletar($codigopostagem)
		{
			$sql2="SELECT ds_imagem FROM tb_posts WHERE cd_post = :codigo";
				$imag= Conexao::conectar()->prepare($sql2);
				$imag->bindValue(':codigo',$codigopostagem);
				$imag->execute();
				$img = $imag->fetchAll(PDO::FETCH_BOTH);
				$im=$img[0][0];
				unlink("post-img/$im");
			$sql = "DELETE FROM tb_posts WHERE cd_post = :codigo";
				$delete= Conexao::conectar()->prepare($sql);
				$delete->bindValue(':codigo',$codigopostagem);
				$delete->execute();
		}
	//
}
?>
