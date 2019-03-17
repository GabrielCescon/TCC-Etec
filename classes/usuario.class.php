<?php
require_once'conexao.class.php';
require_once'cidade.class.php';
date_default_timezone_set('America/Sao_Paulo');
$arq = "usuario.class.php";#nome do arquivo. Isso evita um acesso direto pela URL.
if (strcmp(basename($_SERVER['PHP_SELF']), basename($arq)) === 0)
{
    header('location:../index.php');
}

Class Usuario extends Conexao
{
            private $codigo;
	private $ativo; #conta ativa ou não
	private $nome; #nome usuario
	private $apelido;#apelido usuario
	private $user;# Nome Skype
	private $email;# Email Usuario
	private $cpf;
	private $senha;
	private $nasc;
	private $periodo;
	private $imagem;
	private $descricao;
	private $chegada;
	private $consultas;
	private $ddd1;
	private $residencial;
	private $ddd2;
	private $cel;
	private $estado;
	private $cidade;

	#metodos especiais
    #set... insere valor | get retorna o valor
	public function setCodigo($c){
                $this->codigo = $c;
            }
            public function getCodigo(){
                return $this->codigo;
            }
            public function setAtivo($at){
		$this->ativo = $at;
	}
	public function getAtivo(){
        $sql="SELECT * FROM tb_usuario WHERE cd_usuario = :codigo";
            $ver = Conexao::conectar()->prepare($sql);
                    $ver->bindValue(':codigo',$this->getCodigo());
                    $ver->execute();
                    $ativo = $ver->fetch(PDO::FETCH_BOTH);
		      $this->ativo = $ativo['ic_ativo'];
        return $this->ativo;
	}
	public function setNome($n){
		$this->nome = $n;
	}
	public function getNome(){
		return $this->nome;
	}
	public function setApelido($ap){
		$this->apelido = $ap;
	}
	public function getApelido(){
		return $this->apelido;
	}
	public function setUser($user){
		$this->user = $user;
	}
	public function getUser(){
		return $this->user;
	}
	public function setEmail($em){
		$this->email = $em;
	}
	public function getEmail(){
		return $this->email;
	}
	public function setCPF($cpf){
		$this->cpf = $cpf;
	}
	public function getCPF(){
		return $this->cpf;
	}
	public function setSenha($s){
		$this->senha = $s;
	}
	public function getSenha(){
		return $this->senha;
	}
	public function setNasc($nasc){
		$this->nasc = $nasc;
	}
	public function getNasc(){
		return $this->nasc;
	}
	public function setPeriodo($p){
		$this->periodo = $p;
	}
	public function getPeriodo(){
		return $this->periodo;
	}
	public function setImagem($img){
		$this->imagem = $img;
	}
	public function getImagem(){
		$sql="SELECT * FROM tb_usuario WHERE cd_usuario = :codigo";
            	$ver = Conexao::conectar()->prepare($sql);
                    $ver->bindValue(':codigo',$this->getCodigo());
                    $ver->execute();
                    $img = $ver->fetch(PDO::FETCH_BOTH);
		  $this->imagem = $img['ds_imagem'];
       		 return $this->imagem;
	}
	public function setDescricao($desc){
		$this->descricao = $desc;
	}
	public function getDescricao(){
		return $this->descricao;
	}
	public function setChegada($cad){
		$this->chegada = $cad;
	}
	public function getChegada(){
		return $this->chegada;
	}
	public function setConsultas($cons){
		$this->consultas = $cons;
	}
	public function getConsultas(){
		return $this->consultas;
	}
	public function setDDD1($ddd1){
		$this->ddd1 = $ddd1;
	}
	public function getDDD1(){
		return $this->ddd1;
	}
	public function setResidencial($res){
		$this->residencial = $res;
	}
	public function getResidencial(){
		return $this->residencial;
	}
	public function setDDD2($ddd2){
		$this->ddd2 = $ddd2;
	}
	public function getDDD2(){
		return $this->ddd2;
	}
	public function setCel($cel){
		$this->cel = $cel;
	}
	public function getCel(){
		return $this->cel;
	}
	public function setEstado($est){
		$this->estado = $est;
	}
	public function getEstado(){
		return $this->estado;
	}
	public function setCidade($cid){
		$this->cidade = $cid;
	}
	public function getCidade(){
		return $this->cidade;
	}

	#metodos
	public function residencialFull(){# retorna o Numero residencial completo
		return "(".$this->getDDD1().") ".$this->getResidencial();
	}
	public function movelFull(){# retorna o Numero do Celular completo
		return "(".$this->getDDD2().") ".$this->getCel();
    }

	public function tel($tel){#passa o valor do DDD e o numero do residencial para os seus objetos
		if(!$tel){
            $this->setResidencial(null);
            $this->setDDD1(null);
        }else{
        $ddd1 = substr($tel,1,2);#ddd residencial
		$tel1 = substr($tel,4);#resto do numero
        $this->setDDD1($ddd1);
        $this->setResidencial($tel1);
        }
    }
    
    public function cel($cel){#passa o valor do DDD e o numero do celular para os seus objetos
        if(!$cel){
            $this->setCel(null);
            $this->setDDD2(null);
        }else{
        $ddd2 = substr($cel,1,2);#ddd celular
        $tel2 = substr($cel,4);#resto do numero
        $this->setCel($tel2);
        $this->setDDD2($ddd2);
        }
    }
    
    public function verificaEmail(){
        try{
        $pdo = Conexao::conectar();
        $user = $pdo->prepare("SELECT * FROM tb_usuario WHERE nm_email = :email");
        $user->bindValue(":email",$this->getEmail());
        $user->execute();
        $row = $user->rowCount();
            if($row == 0){
            return true;
            }else{
                return false;
            }
        }catch(PDOException $erro){            
            die("erro: <code>".$resp->getMessage()."</code>");            
            return false;
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
    
    public function verificaCPF(){
        try{
        $pdo = Conexao::conectar();
        $user = $pdo->prepare("SELECT * FROM tb_usuario WHERE cd_cpf = :cpf");
        $user->bindValue(":cpf",$this->getCPF());
        $user->execute();
        $row = $user->rowCount();
            if($row == 0){
            return true;
            }else{
                return false;
            }
        }catch(PDOException $erro){            
            die("erro: <code>".$resp->getMessage()."</code>");            
            return false;
        }
    }
    
    public function verificaApelido(){
        try{
        $pdo = Conexao::conectar();
        $user = $pdo->prepare("SELECT * FROM tb_usuario WHERE nm_apelido = :apelido");
        $user->bindValue(":apelido",$this->getApelido());
        $user->execute();
        $row = $user->rowCount();
            if($row == 0){
            return true;
            }else{
                return false;
            }
        }catch(PDOException $erro){            
            die("erro: <code>".$resp->getMessage()."</code>");            
            return false;
        }
    }
    
    public function verificaSkype(){
        try{
        $pdo = Conexao::conectar();
        $user = $pdo->prepare("SELECT * FROM tb_contato WHERE nm_virtual = :virtual");
        $user->bindValue(":virtual",$this->getUser());
        $user->execute();
        $row = $user->rowCount();
            if($row == 0){
            return true;
            }else{
                return false;
            }
        }catch(PDOException $erro){            
            die("erro: <code>".$resp->getMessage()."</code>");            
            return false;
        }
    }
    
    public function verificaCadastro(){
        if($this->verificaEmail()==true && $this->verificaCPF()==true && $this->verificaApelido()==true && $this->verificaSkype()==true){
            return true;
        }else{
            return false;
        }
    }

    public function cadastroUser(){#cadastra o usuario
        try{
        #$data = date("Y-m-d H:i:s");
        $pdo = Conexao::conectar();#chama a conexao do banco
        $pessoa = $pdo->prepare("CALL cadastra(:nome,:apelido,:email,:cpf,:senha,:nasc,:periodo,:cidade,:virtual,:ddd1,:tel,:ddd2,:cel)");#chama a procedure Cadastra que cadastra o usuario
        $pessoa->bindValue(":nome",$this->getNome());#nome Completo
        $pessoa->bindValue(":apelido",$this->getApelido());
        $pessoa->bindValue(":email",$this->getEmail());#email
        $pessoa->bindValue(":cpf",$this->getCPF());#CPF
        $pessoa->bindValue(":senha",$this->getSenha());#senha
        $pessoa->bindValue(":nasc",$this->getNasc());#data
        $pessoa->bindValue(":cidade",$this->getCidade());
        $pessoa->bindValue(":periodo",$this->getPeriodo());#periodo
        $pessoa->bindValue(":virtual",$this->getUser());#usuario
        $pessoa->bindValue(":ddd1",$this->getDDD1());
        $pessoa->bindValue(":tel",$this->getResidencial());
        $pessoa->bindValue(":ddd2",$this->getDDD2());
        $pessoa->bindValue(":cel",$this->getCel());
        $pessoa->execute();#executa o comando no sql
            return true;
        }catch(PDOException $erro){            
            die("erro: <code>".$resp->getMessage()."</code>");            
            return false;
        }        
    }
    
    public function atualizarTel(){#atualiza o numero do telefone residencial
                try{
                $pdo = Conexao::conectar();;
                $contato = $pdo->prepare("CALL atualiza_tel(:ddd1,:tel,:apelido)");#chama a procedure Atualiza_tel que atualiza o telefone residencial
                $contato->bindValue(":ddd1",$this->getDDD1());
                $contato->bindValue(":tel",$this->getResidencial());
                $contato->bindValue(":apelido",$this->getApelido());
                $contato->execute();
                    return true;
                    echo"Telefone Atualizado";
                }catch(PDOException $erro){
                        die("erro: <code>".$resp->gerMessage()."</code>");
                        return false;
                    }
    }
        
    public function atualizarCel(){#atualiza o numero do celular
        try{
        $pdo = Conexao::conectar();
        $contato = $pdo->prepare("CALL atualiza_cel(:ddd2,:cel,:apelido)");
        $contato->bindValue(":ddd2",$this->getDDD2());
        $contato->bindValue(":cel",$this->getCel());
        $contato->bindValue(":apelido",$this->getApelido());
        $contato->execute();
            return true;
            echo"Celular Atualizado";
    }catch(PDOException $erro){
            die("erro: <code>".$resp->gerMessage()."</code>");
            return false;
        }  
        
    }

    public function logar($e,$s)#faz o login do usuario no caso
            {
                try
                {
                    $s = sha1($s);#encripita a senha
                    $sql2 = "SELECT * FROM tb_usuario INNER JOIN tb_contato ON tb_contato.cd_usuario = tb_usuario.cd_usuario WHERE nm_email = :email AND nm_senha = :senha"; #verifica se o email,senha existem e se a conta do usuario esta ativa
                    $pessoa = Conexao::conectar()->prepare($sql2); // Aqui prepara para executar o $sql com a conexao estabelecida.
                    $pessoa->bindValue(':email',$e); // Aqui é inserido em :email o $email.
                    $pessoa->bindValue(':senha',$s); // Aqui é inserido em :email a $senha.
                    $pessoa->execute(); // Aqui executa a linha de codigo do prepare
                    $usuario = $pessoa->fetch(PDO::FETCH_BOTH); // Aqui é pego uma Array com os dados do usuario (caso haja).
                    $row = $pessoa->rowCount();
                    if ($row == 0){#se o numero de linhas for igual a zero ou o usuario estiver inativo.
                        return "nao";
                    
                    }else{#se existir um usuario ativo com esse email e senha
                        if($usuario['ic_ativo']=="1"){
                        session_start();
                            $this->setCodigo($usuario['cd_usuario']); // Codigo do usuario
                            $this->setNome($usuario['nm_usuario']); // Nome do usuário.
                            $this->setApelido($usuario['nm_apelido']);#apelido do usuario.
                            $this->setEmail($usuario['nm_email']); // Email do usuário.
                            $this->setCPF($usuario['cd_cpf']); // CPF do usuário.
                            $this->setSenha($usuario['nm_senha']); // Senha do usuário.
                            $this->setNasc($usuario['dt_nascimento']); // Data de Nascimento do usuário.
                            $this->setPeriodo($usuario['nm_periodoconsulta']); // Hora prefirivel de consulta do usuário.
                            $this->setImagem('_fotosperfil/'.$usuario['ds_imagem']); // Imagem de perfil do usuário.
                            $this->setChegada($usuario['dt_chegada']); // Data de criação da conta.
                            $this->setDescricao($usuario['ds_usuario']); // Descrição do usuário.
                            $this->setAtivo($usuario['ic_ativo']);
                            $this->setDDD1($usuario['cd_ddd_tel']);
                            $this->setDDD2($usuario['cd_ddd_cel']);
                            $this->setResidencial($usuario['cd_telefone']);
                            $this->setCel($usuario['cd_celular']);
                            $this->setUser($usuario['nm_virtual']);
                            $this->setConsultas($usuario['qt_consultas']); // Quantidade de consultas do usuario.
                            $this->setCidade($usuario['cd_cidade']);
                        return $usuario['ic_ativo'];
                        }elseif($usuario['ic_ativo'] == "2"){
                            $this->setEmail($usuario['nm_email']); // Email do usuário.
                            $this->setCPF($usuario['cd_cpf']);
                            return $usuario['ic_ativo'];
                        }elseif($usuario['ic_ativo']=="0"){
                            return $usuario['ic_ativo'];
                        }
                    }
                }
                catch(Exception $ex){
                    echo 'Erro ao logar'.$ex;
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
            public function deletar($email,$cpf){
                        $ver = "SELECT ic_ativo FROM tb_usuario WHERE nm_email = :email AND cd_cpf = :cpf";
                            $v = Conexao::conectar()->prepare($ver);
                            $v->bindValue(':email',$email);
                            $v->bindValue(':cpf',$cpf);
                            $v->execute();
                            $row = $v->rowCount();
                            if($row == 1){
                                    $veru = $v->fetch(PDO::FETCH_BOTH);
                                $ativo = $veru['ic_ativo'];
                                if($ativo == '1'){
                                    $sql = "UPDATE tb_usuario SET ic_ativo = '2' WHERE nm_email = :email AND cd_cpf = :cpf";
                                        $deletar = Conexao::conectar()->prepare($sql);
                                        $deletar->bindValue(':email',$email);
                                        $deletar->bindValue(':cpf',$cpf);
                                        $deletar->execute();
                                    return true;
                                }
                                elseif($ativo == '2')
                                {
                                    $sql = "UPDATE tb_usuario SET ic_ativo = '1' WHERE nm_email = :email AND cd_cpf = :cpf";
                                        $deletar = Conexao::conectar()->prepare($sql);
                                        $deletar->bindValue(':email',$email);
                                        $deletar->bindValue(':cpf',$cpf);
                                        $deletar->execute();
                                        return true;
                                }else{
                                    return false;
                                }
                        }else{
                                return false;
                            }
                }
            public function atualizarSenha($novo,$email,$cpf)
	{
                            $verifica = Conexao::conectar()->prepare("SELECT * FROM tb_usuario WHERE nm_email = :email AND cd_cpf = :cpf");
                            $verifica->bindValue(':email',$email);
                            $verifica->bindValue(':cpf',$cpf);
                            $verifica->execute();
                            $row = $verifica->rowCount();
                            if($row == 1){
                			$novo = sha1($novo);
                			$sql = "UPDATE tb_usuario SET nm_senha = :novo WHERE nm_email = :email AND cd_cpf = :cpf"; 
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
            public function atualizarUsuario($nome,$apelido,$consulta,$tel1,$tel2,$cidade,$user,$upload)
            {	// Antes de atualizar ele analiza se é igual a 0, se for, significa que o usuario não inseriu nada novo e apagou o q tava.
                    if ($nome != '0')
                    {
                        $sql = "UPDATE tb_usuario SET nm_usuario = :novo WHERE cd_usuario = :usuario"; 
                                        $atualizar = Conexao::conectar()->prepare($sql);
                                        $atualizar->bindValue(':novo',$nome);
                                        $atualizar->bindValue(':usuario',$this->getCodigo());
                                        $atualizar->execute();
                        $this->setNome($nome);
                    }
                    if ($apelido != '0')
                    {
                        $sql = "UPDATE tb_usuario SET nm_apelido = :novo WHERE cd_usuario = :usuario"; 
                                        $atualizar = Conexao::conectar()->prepare($sql);
                                        $atualizar->bindValue(':novo',$apelido);
                                        $atualizar->bindValue(':usuario',$this->getCodigo());
                                        $atualizar->execute();
                        $this->setApelido($apelido);
                    }
                    if ($consulta != '0')
                    {
                        $sql = "UPDATE tb_usuario SET nm_periodoconsulta = :novo WHERE cd_usuario = :usuario"; 
                                        $atualizar = Conexao::conectar()->prepare($sql);
                                        $atualizar->bindValue(':novo',$consulta);
                                        $atualizar->bindValue(':usuario',$this->getCodigo());
                                        $atualizar->execute();
                        $this->setPeriodo($consulta);
                    }
                    if ($tel1 != '0')
                    {
                            $ddd1 = substr($tel1,1,2); #ddd
                            $tel1 = substr($tel1,4); #resto do numero
                        $sql = "UPDATE tb_contato SET cd_ddd_tel = :novo, cd_telefone = :novo2 WHERE cd_usuario = :usuario"; 
                                        $atualizar = Conexao::conectar()->prepare($sql);
                                        $atualizar->bindValue(':novo',$ddd1);
                                        $atualizar->bindValue(':novo2',$tel1);
                                        $atualizar->bindValue(':usuario',$this->getCodigo());
                                        $atualizar->execute();
                        $this->setDDD1($ddd1);
                        $this->setResidencial($tel1);
                    }
                    if ($tel2 != '0')
                    {
                            $ddd1 = substr($tel2,1,2); #ddd
                            $tel1 = substr($tel2,4); #resto do numero
                        $sql = "UPDATE tb_contato SET cd_ddd_tel = :novo, cd_telefone = :novo2 WHERE cd_usuario = :usuario"; 
                                        $atualizar = Conexao::conectar()->prepare($sql);
                                        $atualizar->bindValue(':novo',$ddd1);
                                        $atualizar->bindValue(':novo2',$tel1);
                                        $atualizar->bindValue(':usuario',$this->getCodigo());
                                        $atualizar->execute();
                        $this->setDDD2($ddd1);
                        $this->setCel($tel1);
                    }
                    if ($cidade != 'N')
                    {
                        $sql = "UPDATE tb_usuario SET cd_cidade = :novo WHERE cd_usuario = :usuario"; 
                                        $atualizar = Conexao::conectar()->prepare($sql);
                                        $atualizar->bindValue(':novo',$nome);
                                        $atualizar->bindValue(':usuario',$this->getCodigo());
                                        $atualizar->execute();
                        $this->setCidade($cidade);
                    }
                    if ($user != '0')
                    {
                        $sql = "UPDATE tb_contato SET nm_virtual = :novo WHERE cd_usuario = :usuario"; 
                                        $atualizar = Conexao::conectar()->prepare($sql);
                                        $atualizar->bindValue(':novo',$user);
                                        $atualizar->bindValue(':usuario',$this->getCodigo());
                                        $atualizar->execute();
                        $this->setUser($user);
                    }
                    if ($upload["arqSize"] != '0')
                    {echo "<script>alert('o');</script>";
                    	if ($this->getImagem() != "Padrao.jpg") // Caso a imagem antiga n for a Padrao.jpg ele apaga
                    	{	$im=$this->getImagem();
                    		unlink("_fotosperfil/$im");
                    	}
                    	switch($upload["arqType"])
		{
			case 'image/gif':
				$tipo=".gif";
			break;
			case 'image/jpeg':
				$tipo=".jpg";
			break;
			case 'image/png':
				$tipo=".png";
			break;
			default:
	       		return false;
		}	
                        $pasta = "_fotosperfil/";
                        $nomeimg="FP".rand(1000000000,9999999999).$tipo;
                        move_uploaded_file($upload["arqTemp"], $pasta .$nomeimg);
                        $sql = "UPDATE tb_usuario SET ds_imagem = :novo WHERE cd_usuario = :usuario"; 
                                        $atualizar = Conexao::conectar()->prepare($sql);
                                        $atualizar->bindValue(':novo',$nomeimg);
                                        $atualizar->bindValue(':usuario',$this->getCodigo());
                                        $atualizar->execute();
                    }
            }
}
?>


