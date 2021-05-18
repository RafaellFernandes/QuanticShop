<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["quanticshop"]["id"] ) ){
    exit;
  }

  //verificar se existem dados no POST
  if ( $_POST ) {

  	//recuperar os dados do formulario
  	$id = $nome_marca = $ativo = "";

  	foreach ($_POST as $key => $value) {
  		//guardar as variaveis
  		$$key = trim ( $value );
  		//$id
  	}

  	//validar os campos - em branco
  	if ( empty ( $nome_marca ) ) {
  		echo '<script>alert("Preencha o nome da Marca");history.back();</script>';
  		exit;
  	}
  	
  	//se o id estiver em branco - insert
  	//se o id estiver preenchido - update
  	if ( !empty ( $id )){
  		//atualizar os dados  	
  		$sql = "UPDATE marca SET DEFAULT VALUE ativo = '0' WHERE id = ? LIMIT 1";	
  		$consulta = $pdo->prepare($sql);
  		$consulta->bindParam(1, $ativo);
		$consulta->bindParam(2, $id);

    } else {
        $erro = $verificar->errorInfo();
        echo '<script>alert("Erro ao excluir!");history.back();</script>';
        exit;
       
    }
       
        echo "<script>location.href='listagem/marca';</script>";
    }