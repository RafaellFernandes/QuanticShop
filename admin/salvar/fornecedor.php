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

   //mostrar erros
   ini_set('display_errors',1);
   ini_set('display_startup_erros',1);
   error_reporting(E_ALL);

  //verificar se existem dados no POST
  if ( $_POST ) {

    include "validacao/functions.php";
    include "config/conexao.php";

  	//recuperar os dados do formulario
  	$id = $nomeFantasia = $razaoSocial = $cnpj = $cep = $endereco = $cidade_id = $telefone = $cidade = $estado = $email = $inscricaoEstadual = 
      $celular = $bairro = $numero_resid = $ativo = $complemento = $siteFornecedor = "";
      
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
          $sql = "INSERT INTO fornecedor (nomeFantasia, razaoSocial, cnpj, inscricaoEstadual, telefone, celular, email, endereco, cep, cidade_id, cidade, estado, bairro, numero_resid, ativo, complemento, siteFornecedor) 
          VALUES(:nomeFantasia, :razaoSocial, :cnpj, :inscricaoEstadual, :telefone, :celular, :email, :endereco, :cep, :cidade_id, :cidade, :estado, :bairro, :numero_resid, :ativo, :complemento, :siteFornecedor)";
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
          $consulta->bindParam(":complemento", $complemento);
          $consulta->bindParam(":siteFornecedor", $siteFornecedor);
          
      } else {
          //update se o id estiver preenchido
          //qual arquivo sera gravado
                    
          $sql = "UPDATE fornecedor SET nomeFantasia = :nomeFantasia, razaoSocial = :razaoSocial, cnpj = :cnpj, telefone = :telefone, celular = :celular, email = :email, cep = :cep,
           endereco = :endereco, cidade_id = :cidade_id, cidade = :cidade, estado = :estado, bairro = :bairro, numero_resid = :numero_resid, ativo = :ativo, complemento = :complemento, siteFornecedor = :siteFornecedor WHERE id = :id ";
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
          $consulta->bindParam(":complemento", $complemento);
          $consulta->bindParam(":siteFornecedor", $siteFornecedor);
          $consulta->bindParam(":id",$id);
          
      }
  	//executar e verificar se deu certo
  	if ( $consulta->execute() ) {
        //salvar no banco
        $pdo->commit();
        $titulo = "Sucesso";
		$mensagem = "Fornecedor Salvo!";
		$icone = "success";
		mensagem($titulo, $mensagem, $icone);
        echo '<script>location.href="listagem/fornecedor";</script>';
    } else {
        $titulo = "Erro";
		$mensagem = "Erro ao Salvar";
		$icone = "error";
		mensagem($titulo, $mensagem, $icone);
        echo '<script>history.back();</script>';
        exit;
    }

} else {
    //mensagem de erro
    //javascript - mensagem alert
    //retornar history.back
    $titulo = "Erro";
	$mensagem = "Erro ao Realizar Requisição";
	$icone = "error";
	mensagem($titulo, $mensagem, $icone);
    echo '<script>history.back();</script>';
}