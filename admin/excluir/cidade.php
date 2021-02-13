<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["bancotcc"]["id"] ) ){
    exit;
  }

  //verificar se o id esta vazio
  if ( empty ( $id ) ) {
  	echo "<script>alert('Não foi possível excluir o registro');history.back();</script>";
  	exit;
  }

  //verificar se existe um cliente cadastrado com esta cidade 
  $sql = "SELECT id FROM cliente WHERE cidade_id = ? LIMIT 1";
  //prepare sql para executar
  $consulta = $pdo->prepare($sql);
  //passar o id do parametro
  $consulta->bindParam(1, $id);
  //executar o sql
  $consulta->execute();
  //recuperar os dados selecionado
  $dados = $consulta->fetch(PDO::FETCH_OBJ);
  
  //excluir cidade
  $sql = "DELETE FROM cidade WHERE id = ? LIMIT 1";
  $consulta = $pdo->prepare($sql);
  $consulta->bindParam(1, $id);
  //verificar se não executou
  if ( $consulta->execute() ) {

  	//capturar os erros e mostra a mensagem na tela
  	echo $consulta->errorInfo()[2];

  	echo "<script>alert('Cidade excluida com sucesso!');javascript:history.back();</script>";
  	exit;
  }
  // se existir avisar e voltar
  if ( !empty ( $dados->id ) ) {
      //se o id nao esta vazio, nao posso excluir
       echo "<script>alert('Não é possivel excluir este registro, pois existe uma cidade relacionada a um cliente');history.back();</script>";
       exit;
  
  }
//***************************** */
  //redirecionar para a listagem de editoras
  echo "<script>location.href='listar/cidade';</script>";
