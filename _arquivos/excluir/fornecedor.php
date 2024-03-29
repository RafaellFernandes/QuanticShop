<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["quanticshop"]["id"] ) ){
    exit;
  }

  //se nao existe o id
  if ( !isset ( $id ) )     {
    echo '<script>alert("Erro ao realizar requisição");history.back();</script>';
    exit;
  }

   //excluir editora
    $sql = "DELETE FROM fornecedor WHERE id = :id LIMIT 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":id", $id);
    //verificar se executou
    if ( $consulta->execute() ) {

        //capturar os erros e mostra a mensagem na tela
        echo $consulta->errorInfo()[2];
  
        echo "<script>alert('fornecedor excluido com sucesso!');javascript:history.back();</script>";
        exit;
    }
    echo "<script>location.href='listar/fornecedor';</script>";
    
?>