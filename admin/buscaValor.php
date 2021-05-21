<?php
	session_start();

	if ( ! isset ( $_SESSION['quanticshop']['id'] ) )
	 exit;

	$produto = trim ( $_GET['produto'] ??  NULL );

	if ( !empty ( $produto ) ) {

		include "validacao/functions.php";
		include "config/conexao.php";

		$sql = "select valor_unitario from produto where id = :produto limit 1"; 
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(':produto', $produto);
		$consulta->execute();

		$dados = $consulta->fetch(PDO::FETCH_OBJ);

	
	}