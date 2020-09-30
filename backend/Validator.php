<?php
	
require_once 'Config.php';
require_once 'connectDB.php';

	//A função verifica se algum campo no formulário está vazio.
	 function checkForm($post_campos){
		foreach ($post_campos as $key) {
			if (empty($_POST[$key])) {
				return true;
			}
		}
	}

	//A função verifica se os dados no Banco de Dados condiz com os dados informados no parametro da função.
	function verifyIfDataExists($field1){
		$dbData = new DbData;
		$connectDB = connectDB($dbData->returnDNS());
		$sql = "SELECT * from cadastrados where cpf=?";
		$stmt = $connectDB->prepare($sql);
		$stmt->execute([$field1]);
		$row_count = $stmt->rowCount();
		return $row_count;
	}

?>