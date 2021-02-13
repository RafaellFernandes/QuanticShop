<?php
    session_start();

    //verificar se esta ou nao logado
    if ( !isset ( $_SESSION["bancotcc"]["id"] ) ){
        exit;
    }

    //recuperar o cnpj
    $cnpj = $_GET["cnpj"] ?? "";
    $id  = $_GET["id"] ?? "";

    if ( empty ( $cnpj ) ) {
        echo "O Cnpj esta vazio";
        exit;
    }

    //incluir o arquivo conexao
    include "config/conexao.php";
    include "functions.php";

    $msg = validaCNPJ($cnpj);

    if ( $msg != 1 ) {
        echo $msg;
        exit;
    }

    //verificar se existe alguem com o mesmo cnpj
    if ( ( $id == 0 ) or ( empty ( $id ) ) ) {
        //inserindo - nuinguem pode ter esse cnpj 
        $sql = "SELECT id FROM fornecedor WHERE cnpj = :cnpj LIMIT 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":cnpj", $cnpj);


    } else {
        //atualizando - ngm, fora o usuario, pode ter esse cnpj
        $sql = "SELECT id FROM  WHERE fornecedor cnpj = :cnpj AND id <> :id LIMIT 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":cnpj", $cnpj);
        $consulta->bindParam(":id", $id);

    }

    $consulta->execute();
    $dados = $consulta->fetch(PDO::FETCH_OBJ);

    if ( !empty ( $dados->id ) ) {
        echo "ja existe um fornecedor cadastrado com este cnpj";
        exit;

    }