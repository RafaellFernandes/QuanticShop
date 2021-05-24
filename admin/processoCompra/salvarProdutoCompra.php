<?php 
if (!isset($_SESSION["quanticshop"]["id"])) {
    $titulo = "Erro";
    $mensagem = "Usuário Não Logado";
    $icone = "error";
    mensagem($titulo, $mensagem, $icone);
exit;
}

if ($_SESSION["quanticshop"]["nivelAcesso"] != "admin") {
    $titulo = "Erro";
    $mensagem = "Erro na Requisição da Página";
    $icone = "error";
    mensagem($titulo, $mensagem, $icone);
exit;
}

//mostrar erros
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

//verificar se existem dados no POST
if ( $_POST ) {

    include "validacao/functions.php";
    include "config/conexao.php";

    //recuperar dados do formulario
    $id = $produto_id = $nome_produto = $lote = $fornecedor_id = $razaoSocial = $data_cadastro = $ativo = $qtd_produto =  "";

    foreach ($_POST as $key => $value) {
        $$key = trim ( $value );

    }
    //verificar se as variaveis estao vazias
     if( empty($produto_id) ){
        echo "<script>alert('Selecione um produto!');history.back();</script>";
    } else if( empty($data_cadastro) ){
        echo "<script>alert('Preencha a data!');history.back();</script>";
    } else if( empty($fornecedor_id) ){
        echo "<script>alert('Preencha o fornecedor!');history.back();</script>";
    } else if( empty($lote) ){
        echo "<script>alert('Preencha o lote');history.back();</script>";
    } else if( empty($qtd_produto) ){
        echo "<script>alert('Preencha a quantida de produtos');history.back();</script>";    

    }    

    //iniciar uma transacao
    $pdo->beginTransaction();

    if(empty($id)){

        $sql = "INSERT INTO item_compra( data_cadastro, lote, fornecedor_id, produto_id, qtd_produto, ativo)
        VALUES (:data_cadastro, :lote, :fornecedor_id, :produto_id, :qtd_produto, :ativo)";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':data_cadastro', $data_cadastro);
        $consulta->bindParam(':lote', $lote);
        $consulta->bindParam(':fornecedor_id', $fornecedor_id);
        $consulta->bindParam(':produto_id', $produto_id);
        $consulta->bindParam(':qtd_produto', $qtd_produto);
        $consulta->bindParam(':ativo', $ativo);
  
    } else { 
    
        $sql = "UPDATE item_compra SET data_cadastro = :data_cadastro, lote = :lote, 
        fornecedor_id = :fornecedor_id, produto_id = :produto_id, qtd_produto = :qtd_produto, ativo = :ativo WHERE id = :id ";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':data_cadastro', $data_cadastro);
        $consulta->bindParam(':lote', $lote);
        $consulta->bindParam(':fornecedor_id', $fornecedor_id);
        $consulta->bindParam(':produto_id', $produto_id);
        $consulta->bindParam(':qtd_produto', $qtd_produto);
        $consulta->bindParam(':ativo', $ativo);
        $consulta->bindParam(":id", $id);
    }

    if ( $consulta->execute() ) {
        $pdo->commit();
        $titulo = "Sucesso";
        $mensagem = "Produto Salvo";
        $icone = "success";
        mensagem($titulo, $mensagem, $icone);
        exit;

    } else {
        $titulo = "Erro";
        $mensagem = "Erro ao Salvar";
        $icone = "error";
        mensagem($titulo, $mensagem, $icone);
        exit;
    }

} else {
    $titulo = "Erro";
    $mensagem = "Erro ao realizar requisição";
    $icone = "error";
    mensagem($titulo, $mensagem, $icone);
    exit;
}

