<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["bancotcc"]["id"] ) ){
    exit;
  }

  //verificar se existem dados no POST
  if ( $_POST ) {
    include "validacao/functions.php";
    include "config/conexao.php";
  	//recuperar os dados do formulario
  	$id = $Nome = $cnpj = $cep = $endereco = $Cidade_id =  $Telefone = $nome_cidade = $estado = "";
      
      //print_r($_POST);
      //print_r($_FILES);
      
  	foreach ($_POST as $key => $value) {
  		//guardar as variaveis
  		$$key = trim ( $value );
  		
  	}
    if( empty($Nome) ){
        echo "<script>alert('Preencha o Nome');history.back();</script>";
    } else if( empty($cnpj) ){
        echo "<script>alert('Preencha o Cnpj');history.back();</script>";
    } else if( empty($email) ){
        echo "<script>alert('Preencha o email');history.back();</script>";
    } else if( empty($endereco) ){
        echo "<script>alert('Preencha o Endereço');history.back();</script>";
    } else if( empty($Telefone) ){
        echo "<script>alert('Preencha o Telefone');history.back();</script>";
    } 
      
      //iniciar uma transacao
    
    $pdo->beginTransaction();
    
      
      if(empty($id)){
          
          //inserir se o id estiver em branco
          $sql = "INSERT INTO fornecedor (Nome, cnpj, Telefone, email, endereco, cep, Cidade_id, nome_cidade, estado) 
          VALUES(:Nome, :cnpj, :Telefone, :email, :endereco, :cep, :Cidade_id, :nome_cidade, :estado)";
          $consulta = $pdo->prepare($sql);
          $consulta->bindParam(":Nome", $Nome);
          $consulta->bindParam(":cnpj", $cnpj);
          $consulta->bindParam(":Telefone", $Telefone);   
          $consulta->bindParam(":email", $email);
          $consulta->bindParam(":endereco", $endereco);   
          $consulta->bindParam(":cep", $cep);    
          $consulta->bindParam(":Cidade_id", $Cidade_id);  
          $consulta->bindParam(":nome_cidade", $nome_cidade);    
          $consulta->bindParam(":estado", $estado);
          
      } else{
          //update se o id estiver preenchido
          //qual arquivo sera gravado
                    
          $sql = "UPDATE fornecedor SET Nome = :Nome, cnpj = :cnpj, Telefone = :Telefone, email = :email, cep = :cep,
           endereco = :endereco, Cidade_id = :Cidade_id, nome_cidade = :nome_cidade, estado = :estado WHERE id = :id ";
          $consulta = $pdo->prepare($sql);
          $consulta->bindParam(":Nome", $Nome);
          $consulta->bindParam(":cnpj", $cnpj);
          $consulta->bindParam(":Telefone", $Telefone);   
          $consulta->bindParam(":email", $email);
          $consulta->bindParam(":endereco", $endereco);   
          $consulta->bindParam(":cep", $cep);    
          $consulta->bindParam(":Cidade_id", $Cidade_id); 
          $consulta->bindParam(":nome_cidade", $nome_cidade);    
          $consulta->bindParam(":estado", $estado);
          $consulta->bindParam(":id",$id);
          
      }
  	//executar e verificar se deu certo
  	if ( $consulta->execute() ) {
        //salvar no banco
        $pdo->commit();
        echo '<script>alert("Fornecedor Salvo com Sucesso!");location.href="listar/fornecedor";</script>';
    } else {
        echo '<script>alert("Erro ao salvar");history.back();</script>';
        exit;
    }

} else {
    //mensagem de erro
    //javascript - mensagem alert
    //retornar history.back
    echo '<script>alert("Erro ao realizar requisição");history.back();</script>';
}