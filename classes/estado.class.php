<?php
require_once('conexao.class.php');
date_default_timezone_set('America/Sao_Paulo');
$arq = "estado.class.php";#nome do arquivo. Isso evita um acesso direto pela URL.
if (strcmp(basename($_SERVER['PHP_SELF']), basename($arq)) === 0)
{
    header('location:../index.php');
}

Class Estado
{
	// Atributos
		private $estado;
	//

	// Metodos
		public function estados() // Aqui a vai os estados pra pessoa escolher.
		{
			$sql="SELECT sg_uf,nm_estado  FROM tb_uf";
				$estado= Conexao::conectar()->prepare($sql);
				$estado->execute();
				$est = $estado->fetchAll(PDO::FETCH_BOTH);
	        			return $est;
		}
	//

	// Metodos Especiais
		public function setEstado($codigo)
		{
			$sql = "SELECT nm_estado FROM tb_uf WHERE cd_estado = :codigo";
			$estado= Conexao::conectar()->prepare($sql);
			$estado->bindValue(':codigo',$codigo);
			$estado->execute();
			$esta = $estado->fetch(PDO::FETCH_BOTH);
			$this->estado = $esta[0];
		}
		public function getEstado()
		{
			return $this->estado;
		}
	//
}
?>