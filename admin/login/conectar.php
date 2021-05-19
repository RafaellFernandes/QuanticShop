<?php

	//criar uma conexao com um banco - PDO
	//constante
	define('SERVER', 'localhost');
	define('BANCO', 'quanticshop');
	define('USUARIO', 'root');
	define('SENHA', '');

	try {
		//tentar realizar a conexão
		$pdo = new PDO("mysql:host=".SERVER.";dbname=".BANCO.";charset=utf8",USUARIO,SENHA);
		//echo '<p>Conectou</p>';

	} catch (PDOException $erro) {
		echo '<p>Erro ao tentar conectar no banco de dados:</p>';
		//mostrar a mensagem de erro da conexao
		echo $erro->getMessage();
	}