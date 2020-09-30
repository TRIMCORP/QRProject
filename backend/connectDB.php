<?php
require_once 'Validator.php';

//A função tenta criar uma conexão com o Banco de Dados utilizando os dados passados pela array no parametro.
function connectDB($arr){
	try{
		$conexao = new PDO($arr[0], $arr[1], $arr[2]);
		$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $conexao;
	}catch(PDOException $e){
		print("Ocorreu um erro, verifique: ".$e->getCode()." " . $e->getMessage());
		die();
	}
}

?>