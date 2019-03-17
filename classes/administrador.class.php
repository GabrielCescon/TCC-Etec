<?php
require_once('conexao.class.php');
date_default_timezone_set('America/Sao_Paulo');
$arq = "administrador.class.php";#nome do arquivo. Isso evita um acesso direto pela URL.
if (strcmp(basename($_SERVER['PHP_SELF']), basename($arq)) === 0)
{
    header('location:../index.php');
}

Class Administrador extends Conexao
{
	// Atributo
		private $codigoadministrador;
		public $nomeadministrador; // Publico = pode ser mexido fora da classe.
		private $emailadministrador;
		private $senhaadministrador;
		public $imagemadministrador;
	//

	// Metodos
		public function logar($e,$s)
		{
			try
			{
				$s= sha1($s);
				$sql2 = "SELECT * FROM tb_admin WHERE nm_email = :email AND nm_senha = :senha"; 
				$pessoa = Conexao::conectar()->prepare($sql2); // Aqui prepara para executar o $sql com a conexao estabelecida.
				$pessoa->bindValue(':email',$e); // Aqui é inserido em :email o $email.
				$pessoa->bindValue(':senha',$s); // Aqui é inserido em :email a $senha.
				$pessoa->execute(); // Aqui executa a linha de codigo do prepare
				$usuario = $pessoa->fetch(PDO::FETCH_BOTH); // Aqui é pego uma Array com os dados do usuario (caso haja).
				$row = $pessoa->rowCount();
				if ($row == 0)
				{
					return false;
				}
					session_start();
						$this->codigoadministrador =$usuario[0]; // Codigo do usuário.
						$this->nomeadministrador =$usuario[1]; // Nome do usuário.
						$this->emailadministrador =$usuario[2]; // Email do usuário.
						$this->senhaadministrador =$usuario[3]; // Senha do usuário.
						$this->imagemadministrador ='_fotosperfil/'.$usuario[4]; // Imagem de perfil do usuário.
					return true;
			}
			catch(Exception $ex)
			{
				return false;
			}
		}
		public function deslogar()   // Serve pra finalizar a sessão.
		{
			try
			{
				session_destroy();
				header('location:index.php');
			}
			catch (Exception $ex)
			{
				return false;
			}
		}
		public function atualizarNome($novo) // set = Método que modifica caracteristicas da classe.
		{
			$sql = "UPDATE tb_admin SET nm_nome = :novo WHERE nm_email = :email AND nm_senha = :senha"; 
			$atualizar = Conexao::conectar()->prepare($sql);
			$atualizar->bindValue(':novo',$novo);
			$atualizar->bindValue(':email',$this->getEmail());
			$atualizar->bindValue(':senha',$this->getSenha());
			$atualizar->execute();
		}
		public function atualizarSenha($novo,$email,$cpf)
		{
            $verifica = Conexao::conectar()->prepare("SELECT * FROM tb_admin WHERE nm_email = :email AND cd_cpf = :cpf");
            $verifica->bindValue(':email',$email);
            $verifica->bindValue(':cpf',$cpf);
            $verifica->execute();
            $row = $verifica->rowCount();
            if($row == 1){
			$novo = sha1($novo);
			$sql = "UPDATE tb_admin SET nm_senha = :novo WHERE nm_email = :email AND cd_cpf = :cpf"; 
			$atualizar = Conexao::conectar()->prepare($sql);
			$atualizar->bindValue(':novo',$novo);
			$atualizar->bindValue(':email',$email);
			$atualizar->bindValue(':cpf',$cpf);
			$atualizar->execute();
                return true;
            }else{
                return false;
            }
		}
		public function atualizarImagem($novo)
		{
			$sql = "UPDATE tb_admin SET ds_imagem = :novo WHERE nm_email = :email AND nm_senha = :senha"; 
			$atualizar = Conexao::conectar()->prepare($sql);
			$atualizar->bindValue(':novo',$novo);
			$atualizar->bindValue(':email',$this->getEmail());
			$atualizar->bindValue(':senha',$this->getSenha());
			$atualizar->execute();
		}
		public function pegarUsuario($codigo)
		{
			$sql = "SELECT * FROM tb_usuario LEFT OUTER JOIN tb_contato ON tb_usuario.cd_usuario = tb_contato.cd_usuario WHERE tb_usuario.cd_usuario = :codigo"; 
				$pessoa = Conexao::conectar()->prepare($sql);
				$pessoa->bindValue(':codigo',$codigo);
				$pessoa->execute(); 
				$usuario = $pessoa->fetch(PDO::FETCH_BOTH);
			return $usuario;
		}
		public function deletarUsuario($codigo)
	            {
	                    $deletar = Conexao::conectar()->prepare("UPDATE tb_usuario SET ic_ativo = '0' WHERE cd_usuario = :codigo");
	                    $deletar->bindValue(':codigo',$codigo);
	                    $deletar->execute();
	                        return true;      
	            }
                public function ativarUsuario($codigo){
                    $deletar = Conexao::conectar()->prepare("UPDATE tb_usuario SET ic_ativo = '1' WHERE cd_usuario = :codigo");
                    $deletar->bindValue(':codigo',$codigo);
                    $deletar->execute();
                      return true;
                }
	            public function atualizarDescricao($novo,$codigo)
	            {
	                $sql = "UPDATE tb_usuario SET ds_usuario = :novo WHERE cd_usuario = :codigo"; 
	                    $atualizar = Conexao::conectar()->prepare($sql);
	                    $atualizar->bindValue(':novo',$novo);
	                    $atualizar->bindValue(':codigo',$codigo);
	                    $atualizar->execute();
	            }
		public function procuraUser($proc,$pag){
			if(!isset($pag)){
				$pag = 1;
			}
			$post = 10;
			$inicio = ($pag*$post)-$post;
			try{
				$procura = Conexao::conectar()->prepare("SELECT * FROM tb_usuario WHERE nm_usuario LIKE '$proc%' ORDER BY nm_usuario LIMIT :inicio,:post");
				$procura->bindValue(":inicio",$inicio,PDO::PARAM_INT);
				$procura->bindValue(":post",$post,PDO::PARAM_INT);
				$procura->execute();
				return $procura;
			}catch(PDOException $e){
				$e->getMessage();
			}
		}
		    public function paginacao($chave,$pag){
		        if(!isset($pag)){
						$pag = 1;
					}
		        $post = 10;
			try{
				$pager = Conexao::conectar()->prepare("SELECT * FROM tb_usuario  WHERE nm_usuario LIKE '$chave%' ORDER BY nm_usuario");
				$pager->execute();
				$count = $pager->rowCount();
				$count = ceil($count/$post);
			}catch(PDOException $e){
				$e->getMessage();
			}
			if($pag>=1 && $pag<5){
				for($i=1;$i<=$count;$i++){
				if($i == 6){
		            echo". . . <a href='?titulopost=$chave&pag=$count' class='paginacao'>$count</a>";
					$i = $count;
				}else{
					if($pag == $i){
					echo"<span class='paginacao' style='background-color:blue;border-bottom-color:darkblue;'>$i</span> ";
				}else{
					echo"<a href='?titulopost=$chave&pag=$i' class='paginacao'>$i</a> ";
				}
				}
			}

				}elseif($pag >= 5 && $pag<($count - 4)){
				echo"<a href='?titulopost=$chave&pag=1' class='paginacao'>1</a> . . . ";
				$ant = $pag - 2;
				$dep = $pag + 2;
				for($i=$ant;$i<=$dep;$i++){
					if($pag == $i){
						echo"<span class='paginacao' style='background-color:blue;border-bottom-color:darkblue;'>$i</span> ";
					}else{
						echo"<a href='?titulopost=$chave&pag=$i' class='paginacao'>$i</a> ";
					}
				}echo". . . <a href='?titulopost=$chave&pag=$count' class='paginacao'>$count</a>";
			}elseif($pag>=($count-5)){
				if(($count - 5)<=1){
					$ant = $count - 4;
				}else{
				echo"<a href='?titulopost=$chave&pag=1' class='paginacao'>1</a> . . . ";
				$ant = $count - 5;
			}
				for($i=$ant;$i<=$count;$i++){
					if($pag == $i){
						echo"<span class='paginacao' style='background-color:blue;border-bottom-color:darkblue;'>$i</span> ";
					}else{
						echo"<a href='?titulopost=$chave&pag=$i' class='paginacao'>$i</a> ";
					}
				}
			}
		    }
public function validaCPF($cpf = null) {
 
    // Verifica se um número foi informado
    if(empty($cpf)) {
        return false;
    }
 
    // Elimina possivel mascara
    @$cpf = ereg_replace('[^0-9]', '', $cpf);
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
     
    // Verifica se o numero de digitos informados é igual a 11 
    if (strlen($cpf) != 11) {
        return false;
    }
    // Verifica se nenhuma das sequências invalidas abaixo 
    // foi digitada. Caso afirmativo, retorna falso
    else if ($cpf == '00000000000' || 
        $cpf == '11111111111' || 
        $cpf == '22222222222' || 
        $cpf == '33333333333' || 
        $cpf == '44444444444' || 
        $cpf == '55555555555' || 
        $cpf == '66666666666' || 
        $cpf == '77777777777' || 
        $cpf == '88888888888' || 
        $cpf == '99999999999') {
        return false;
     // Calcula os digitos verificadores para verificar se o
     // CPF é válido
     } else {   
         
        for ($t = 9; $t < 11; $t++) {
             
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }
 
        return true;
    }
}
    #----------------------------Consultas---------------------------------------------------
    public function verConsulta($pag){
        if(!isset($pag)){
            $pag = 1;
        }
    $post = 10;
    $inicio = ($pag*$post)-$post;
        try{
            $mostra = Conexao::conectar()->prepare("select * from tb_usuario inner join tb_consulta on tb_usuario.cd_usuario = tb_consulta.cd_usuario where hr_fim_consulta > sysdate() order by hr_inicio_consulta desc LIMIT :inicio,:post");
            $mostra->bindValue(":inicio",$inicio,PDO::PARAM_INT);
            $mostra->bindValue(":post",$post,PDO::PARAM_INT);
            $mostra->execute();
            return $mostra;            
        }catch(PDOException $e){
				$e->getMessage();
			}
    }
    
    public function paginacaoConsulta($pag){
            if(!isset($pag)){
						$pag = 1;
					}
		        $post = 10;
			try{
				$pager = Conexao::conectar()->prepare("select * from tb_usuario inner join tb_consulta on tb_usuario.cd_usuario = tb_consulta.cd_usuario where hr_fim_consulta > sysdate() order by cd_consulta desc");                
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
    public function verQuando($data){
        try{
            $form = new DateTime($data);
            $dia = $form->format("d/m/Y");
            $hora = $form->format("H:i");
            $resp = "$hora - $dia";
            return $resp;
            #"Y-m-d H:i:s"
        }catch(PDOException $erro){            
            die("erro: <code>".$resp->getMessage()."</code>");            
            return false;
        } 
    }
    
    public function verQuando2($data,$data2){
        try{
            $form = new DateTime($data);
            $form2 = new Datetime($data2);
            $dia = $form->format("d/m/Y");
            $hora = $form->format("H:i");
            $fim = $form2->format("H:i");
            $resp = "$hora as $fim - $dia";
            return $resp;
            #"Y-m-d H:i:s"
        }catch(PDOException $erro){            
            die("erro: <code>".$resp->getMessage()."</code>");            
            return false;
        } 
    }
    
    public function orientaData($data){
        try{
            $form = new DateTime($data);
            $dia = $form->format("d/m/Y");
            $hora = $form->format("H")+2;
            $min = $form->format("i");
            $resp = "$hora:$min - $dia";
            return $resp;
            #"Y-m-d H:i:s"
        }catch(PDOException $erro){            
            die("erro: <code>".$resp->getMessage()."</code>");            
            return false;
        } 
    }
    
    public function verificaData($data){
        try{
        $form = new DateTime($data);
        $inicio = $form->format("Y-m-d H:i:s");
        $atual = date("Y-m-d H:i:s");
        $atual = strtotime($atual);
        $consu = strtotime($inicio);
        $dia = $form->format("Y-m-d");
        $hora = $form->format("H") + 2;
        $min = $form->format("i:s");
        $fim = "$dia $hora:$min";
        $ver = Conexao::conectar()->prepare("SELECT * from tb_consulta where hr_inicio_consulta between :inicio AND :fim or hr_fim_consulta between :inicio AND :fim ");
        $ver->bindValue(":inicio",$inicio);
        $ver->bindValue(":fim",$fim);
        $ver->execute();
            $row = $ver->rowCount();
            if($row >=1||$consu < $atual){
                return false;
            }else{
                return true;
            }
            
        }catch(PDOException $erro){            
            die("erro: <code>".$resp->getMessage()."</code>");            
            return false;
        }
    }
    
    public function diferencaDias($final){
	$data_inicial = date("Y-m-d");
    $classe = new Datetime($final);
    $time_final = $classe->format("Y-m-d");
	$time_inicial = strtotime($data_inicial);
	$time_final = strtotime($time_final);
	$diferenca = $time_final - $time_inicial;
	$dias = (int)floor( $diferenca / (60 * 60 * 24));
	return $dias;
}
    
    public function formatoHora($data){
        $form = new DateTime($data);
        $inicio = $form->format("Y-m-d H:i:s");
            $dia = $form->format("Y-m-d");
            $hora = $form->format("H") + 2;
            $min = $form->format("i:s");
            $fim = "$dia $hora:$min";
        return $fim;
    }
 /*dias atraz é negativo, dias a frente é positivo
 #data e hora atual.
 #diferença de dias em relação ao começo.
 #timestamp do momento atual.
 #timestamp do inicio da consulta.
 #timestamp do fim da consulta com uma margim de 2 horas a mais de tolerancia.
 #timestamp do fim da consulta com a margim de 2 horas.
 #se a diferença de idas for menor ou igual a zero e timestamp atual for menor que o inicio
 #diferença de dias for igual a zero,time atual maior ou igual a horario inicial e menor que o horario de final 
 #dia ser maior ou igual que zero, time atual ser maior que o time do fim e a obs ser nula ou não existem
 #dia ser maior ou igual que zero, time atual ser maior que o time do fim e a obs existir 
*/
    
    public function estadoConsulta($inicio,$fim,$obs){
        $date1 = new Datetime($inicio);
        $com = $date1->format("Y-m-d H:i:s");
        $date2 = new Datetime($fim);
        $final = $date2->format("Y-m-d H:i:s");
        $atual = date("Y-m-d H:i:s");
        $com = strtotime($com);
        $atual = strtotime($atual);
        $final = strtotime($final);
        if($atual < $com && $obs == null){
            return "ant";
        }elseif($atual >= $com && $atual < $final && $obs == null){
            return "mom";
        }elseif($atual >= $com && $atual < $final && $obs != null){
            return "feito";
        }elseif($atual > $final && $obs == null){
            return "can";
        }elseif($atual > $final && $obs != null){
            return "feito";
        } 
    }
    
    public function marcaConsulta($data,$cod){
        try{
            if($this->verificaData($data)==true){
                $form = new DateTime($data);
                $inicio = $form->format("Y-m-d H:i:s");
                $dia = $form->format("Y-m-d");
                $hora = $form->format("H") + 1;
                $min = $form->format("i:s");
                $fim = "$dia $hora:$min";
                $marca = Conexao::conectar()->prepare("INSERT INTO tb_consulta(ds_obs,hr_inicio_consulta,hr_fim_consulta,cd_usuario) VALUES(null,:inicio,:fim,:user)");
                $marca->bindValue(":inicio",$inicio);
                $marca->bindValue(":fim",$fim);
                $marca->bindValue(":user",$cod);
                $marca->execute();
                return true;
            }else{
                return false;
            }            
        }catch(PDOException $erro){            
            die("erro: <code>".$resp->getMessage()."</code>");            
            return false;
        }
    }
    
    
    public function obsConsulta($obs,$cod){
        try{
            $mens = Conexao::conectar()->prepare("UPDATE tb_consulta SET ds_obs = :obs WHERE cd_usuario = :cod");
            $mens->bindValue(":obs",$obs);
            $mens->bindValue(":cod",$cod);
            $mens->$execute();
            return true;
        }catch(PDOException $erro){            
            die("erro: <code>".$resp->getMessage()."</code>");            
            return false;
        }
    }
    
    public function consultaUser($proc,$pag){
			if(!isset($pag)){
				$pag = 1;
			}
			$post = 10;
			$inicio = ($pag*$post)-$post;
			try{
                if(isset($proc)&& $proc!=""){
				$procura = Conexao::conectar()->prepare("select * from tb_usuario right outer join tb_consulta on tb_usuario.cd_usuario = tb_consulta.cd_usuario WHERE nm_usuario LIKE '$proc%' ORDER BY cd_consulta LIMIT :inicio,:post");
                }else{
                $procura = Conexao::conectar()->prepare("select * from tb_usuario right outer join tb_consulta on tb_usuario.cd_usuario = tb_consulta.cd_usuario ORDER BY cd_consulta LIMIT :inicio,:post"); 
                }
				$procura->bindValue(":inicio",$inicio,PDO::PARAM_INT);
				$procura->bindValue(":post",$post,PDO::PARAM_INT);
				$procura->execute();
				return $procura;
			}catch(PDOException $e){
				$e->getMessage();
			}
		}
    
     public function consultasFullPag($chave,$pag){
		        if(!isset($pag)){
						$pag = 1;
					}
		        $post = 10;
			try{
                if(isset($proc)&& $proc!=""){
				$pager = Conexao::conectar()->prepare("select * from tb_usuario right outer join tb_consulta on tb_usuario.cd_usuario = tb_consulta.cd_usuario WHERE nm_usuario LIKE '$chave%' ORDER BY cd_consulta");
                }else{
                $pager = Conexao::conectar()->prepare("select * from tb_usuario right outer join tb_consulta on tb_usuario.cd_usuario = tb_consulta.cd_usuario ORDER BY cd_consulta");
                }
				$pager->execute();
				$count = $pager->rowCount();
				$count = ceil($count/$post);
			}catch(PDOException $e){
				$e->getMessage();
			}
			if($pag>=1 && $pag<5){
				for($i=1;$i<=$count;$i++){
				if($i == 6){
		            echo". . . <a href='?titulopost=$chave&pag=$count' class='paginacao'>$count</a>";
					$i = $count;
				}else{
					if($pag == $i){
					echo"<span class='paginacao' style='background-color:blue;border-bottom-color:darkblue;'>$i</span> ";
				}else{
					echo"<a href='?titulopost=$chave&pag=$i' class='paginacao'>$i</a> ";
				}
				}
			}

				}elseif($pag >= 5 && $pag<($count - 4)){
				echo"<a href='?titulopost=$chave&pag=1' class='paginacao'>1</a> . . . ";
				$ant = $pag - 2;
				$dep = $pag + 2;
				for($i=$ant;$i<=$dep;$i++){
					if($pag == $i){
						echo"<span class='paginacao' style='background-color:blue;border-bottom-color:darkblue;'>$i</span> ";
					}else{
						echo"<a href='?titulopost=$chave&pag=$i' class='paginacao'>$i</a> ";
					}
				}echo". . . <a href='?titulopost=$chave&pag=$count' class='paginacao'>$count</a>";
			}elseif($pag>=($count-5)){
				if(($count - 5)<=1){
					$ant = $count - 4;
				}else{
				echo"<a href='?titulopost=$chave&pag=1' class='paginacao'>1</a> . . . ";
				$ant = $count - 5;
			}
				for($i=$ant;$i<=$count;$i++){
					if($pag == $i){
						echo"<span class='paginacao' style='background-color:blue;border-bottom-color:darkblue;'>$i</span> ";
					}else{
						echo"<a href='?titulopost=$chave&pag=$i' class='paginacao'>$i</a> ";
					}
				}
			}
		    }
    
    public function recomenda(){
        $horario = Conexao::conectar()->prepare("SELECT max(hr_inicio_consulta) FROM tb_consulta");
        $horario->execute(); 
        $consulta = $horario->fetch(PDO::FETCH_BOTH);
        $fim = $this->orientaData($consulta[0]);
        return $fim;
    }

	//

	// Metodos Especiais
		public function getCodigo()
		{
			return $this->codigoadministrador;
		}
		public function getNome() // get = Método que dá acesso a caracteristicas da classe.
		{
			return $this->nomeadministrador;
		}
		public function getEmail() // get = Método que dá acesso a caracteristicas da classe.
		{
			return $this->emailadministrador;
		}
		public function getSenha()
		{
			return $this->senhaadministrador;
		}
		public function getImagem()
		{
			return $this->imagemadministrador;
		}
	//
}
?>