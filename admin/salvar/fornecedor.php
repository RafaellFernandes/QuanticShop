<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["quanticshop"]["id"] ) ){
    exit;
  }

   //mostrar erros
   ini_set('display_errors',1);
   ini_set('display_startup_erros',1);
   error_reporting(E_ALL);

  //verificar se existem dados no POST
  if ( $_POST ) {
    include "../admin/validacao/functions.php";
    include "../admin/config/conexao.php";

  	//recuperar os dados do formulario
  	$id = $nomeFantasia = $razaoSocial = $cnpj = $cep = $endereco = $cidade_id = $telefone = $cidade = $estado = $email = $inscricaoEstadual = 
      $celular = $bairro = $numero_resid = $ativo = "";
      
      //print_r($_POST);
      //print_r($_FILES);
      
  	foreach ($_POST as $key => $value) {
  		//guardar as variaveis
  		$$key = trim ( $value );
  		
  	}
    if( empty($nomeFantasia) ){
        echo "<script>alert('Preencha o Nome Fantasia!');history.back();</script>";
    } else if( empty($cnpj) ){
        echo "<script>alert('Preencha o Cnpj!');history.back();</script>";
    } else if( empty($email) ){
        echo "<script>alert('Preencha o email!');history.back();</script>";
    } else if( empty($endereco) ){
        echo "<script>alert('Preencha o Endereço!');history.back();</script>";
    } else if( empty($telefone) ){
        echo "<script>alert('Preencha o Telefone!');history.back();</script>";
    } 
      
      //iniciar uma transacao
    
    $pdo->beginTransaction();
    
      
      if(empty($id)){
          
          //inserir se o id estiver em branco
          $sql = "INSERT INTO fornecedor (nomeFantasia, razaoSocial, cnpj, inscricaoEstadual, telefone, celular, email, endereco, cep, cidade_id, cidade, estado, bairro, numero_resid, ativo) 
          VALUES(:nomeFantasia, :razaoSocial, :cnpj, :inscricaoEstadual, :telefone, :celular, :email, :endereco, :cep, :cidade_id, :cidade, :estado, :bairro, :numero_resid, :ativo)";
          $consulta = $pdo->prepare($sql);
          $consulta->bindParam(":nomeFantasia", $nomeFantasia);
          $consulta->bindParam(":razaoSocial", $razaoSocial);
          $consulta->bindParam(":cnpj", $cnpj);
          $consulta->bindParam(":inscricaoEstadual", $inscricaoEstadual);   
          $consulta->bindParam(":telefone", $telefone);
          $consulta->bindParam(":celular", $celular);   
          $consulta->bindParam(":email", $email);    
          $consulta->bindParam(":endereco", $endereco);  
          $consulta->bindParam(":cep", $cep);    
          $consulta->bindParam(":cidade_id", $cidade_id);
          $consulta->bindParam(":cidade", $cidade);
          $consulta->bindParam(":estado", $estado);
          $consulta->bindParam(":bairro", $bairro);
          $consulta->bindParam(":numero_resid", $numero_resid);
          $consulta->bindParam(":ativo", $ativo);
          
      } else {
          //update se o id estiver preenchido
          //qual arquivo sera gravado
                    
          $sql = "UPDATE fornecedor SET nomeFantasia = :nomeFantasia, razaoSocial = :razaoSocial, cnpj = :cnpj, telefone = :telefone, celular = :celular, email = :email, cep = :cep,
           endereco = :endereco, cidade_id = :cidade_id, cidade = :cidade, estado = :estado, bairro = :bairro, numero_resid = :numero_resid, ativo = :ativo WHERE id = :id ";
          $consulta = $pdo->prepare($sql);
          $consulta->bindParam(":nomeFantasia", $nomeFantasia);
          $consulta->bindParam(":razaoSocial", $razaoSocial);
          $consulta->bindParam(":cnpj", $cnpj);
          $consulta->bindParam(":inscricaoEstadual", $inscricaoEstadual);   
          $consulta->bindParam(":telefone", $telefone);
          $consulta->bindParam(":celular", $celular);   
          $consulta->bindParam(":email", $email);    
          $consulta->bindParam(":endereco", $endereco);  
          $consulta->bindParam(":cep", $cep);    
          $consulta->bindParam(":cidade_id", $cidade_id);
          $consulta->bindParam(":cidade", $cidade);
          $consulta->bindParam(":estado", $estado);
          $consulta->bindParam(":bairro", $bairro);
          $consulta->bindParam(":numero_resid", $numero_resid);
          $consulta->bindParam(":ativo", $ativo);
          $consulta->bindParam(":id",$id);
          
      }
  	//executar e verificar se deu certo
  	if ( $consulta->execute() ) {
        //salvar no banco
        $pdo->commit();
        echo '<script>alert("Fornecedor Salvo com Sucesso!");location.href="listagem/fornecedor";</script>';
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