<?php
	session_start();

	//verificar se não está logado
	if ( !isset ( $_SESSION["bancotcc"]["id"] ) ){
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
		$sql = "select id from cliente where cpf = :cpf limit 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(":cpf", $cpf);
	} else {
		//atualizando - ninguém, fora o usuário, pode ter este cpf
		$sql = "select id from cliente 
			where cpf = :cpf and id <> :id limit 1";
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