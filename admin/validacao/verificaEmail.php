<?php
	session_start();

	//verificar se não está logado
	if ( !isset ( $_SESSION["bancotcc"]["id"] ) ){
		exit;
	}

	//recuperar o email
	$Email = $_GET["Email"] ?? "";
	$id  = $_GET["id"] ?? "";

	//incluir o arquivo de conexao
	include "../config/conexao.php";

//verificar se existe alguem com este mesmo email
	if ( ( $id == 0 ) or ( empty ( $id ) ) ) {
		//inserindo - ninguem pode ter este cpf
		$sql = "SELECT id FROM cliente WHERE Email = :Email LIMIT 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(":Email", $Email);
	} else {
		//atualizando - ninguém, fora o usuário, pode ter este email
		$sql = "SELECT id FROM cliente 
			WHERE Email = :Email AND id <> :id LIMIT 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(":Email", $Email);
		$consulta->bindParam(":id", $id);
	}

	$consulta->execute();
	$dados = $consulta->fetch(PDO::FETCH_OBJ);

	if ( !empty ( $dados->id ) ) {
		echo "Já existe um cliente cadastrado com este e-mail";
		exit;
	}