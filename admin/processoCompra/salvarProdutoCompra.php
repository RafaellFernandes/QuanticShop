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
if ( $_POST ) {

    include "../admin/validacao/functions.php";
    include "../admin/config/conexao.php";

    //recuperar dados do formulario
    $id = $produto_id = $fornecedor_id = $lote = $valor_unitario = $data_cadastro = $qtd_produto = "";

    foreach ($_POST as $key => $value) {
        $$key = trim ( $value );

    }
    //verificar se as variaveis estao vazias
     if( empty($produto_id) ){
        echo "<script>alert('Preencha o nome do produto!');history.back();</script>";
    }else if( empty($qtd_produto) ){
        echo "<script>alert('Preencha a Quantidade de produtos!');history.back();</script>";
    } else if( empty($valor_unitario) ){
        echo "<script>alert('Preencha o Valor!');history.back();</script>";
    } else if( empty($data_cadastro) ){
        echo "<script>alert('Preencha a data!');history.back();</script>";
    } else if( empty($fornecedor_id) ){
        echo "<script>alert('Preencha o estoque minimo!');history.back();</script>";
    } else if( empty($lote) ){
        echo "<script>alert('Preencha o lote');history.back();</script>";

    }    

    //iniciar uma transacao
    $pdo->beginTransaction();

    $valor_unitario = formatarValor($valor_unitario);

    if(empty($id)){

        $sql = "INSERT INTO item_compra(qtd_produto, valor_unitario, data_cadastro, lote, fornecedor_id, produto_id)
        VALUES (:qtd_produto, :valor_unitario, :data_cadastro, :lote, :fornecedor_id, :produto_id)";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':qtd_produto', $qtd_produto);
        $consulta->bindParam(':valor_unitario', $valor_unitario);
        $consulta->bindParam(':data_cadastro', $data_cadastro);
        $consulta->bindParam(':lote', $lote);
        $consulta->bindParam(':fornecedor_id', $fornecedor_id);
        $consulta->bindParam(':produto_id', $produto_id);
       
    } else { 
    
        $sql = "UPDATE item_compra SET qtd_produto = :qtd_produto, valor_unitario = :valor_unitario, data_cadastro = :data_cadastro, lote = :lote, fornecedor_id = :fornecedor_id, produto_id = :produto_id WHERE id = :id ";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':qtd_produto', $qtd_produto);
        $consulta->bindParam(':valor_unitario', $valor_unitario);
        $consulta->bindParam(':data_cadastro', $data_cadastro);
        $consulta->bindParam(':lote', $lote);
        $consulta->bindParam(':fornecedor_id', $fornecedor_id);
        $consulta->bindParam(':produto_id', $produto_id);
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
    }

