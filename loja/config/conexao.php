<?php
	//arquivo para criar uma conexão com o banco de dados mysql
	$servidor = "localhost";
	$usuario = "root";
	$senha = "";
	$banco = "quanticshop";
	try {
		//criar uma conexao com PDO
		$pdo = new PDO("mysql:host=$servidor;
			dbname=$banco;
			charset=utf8",
			$usuario,
			$senha);

		$conn = mysqli_connect($servidor, $usuario, $senha, $banco);
	} catch (PDOException $erro) {
		echo "<script>location.href='http://localhost//QuanticShop/error/500.php'</script>";
    }
?>
