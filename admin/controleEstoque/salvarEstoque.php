<?php 

//verificar se não está logado 
if ( !isset ( $_SESSION["quanticshop"]["id"] ) ){
    exit;
}

//mostrar erros
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

//verificar se existem dados no POST
if ( $POST ) {

    include "../admin/validacao/functions.php";
    include "../admin/config/conexao.php";

    //recuperar dados do formulario
    $id = $qtd_produto = $valor = $data_atualizacao = $estoque_minimo = $produto_id = "";

    foreach ($_POST as $key => $value) {
        $$key = trim ( $value );

    }

    //verificar se as variaveis estao vazias
    if( empty($qtd_produto) ){
        echo "<script>alert('Preencha a Quantidade de produtos!');history.back();</script>";
    } else if( empty($valor) ){
        echo "<script>alert('Preencha o Valor!');history.back();</script>";
    } else if( empty($data_atualizacao) ){
        echo "<script>alert('Preencha a data!');history.back();</script>";
    } else if( empty($estoque_minimo) ){
        echo "<script>alert('Preencha o estoque minimo!');history.back();</script>";
    } else if( empty($produto_id) ){
        echo "<script>alert('Selecione o produto!');history.back();</script>";
    }

    //iniciar uma transacao
    $pdo->beginTransaction();

    $valor = formatarValor($valor);

    if(empty($id)){

        $sql = "INSERT INTO estoque(qtd_produto, valor, data_atualizacao, estoque_minimo, produto_id)
        VALUES (:qtd_produto, :valor, :data_atualizacao, :estoque_minimo, :produto_id) ";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":qtd_produto", $qtd_produto);
        $consulta->bindParam(":valor", $valor);
        $consulta->bindParam(":data_atualizacao", $data_atualizacao);
        $consulta->bindParam(":estoque_minimo", $estoque_minimo);
        $consulta->bindParam(":produto_id", $produto_id);
        
        } 
    
        $sql = "UPDATE estoque SET qtd_produto = :qtd_produto, valor = :valor, data_atualizacao = :data_atualizacao, estoque_minimo = :estoque_minimo, produto_id = :produto_id WHERE id = :id ";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":qtd_produto", $qtd_produto);
        $consulta->bindParam(":valor", $valor);
        $consulta->bindParam(":data_atualizacao", $data_atualizacao);
        $consulta->bindParam(":estoque_minimo", $estoque_minimo);
        $consulta->bindParam(":produto_id", $produto_id);
        $consulta->bindParam(":id", $id);
    }

//executar e verificar se deu certo
   if ( $consulta->execute() ) {
      $pdo->commit();
      echo "<script>alert('Salvo com sucesso!');location.href='listar/produto';</script>";
   } else {
    echo "<script>alert('Erro ao Salvar!');history.back();</script>";
    exit;
}

