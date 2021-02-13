<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["bancotcc"]["id"] ) ){
    exit;
  }

  //verificar se existem dados no POST
if ( $_POST ) {

	include "../admin/validacao/functions.php";
    include "../admin/config/conexao.php";
	
  	//recuperar os dados do formulario
  	$id = $marca = "";

  	foreach ($_POST as $key => $value) {
  		//guardar as variaveis
  		$$key = trim ( $value );
  	}

  	//validar os campos - em branco
  	if ( empty ( $Marca ) ) {
  		echo '<script>alert("Preencha a marca");history.back();</script>';
  		exit;
  	}

  	//verificar se existe um cadastro com este tipo
  	$sql = "SELECT id FROM marca WHERE Marca = ? AND id <> ? LIMIT 1";
  	//usar o pdo / prepare para executar o sql
  	$consulta = $pdo->prepare($sql);
  	//passando o parametro
  	$consulta->bindParam(1, $marca);
  	$consulta->bindParam(2, $id);
  	//executar o sql
  	$consulta->execute();
  	//puxar os dados (id)
  	$dados = $consulta->fetch(PDO::FETCH_OBJ);

  	//verificar se esta vazio, se tem algo é pq existe um registro com o mesmo nome
  	if ( !empty ( $dados->id ) ) {
  		echo '<script>alert("Já existe uma marca com este nome registrada");history.back();</script>';
  		exit;
  	}

	//iniciar uma transacao
	$pdo->beginTransaction();

  	//se o id estiver em branco - insert
  	//se o id estiver preenchido - update
  	if ( empty ( $id ) ) {
  		//inserir os dados no banco
  		$sql = "INSERT INTO marca (Marca) VALUES( :Marca )";
  		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(":Marca", $Marca);

  	} else {
		
  		//atualizar os dados  	
  		$sql = "UPDATE marca SET Marca = :Marca WHERE id = :id";	
  		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(":Marca", $Marca);
  		$consulta->bindParam(":id", $id);
  	}
    //executar e verificar se deu certo
	if ( $consulta->execute() ) {
		//gravar no banco 
		$pdo->commit();
		echo "<script>alert('Marca Salva com Sucesso!');location.href='listar/marca';</script>";
	}
	//erro ao gravar
	echo "<script>alert('Erro ao gravar no servidor');history.back();</script>";
	exit;
} else {
	echo '<script>alert("Erro ao salvar");history.back();</script>';
	exit;
}
