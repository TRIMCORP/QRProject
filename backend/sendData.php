<?php

//Algumas inclusões de funções.
require_once 'connectDB.php';
require_once 'Config.php';
require_once 'Validator.php';
require_once 'sendEmail.php';

//Algumas configurações extras
header('Content-Type: application/json');

	//Algumas funções que retornam arrays
	$arrayData = returnPostData();
	$msg = returnMsg();

	//Verifica se o metodo utilizado de requisição é POST, se não o usuario sera redirecionado para a pagina inicial.
	if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
		header('Location: '.$link_redirect);
	}

	//Recebe os dados e envia para o banco de dados
	function sendData($post_campos){

		$dbData = new DbData;
		$connectDB = connectDB($dbData->returnDNS());
		$data_insert_columns = implode(",", $post_campos);
		$arrayData = returnPostData();

		//Aqui a aplicação tenta enviar os dados para o Banco de Dados.
		try{
			$stmt = $connectDB->prepare("INSERT INTO cadastrados ($data_insert_columns) VALUES (?,?,?,?)");
			$stmt->execute(
				[$arrayData['nome'], $arrayData['cpf'], $arrayData['email'], $arrayData['telefone']]
			);

			//Aqui a aplicação tenta enviar um e-mail de confirmação de cadastro para o e-mail informado no formulário.
			if(sendEmail($arrayData['email'], $arrayData['nome'])){
				echo json_encode("<h1>". $msg['msg_success_register'] ."</h1>");
			}else{
				echo json_encode("<h1>". $msg['msg_success_register_but_email_error'] ."</h1>");
			}

		//Metodo chamado caso aconteça algum erro.
		}catch(Exception $e){
			echo json_encode("<h1>". $msg['msg_error_register'] ."</h1>");
		}
	}

	//Verifica se os dados inseridos existem
	if (verifyIfDataExists($arrayData['cpf']) > 0) {
		echo json_encode('<h1>'. $msg['msg_register_exists'] .'</h1>');

	//Verifica se o formulário post contem algum campo em vazio, caso tenha é redirecionado.
	}else if (checkForm($post_campos)){
		header('Location: '.$link_redirect);

	//Caso passe pelos metodos de condições, os dados serão redirecionados para a tentativa de inserção no Banco de Dados.
	}else{
		sendData($post_campos);
	}
?>