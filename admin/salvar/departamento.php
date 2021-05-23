<?php
 if (!isset($_SESSION["quanticshop"]["id"])) {
    $titulo = "Erro";
    $mensagem = "Usuário Não Logado";
    $icone = "error";
    mensagem($titulo, $mensagem, $icone);
exit;
}

if ($_SESSION["quanticshop"]["nivelAcesso"] != "admin") {
    $titulo = "Erro";
    $mensagem = "Erro na Requisição da Página";
    $icone = "error";
    mensagem($titulo, $mensagem, $icone);
exit;
}
  include "validacao/functions.php";
  //verificar se existem dados no POST
  if ( $_POST ) {

  	//recuperar os dados do formulario
  	$id = $nome_dept = $ativo ="";

  	foreach ($_POST as $key => $value) {
  		//guardar as variaveis
  		$$key = trim ( $value );
  		//$id
  	}

  	//validar os campos - em branco
  	if ( empty ( $nome_dept ) ) {
  		echo '<script>alert("Preencha o nome do Departamento");history.back();</script>';
  		exit;
  	}


  	//verificar se existe um cadastro com este tipo
  	$sql = "SELECT id FROM departamento
  		WHERE nome_dept = ? AND id <> ? LIMIT 1";
  	//usar o pdo / prepare para executar o sql
  	$consulta = $pdo->prepare($sql);
  	//passando o parametro
  	$consulta->bindParam(1, $nome_dept);
  	$consulta->bindParam(2, $id);
  	//executar o sql
  	$consulta->execute();
  	//puxar os dados (id)
  	$dados = $consulta->fetch(PDO::FETCH_OBJ);

  	//verificar se esta vazio, se tem algo é pq existe um registro com o mesmo nome
  	if ( !empty ( $dados->id ) ) {
		$titulo = "Atenção";
		$mensagem = "Já Existe um Departamento com esse Nome";
		$icone = "warning";
		mensagem($titulo, $mensagem, $icone);
  		echo 'history.back();';
  		exit;
  	}

  	//se o id estiver em branco - insert
  	//se o id estiver preenchido - update
  	if ( empty ( $id ) ) {
  		//inserir os dados no banco
  		$sql = "INSERT INTO departamento (nome_dept, ativo) VALUES( :nome_dept, :ativo )";
  		$consulta = $pdo->prepare($sql);
  		$consulta->bindParam(":nome_dept", $nome_dept);
		$consulta->bindParam(":ativo", $ativo);

  	} else {
  		//atualizar os dados  	
  		$sql = "UPDATE departamento SET nome_dept = :nome_dept, ativo = :ativo WHERE id = :id LIMIT 1";	
  		$consulta = $pdo->prepare($sql);
  		$consulta->bindParam(":nome_dept", $nome_dept);
		$consulta->bindParam(":ativo", $ativo);
  		$consulta->bindParam(":id", $id);
  	}
  	//executar e verificar se deu certo
  	if ( $consulta->execute() ) {
		$titulo = "Sucesso";
		$mensagem = "Departamento Salvo!";
		$icone = "success";
		mensagem($titulo, $mensagem, $icone);
  		echo 'location.href="listagem/departamento"';

  	} else {
		$titulo = "Erro";
		$mensagem = "Erro ao Salvar!";
		$icone = "error";
		mensagem($titulo, $mensagem, $icone);
  		echo '<script>history.back();</script>';
  		exit;
  	}

  } else {
  	//mensagem de erro
  	//javascript - mensagem alert
  	//retornar hostory.back
	$titulo = "Erro";
	$mensagem = "Erro ao Realizar Requisição";
	$icone = "error";
	mensagem($titulo, $mensagem, $icone);
  	echo '<script>history.back();</script>';
  }