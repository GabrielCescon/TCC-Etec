<?php
require_once('conexao.class.php');
date_default_timezone_set('America/Sao_Paulo');
$arq = "mensagem.class.php";#nome do arquivo. Isso evita um acesso direto pela URL.
if (strcmp(basename($_SERVER['PHP_SELF']), basename($arq)) === 0)
{
	header('location:../index.php');
}

Class Mensagem
{
	// Atributos
		private $codigomensagem;
		private $nomepessoa;
		private $emailmensagem;
		private $descricaomensagem;
	//

	// Metodos
		public function criarMensagem($nomepessoa,$emailmensagem,$descricaomensagem)
		{
			$sql="INSERT INTO tb_mensagem (nm_pessoa, nm_email, ds_mensagem, cd_admin) VALUES (:nome,:email,:descricao,:codigodoadmin)";
				$mensagem= Conexao::conectar()->prepare($sql);
				$mensagem->bindValue(':nome',$nomepessoa);
				$mensagem->bindValue(':email',$emailmensagem);
				$mensagem->bindValue(':descricao',$descricaomensagem);
				$mensagem->bindValue(':codigodoadmin',1);
				$mensagem->execute();
			return true;
		}
		public function verMensagens()
		{
			$sql="SELECT cd_mensagem, nm_pessoa,nm_email FROM tb_mensagem order by cd_mensagem desc";
				$mensagem= Conexao::conectar()->prepare($sql);
				$mensagem->execute();
				$mens = $mensagem->fetchAll(PDO::FETCH_BOTH);
		        	return $mens;
		}
		public function verMensagem($codigomensagem) // Pra após selecionar a mensagem
		{
				$sql="SELECT nm_pessoa, nm_email, ds_mensagem FROM tb_mensagem  WHERE cd_mensagem = :cdcontato";
					$mensagem= Conexao::conectar()->prepare($sql);
					$mensagem->bindValue(':cdcontato',$codigomensagem);
					$mensagem->execute();
					$mens = $mensagem->fetchAll(PDO::FETCH_BOTH);
		      	     		$row=count($mens);
				if ($row==0) 
				{
					return false;
				}
				else
				{
					return $mens;
				}
		}
		public function deletar($codigomensagem)
		{
			$sql = "DELETE FROM tb_mensagem WHERE cd_mensagem = :codigo";
				$delete= Conexao::conectar()->prepare($sql);
				$delete->bindValue(':codigo',$codigomensagem);
				$delete->execute();
		}
	//
}
?>