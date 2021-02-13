<?php
	session_start();

	//verificar se não está logado
	if ( !isset ( $_SESSION["bancotcc"]["id"] ) ){
		exit;
	}

	//recuperar o email
	$Email = $_GET["email"] ?? "";
	$id  = $_GET["id"] ?? "";

	//incluir o arquivo de conexao
	include "../config/conexao.php";

//verificar se existe alguem com este mesmo email
	if ( ( $id == 0 ) or ( empty ( $id ) ) ) {
		//inserindo - ninguem pode ter este cpf
		$sql = "SELECT id FROM transportadora WHERE email = :email LIMIT 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(":email", $email);
	} else {
		//atualizando - ninguém, fora o usuário, pode ter este email
		$sql = "SELECT id FROM transportadora 
			WHERE email = :email AND id <> :id LIMIT 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(":email", $email);
		$consulta->bindParam(":id", $id);
	}

	$consulta->execute();
	$dados = $consulta->fetch(PDO::FETCH_OBJ);

	if ( !empty ( $dados->id ) ) {
		echo "Já existe uma Transportadora cadastrada com este e-mail!";
		exit;
	}