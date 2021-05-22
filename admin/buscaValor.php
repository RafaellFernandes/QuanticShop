<?php
	session_start();

	if ( ! isset ( $_SESSION['quanticshop']['id'] ) )
	 exit;

	$produto = trim ( $_GET['produto'] ??  NULL );

	if ( !empty ( $produto ) ) {

		include "validacao/functions.php";
		include "config/conexao.php";

		$sql = "select venda_unitaria from item_compra where id = :venda_unitaria limit 1"; 
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(':venda_unitaria', $venda_unitaria);
		$consulta->execute();

		$dados = $consulta->fetch(PDO::FETCH_OBJ);

	
	}