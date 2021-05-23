<?php
	session_start();

	if ( ! isset ( $_SESSION['quanticshop']['id'] ) )
	 exit;

	$produto = trim ( $_GET['produto_id'] ??  NULL );

	if ( !empty ( $produto ) ) {

		
		include "config/conexao.php";

		$sql = "select venda_unitaria from produto where id = :produto limit 1"; 
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(':produto', $produto);
		$consulta->execute();

		$dados = $consulta->fetch(PDO::FETCH_OBJ);

		//verificar se há valor promocional
		if ( ( isset ( $dados->promocao ) ) and ( $dados->promocao > 0 ) ) {
			echo number_format($dados->promocao, 2, ",", ".");
			exit;
		}

		if ( !empty ( $dados->venda_unitaria ) ) {
			echo number_format($dados->venda_unitaria, 2, ",", ".");
			exit;
		}

		echo "erro";
	}