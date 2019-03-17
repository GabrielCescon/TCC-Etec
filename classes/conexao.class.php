<?php

date_default_timezone_set('America/Sao_Paulo');
$arq = "conexao.class.php";#nome do arquivo. Isso evita um acesso direto pela URL.
if (strcmp(basename($_SERVER['PHP_SELF']), basename($arq)) === 0)
{
    header('location:../index.php');
}

Class Conexao
{
	// Atributos

		public static $conexao;
	//

	// Metodos
		public static function conectar() 
		{
			if (!isset(self::$conexao)) 
			{
				self::$conexao = new PDO("mysql:host=localhost:3307;dbname=db_psicoloco", "root", "usbw", array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8" ));
			}  
			return self::$conexao;
		}
	//
}
?>