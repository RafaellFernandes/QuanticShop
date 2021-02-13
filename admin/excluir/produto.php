<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["bancotcc"]["id"] ) ){
    exit;
  }

  //se nao existe o id
  if ( !isset ( $id ) )     {
    echo '<script>alert("Erro ao realizar requisição");history.back();</script>';
    exit;
  }

  	//verificar se existe vinculo com produto
    $sql = "SELECT * FROM produto WHERE id = ? LIMIT 1";
  	$consulta = $pdo->prepare($sql);
  	$consulta->bindParam(1, $id); 
  	$consulta->execute();
    $dados = $consulta->fetch(PDO::FETCH_OBJ);
    
    if (!empty($dados->$id)) {
      echo '<script>alert("Não é possível excluir este registro");history.back();</script>';
      exit;
    }

   //excluir produto
    $sql = "DELETE FROM produto WHERE id = :id LIMIT 1";
    $verificar = $pdo->prepare($sql);
    $verificar->bindParam(':id', $id);
    //verificar se executou
    if (!$verificar->execute()) {
      $erro = $verificar->errorInfo();

      //echo '<script>alert("Erro ao excluir!");history.back();</script>';
      exit;
    }

    echo "<script>location.href='listar/produto';</script>";

?>