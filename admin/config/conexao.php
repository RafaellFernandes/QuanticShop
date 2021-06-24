<?php
	//arquivo para criar uma conexão com o banco de dados mysql
	$servidor = "localhost";
	//em 99% dos casos é localhost
	//usuario de acesso ao banco
	$usuario = "root";
	$senha = "";
	//nome do banco de dados
	$banco = "quanticshop";

	try {
		//criar uma conexao com PDO
		$pdo = new PDO("mysql:host=$servidor;
			dbname=$banco;
			charset=utf8",
			$usuario,
			$senha);
	} catch (PDOException $erro) {
		echo "<script>location.href='http://localhost//QuanticShop/erros/500.php'</script>";
    }
?>