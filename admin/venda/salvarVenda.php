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

    //include "../validacao/functions.php";
    include "../admin/validacao/functions.php";
    //include "../config/conexao.php";
    include "../admin/config/conexao.php";

   //recuperar os dados do formulario
   $id = $data= $cliente_id = $status =  "";

    	//inserir ou atualizar
        foreach ($_POST as $key => $value) {
            //guardar as variaveis
            $$key = trim ( $value );

        }
        if( empty($cliente_id) ){
            echo "<script>alert('Selecione o cliente!');history.back();</script>";
        } 
          
          //iniciar uma transacao
        
        $pdo->beginTransaction();
        
          
          if(empty($id)){

    		$sql = "insert venda values (:data, :status, :cliente_id)"; 		
    		$consulta = $pdo->prepare($sql);
    		$consulta->bindParam(":data", $data);
    		$consulta->bindParam(":status", $status);
    		$consulta->bindParam(":cliente _id", $cliente_id);
    		

    	} else {

    		$sql = "update venda set data = :data, status = :status, cliente_id = :cliente_id
    			where id = :id limit 1";
    		$consulta = $pdo->prepare($sql);
    		$consulta->bindParam(":data", $data);
    		$consulta->bindParam(":status", $status);
    		$consulta->bindParam(":cliente_id", $cliente_id);
    		$consulta->bindParam("id", $id);

    	}
         //executar e verificar se deu certo
	if ( $consulta->execute() ) {
		//gravar no banco 
		$pdo->commit();
		echo "<script>alert('Salvo com Sucesso!');location.href='venda/vendaProduto';</script>";
	}
	//erro ao gravar
	echo "<script>alert('Erro ao gravar no servidor');history.back();</script>";
	exit;
} else {
	echo '<script>alert("Erro ao salvar");history.back();</script>';
	exit;
}


    