<?php
	if (!isset($_SESSION["quanticshop"]["id"])) {
		$titulo = "Erro";
		$mensagem = "Usuário Não Logado";
		$icone = "error";
		mensagem($titulo, $mensagem, $icone);
		exit;
	}

	if ($_SESSION["quanticshop"]["nivelAcesso"] != "admin") {
		echo "<script>location.href='http://localhost//QuanticShop/erros/401.php'</script>";
		exit;
	}

 	//verificar se existem dados no POST
	if ( $_POST ) {

	include "validacao/functions.php";
    include "config/conexao.php";
	
  	//recuperar os dados do formulario
  	$id = $nome_marca = $ativo = "";

  	foreach ($_POST as $key => $value) {
  		//guardar as variaveis
  		$$key = trim ( $value );
  	}

  	//validar os campos - em branco
  	if ( empty ( $nome_marca ) ) {
		$titulo = "Erro";
		$mensagem = "Preencha a marca";
		$icone = "error";
		mensagem($titulo, $mensagem, $icone);
  		echo '<script>history.back();</script>';
  		exit;
  	}

  	//verificar se existe um cadastro com este tipo
  	$sql = "SELECT id FROM marca WHERE nome_marca = ? AND id <> ? LIMIT 1";
  	//usar o pdo / prepare para executar o sql
  	$consulta = $pdo->prepare($sql);
  	//passando o parametro
  	$consulta->bindParam(1, $nome_marca);
  	$consulta->bindParam(2, $id);
  	//executar o sql
  	$consulta->execute();
  	//puxar os dados (id)
  	$dados = $consulta->fetch(PDO::FETCH_OBJ);

  	//verificar se esta vazio, se tem algo é pq existe um registro com o mesmo nome
  	if ( !empty ( $dados->id ) ) {
		  $titulo = "Erro";
		  $mensagem = "Já existe uma marca com este nome registrada";
		  $icone = "error";
		  mensagem($titulo, $mensagem, $icone);
  		exit;
  	}

	//iniciar uma transacao
	$pdo->beginTransaction();

  	//se o id estiver em branco - insert
  	//se o id estiver preenchido - update
  	if ( empty ( $id ) ) {
  		//inserir os dados no banco
  		$sql = "INSERT INTO marca (nome_marca, ativo) VALUES (:nome_marca, :ativo )";
  		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(":nome_marca", $nome_marca);
		$consulta->bindParam(":ativo", $ativo);

  	} else {
  		//atualizar os dados  	
  		$sql = "UPDATE marca SET nome_marca = :nome_marca, ativo = :ativo WHERE id = :id";	
  		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(":nome_marca", $nome_marca);
		$consulta->bindParam(":ativo", $ativo);
  		$consulta->bindParam(":id", $id);
  	}
    //executar e verificar se deu certo
	if ( $consulta->execute() ) {
		//gravar no banco 
		$pdo->commit();
		$titulo = "Sucesso";
		$mensagem = "Marca Salva com Sucesso!";
		$icone = "success";
		mensagem($titulo, $mensagem, $icone);
		echo "<script>location.href='listagem/marca';</script>";
	}
		//erro ao gravar
		$titulo = "Erro";
		$mensagem = "Erro ao gravar no servidor";
		$icone = "error";
		mensagem($titulo, $mensagem, $icone);
		echo "<script>history.back();</script>";
		exit;

} else {
		$titulo = "Erro";
		$mensagem = "Erro ao Salvar";
		$icone = "error";
		mensagem($titulo, $mensagem, $icone);
		echo '<script>history.back();</script>';
		exit;
}
