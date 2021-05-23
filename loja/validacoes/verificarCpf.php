<?php
	session_start();

	if (!isset($_SESSION["quanticshop"]["id"])) {
		$titulo = "Erro";
		$mensagem = "Usuário Não Logado";
		$icone = "error";
		mensagem($titulo, $mensagem, $icone);
	exit;
	}
	
	if ($_SESSION["quanticshop"]["nivelAcesso"] != "cliente") {
		$titulo = "Erro";
		$mensagem = "Erro na Requisição da Página";
		$icone = "error";
		mensagem($titulo, $mensagem, $icone);
	exit;
	}

	//recuperar o cpf
	$cpf = $_GET["cpf"] ?? "";
	$id  = $_GET["id"] ?? "";

	if ( empty ( $cpf ) ) {
		echo "O CPF está vazio";
		exit;
	}

	//incluir o arquivo de conexao
	include "../config/conexao.php";
	include "functions.php";

	$msg =  validaCPF($cpf);

	if ( $msg != 1 ) {
		echo $msg;
		exit;
	}

	//verificar se existe alguem com este mesmo cpf
	if ( ( $id == 0 ) or ( empty ( $id ) ) ) {
		//inserindo - ninguem pode ter este cpf
		$sql = "SELECT id FROM cliente WHERE cpf = :cpf LIMIT 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(":cpf", $cpf);
	} else {
		//atualizando - ninguém, fora o usuário, pode ter este cpf
		$sql = "SELECT id FROM cliente 
			WHERE cpf = :cpf AND id <> :id LIMIT 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(":cpf", $cpf);
		$consulta->bindParam(":id", $id);
	}

	$consulta->execute();
	$dados = $consulta->fetch(PDO::FETCH_OBJ);

	if ( !empty ( $dados->id ) ) {
		echo "Já existe um cliente cadastrado com este CPF";
		exit;
	}