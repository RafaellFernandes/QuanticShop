<?php
	//iniciar a sessão
	session_start();

	//apagar a sessao
	unset ( $_SESSION["bancotcc"] );

	//redirecionar para a página inicial
	header("Location: ../index.php");


	/*
	session_start();
session_destroy();
header("location: index.php"); 

if(isset($_SESSION['logado'])){
    // se você possui algum cookie relacionado com o login deve ser removido
    session_destroy();
    header("location: http://www.dominio.com.br/index.php");
    exit();
}