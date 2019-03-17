<?php
require_once('conexao.class.php');
require_once('estado.class.php');
date_default_timezone_set('America/Sao_Paulo');
$arq = "cidade.class.php";#nome do arquivo. Isso evita um acesso direto pela URL.
if (strcmp(basename($_SERVER['PHP_SELF']), basename($arq)) === 0)
{
    header('location:../index.php');
}

Class Cidade 
{
	// Atributos
		private $cidade;
		private $estado;
	//
	// Metodos
		public function CidadePorEstado($uf) // Aqui eu vou enviar todas as opções de cidades pra o estado recebido numa array.
		{
			if (isset($uf) == false) 
			{
				return false;
			}
			else
			{
				$sql="SELECT nm_cidade, cd_cidade  FROM tb_cidade WHERE sg_uf = :UF";
					$cidade= Conexao::conectar()->prepare($sql);
					$cidade->bindValue(':UF',$uf);
					$cidade->execute();
					$cpe = $cidade->fetchAll(PDO::FETCH_BOTH);
		        			return $cpe;
		        	}
		}
	// Metodos Especiais
		public function __construct()
		{
			// instancia novo contato
			$this->estado = new Estado;
		}
		public function setCidade($codigo)
		{
			$sql = "SELECT nm_cidade,sg_uf FROM tb_cidade WHERE cd_cidade = :codigo";
			$cidade= Conexao::conectar()->prepare($sql);
			$cidade->bindValue(':codigo',$codigo);
			$cidade->execute();
			$cid = $cidade->fetch(PDO::FETCH_BOTH);
			$this->cidade = $cid[0];
			$this->estado->setEstado($cid[1]);
		}
		public function getCidade()
		{
			return $this->cidade;
		}
		public function getEstado()
		{
			return $this->estado->getEstado();
		}
	//
}
?>