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

	include "../admin/validacao/functions.php";
    include "../admin/config/conexao.php";
	
  	//recuperar os dados do formulario
  	$produto_id = $qtd_estoque = "";

  	foreach ($_POST as $key => $value) {
  		//guardar as variaveis
  		$$key = trim ( $value );
  	}

  	//validar os campos - em branco
  	if ( empty ( $produto_id ) ) {
  		echo '<script>alert("Selecione um Produto);history.back();</script>';
    } else if( empty($qtd_estoque) ){
        echo "<script>alert('Preencha a quantidade em estoque');history.back();</script>";
  		exit;
  	}


	//iniciar uma transacao
	$pdo->beginTransaction();

  	//se o id estiver preenchido - update
  	if ( empty ( $id ) ) {
		//verifica se produto já esta cadastrado no estoque 
		$sql = "SELECT produto_id from estoque";
		$consulta = $pdo->prepare($sql);
		$consulta->execute();	
		while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ){
			if($produto_id == $dados->produto_id) {
				mensagem("Erro", "Já existe esse produto cadastrado em um estoque", "error");
				// echo "<script>window.alert('Já existe esse produto cadastrado em um estoque');window.history.back();</script>";
				exit;
			}
		}	
  		//inserir os dados no banco
  		$sql = "INSERT INTO estoque (produto_id, qtd_estoque) VALUES (:produto_id, :qtd_estoque)";
  		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(":produto_id", $produto_id);
        $consulta->bindParam(":qtd_estoque", $qtd_estoque);

  	} else {

  		//atualizar os dados  	
  		$sql = "UPDATE estoque SET produto_id = :produto_id, qtd_estoque = :qtd_estoque WHERE id = :id";	
  		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(":produto_id", $produto_id);
		$consulta->bindParam(":qtd_estoque", $qtd_estoque);
  		$consulta->bindParam(":id", $id);
  	}
    //executar e verificar se deu certo
	if ( $consulta->execute() ) {
		//gravar no banco 
		$pdo->commit();
		echo "<script>alert('Produto Salvo em Estoque!');location.href='controleEstoque/ListaEstoque';</script>";
	}
	//erro ao gravar
	echo "<script>alert('Erro ao gravar no servidor');history.back();</script>";
	exit;
} else {
	echo '<script>alert("Erro ao salvar");history.back();</script>';
	exit;
}
