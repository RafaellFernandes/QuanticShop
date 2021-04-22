
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

    //recuperar variaveis
    $id = $qtd_produto = $valor = $data_atualizacao = $estoque_minimo = $produto_id =  "";

   
    
    foreach ($_POST as $key => $value){
        $$key = trim($value);
    }

    //validar os campos - em branco
    if( empty($qtd_produto) ){
        echo "<script>alert('Digite a Quantidade de Produtos em Estoque!');history.back();</script>";
    } else if( empty($valor) ){
        echo "<script>alert('Digite o Valor do Produto!');history.back();</script>";
    }  else if( empty($data_atualizacao) ){
        echo "<script>alert('Digite a Data de Atualização do Produto!');history.back();</script>";
    } else if( empty($estoque_minimo) ){
        echo "<script>alert('Digite a Quantidade de Estoque Minimo!');history.back();</script>";
    } else if( empty($produto_id) ){
        echo "<script>alert('Preencha o ID do Produto, Selecione-o!');history.back();</script>";
    } 
    
    //iniciar uma transacao
    
    $pdo->beginTransaction();
    
    $valor = formatarValor($valor);
    
    if(empty($id)){
        //inserir
        $sql= "INSERT INTO estoque(qtd_produto, valor, data_atualizacao, estoque_minimo, produto_id) 
        values(:qtd_produto, :valor, :data_atualizacao, :estoque_minimo, :produto_id)";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":qtd_produto",$qtd_produto);
        $consulta->bindParam(":valor",$valor);
        $consulta->bindParam(":data_atualizacao",$data_atualizacao);
        $consulta->bindParam(":estoque_minimo",$estoque_minimo);
        $consulta->bindParam(":produto_id",$produto_id);
        
    } else{
       
        //update
        $sql= "UPDATE estoque SET qtd_produto = :qtd_produto, valor = :valor, data_atualizacao = :data_atualizacao, estoque_minimo = :estoque_minimo,
        produto_id = :produto_id WHERE id = :id";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":qtd_produto",$qtd_produto);
        $consulta->bindParam(":valor",$valor);
        $consulta->bindParam(":data_atualizacao",$data_atualizacao);
        $consulta->bindParam(":estoque_minimo",$estoque_minimo);
        $consulta->bindParam(":produto_id",$produto_id);
        $consulta->bindParam(":id",$id);
    }
    
    //executar e verificar se deu certo
  	if ( $consulta->execute() ) {
        $pdo->commit(); 
        echo '<script>alert("Registro Salvo");location.href="listagem/produto";</script>';
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