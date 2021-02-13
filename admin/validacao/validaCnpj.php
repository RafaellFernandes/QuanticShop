<?php
	//incluir o arquivo da funcao
	include "functions.php";

	$cnpj = "";
	if ( isset ( $_GET["cnpj"] ) )
		$cnpj = trim ( $_GET["cnpj"] );

	//verificar se o cpf esta em branco
	if ( empty ( $cnpj ) ) {
		echo "Forneça um CPF";
		exit;
	} else if ( $cnpj == "12.345.678/0009-09" ) {
		echo "CPF inválido";
		exit;
	}

	//executar a função
	echo validaCNPJ($cnpj);