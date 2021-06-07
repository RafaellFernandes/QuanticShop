<?php
session_start();

//verificar se não está logado
if ( !isset ( $_SESSION["quanticshop"]["id"] ) ){
	exit;
}

//recuperar o email
$email = $_GET["email"] ?? "";
$id  = $_GET["id"] ?? "";
	
//incluir o arquivo de conexao
include "../config/conexao.php";
include "functions.php";

//verificar se existe alguem com este mesmo email
if ( ( $id == 0 ) or ( empty ( $id ) ) ) {
	//inserindo - ninguem pode ter este cpf
	$sql = "SELECT id FROM usuario WHERE email = :email LIMIT 1";
	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(":email", $email);
} else {
	//atualizando - ninguém, fora o usuário, pode ter este email
	$sql = "SELECT id FROM usuario 
		WHERE email = :email AND id <> :id LIMIT 1";
	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(":email", $email);
	$consulta->bindParam(":id", $id);
}

$consulta->execute();
$dados = $consulta->fetch(PDO::FETCH_OBJ);


if ( !empty ( $dados->id ) ) {


	echo "Já existe um Usuário cadastrado com este e-mail";
	// $titulo = "Erro";
    // $mensagem = "Já existe um Cliente cadastrado com este e-mail";
    // $icone = "error";
    //mensagem("Erro", "Já existe um Usuário cadastrado com este e-mail", "error");

	exit;
}