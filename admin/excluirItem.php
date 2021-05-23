<?php
	//iniciar a sessao
	session_start();
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

	//recuperar os dados
	$venda_id = trim ( $_GET["venda_id"] ?? NULL );
	$produto_id = trim ( $_GET["produto_id"] ?? NULL );

	//verificar se estão preenchidos
	if ( ( empty($venda_id) ) or ( empty ($produto_id) ) ) {
		echo "<script>alert('Venda ou produto inválido');history.back();</script>";
		exit;
	}

	//conectar no banco de dados
	include "validacao/functions.php";
    include "config/conexao.php";

	//recuperar o status da venda
	$sql = "select status from venda where id = :venda_id limit 1";
	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(":venda_id", $venda_id);
	$consulta->execute();

	//recuperar os dados - status
	$dados = $consulta->fetch(PDO::FETCH_OBJ);

	if ( ( $dados->status == "C" ) or ( $dados->status == "P") ) {
		echo "<script>alert('Não é possível excluir este item pois a venda está paga ou cancelada');history.back();</script>";
		exit;
	}

	//excluir os dados da tabela
	$sql = "delete from item_venda
		where venda_id = :venda_id AND 
		produto_id = :produto_id limit 1";
	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(":venda_id", $venda_id);
	$consulta->bindParam(":produto_id", $produto_id);

	//redirecionar para o itens.php
	if ( $consulta->execute() ) {
		echo "<script>location.href='itens.php?venda_id={$venda_id}';</script>";
		exit;
	}
	//mensagem de erro do banco
	echo $consulta->errorInfo()[2];

	//mensagem de erro do javascript
	echo "<script>alert('Erro ao excluir produto da venda');history.back();</script>";
	exit;