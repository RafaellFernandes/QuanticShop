<?php
	//iniciar a sessao
	session_start();

	//verificar se esta logado
    if ( ! isset ( $_SESSION['quanticshop']['id'] ) ) exit;

    //recuperar os dados
    $id = trim ( $_POST["id"] ?? NULL );
    $cpf = trim ( $_POST["cpf"] ?? NULL );

    //verificar se esta em branco
    if ( empty ( $cpf ) ) {
    	echo "CPF inválido";
    	exit;
    }

    //conectar no banco
    include "config/conexao.php";

    //sql para buscar o cpf - não pode ser da mesmo id
    $sql = "select id from cliente 
    where cpf = :cpf AND id <> :id limit 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":id", $id);
    $consulta->bindParam(":cpf", $cpf);
    $consulta->execute();

    //recuperar os dados da consulta
    $dados = $consulta->fetch(PDO::FETCH_OBJ);

    //mostrar erro se trouxer algum resultado
    if ( !empty ( $dados->id ) ) {
    	echo "Já existe alguém com este CPF";
    	exit;
    }
