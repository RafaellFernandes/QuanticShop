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

   //verificar se existe um departamento cadastrado 
   $sql = "SELECT id FROM departamento WHERE NomeDept = ? LIMIT 1";
   //prepare sql para executar
   $consulta = $pdo->prepare($sql);
   //passar o id do parametro
   $consulta->bindParam(1, $id);
   //executar o sql
   $consulta->execute();
   //recuperar os dados selecionado
   $dados = $consulta->fetch(PDO::FETCH_OBJ);

   //excluir Departamento
  $sql = "DELETE FROM departamento  WHERE id = ? LIMIT 1";
  $consulta = $pdo->prepare($sql);
  $consulta->bindParam(1, $id);
  //verificar se não executou
  if ( $consulta->execute() ) {

  	//capturar os erros e mostra a mensagem na tela
  	echo $consulta->errorInfo()[2];

  	echo "<script>alert('O Departamento excluido com sucesso!');javascript:history.back();</script>";
  	exit;
  }

//redirecionar para a listagem de departamentos
echo "<script>location.href='listar/departamento';</script>";
