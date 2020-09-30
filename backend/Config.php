<?php
require_once 'Validator.php';

	/**
		Aqui poderá customizar parte da aplicação como: 
		- Adicionar mais campos de dados recebidos do front-end,
		- Alterar links de redirecionamento,
		- Alterar usuario, senha e dns do banco de dados,

	**/

	$link_redirect = 'http://localhost:80/qrproject/frontend/index.html';
	$post_campos = array('nome', 'cpf', 'email', 'telefone');

class DbData{

	private	$user_DB = 'root';
	private	$pass_DB  = '';
	private	$table_name = 'cadastrados';
	private	$dns_DB = 'mysql:host=localhost;dbname=QRProject';

	function __get($val){
		return $this->$val;
	}

	function returnDNS(){
		$connect_array = array($this->dns_DB, $this->user_DB, $this->pass_DB);
		return $connect_array;
	}
}

	function returnPostData(){
		$arrayData = array('nome'=>$_POST['nome'], 'cpf'=>$_POST['cpf'], 'email'=>$_POST['email'], 'telefone'=>$_POST['telefone']);
		return $arrayData;
	}

	function returnMsg(){
		$messages = array(
			'msg_success_register_but_email_error' => 'Seu cadastro foi realizado com sucesso porem nao foi possivel enviar o e-mail de confirmação.',

			'msg_success_register' => 'Seu cadastro foi realizado com sucesso e um e-mail de confirmação foi enviado para o e-mail informado no cadastro.',

			'msg_success_register_but_email_error' => 'Seu cadastro foi realizado com sucesso porem nao foi possivel enviar o e-mail de confirmação.',

			'msg_error_register' => 'Ocorreu um erro no registro de seus dados.',

			'msg_register_exists' => 'Cadastro ja existe');

		return $messages;
	}
?>