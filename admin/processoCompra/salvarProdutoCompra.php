<?php 

//verificar se não está logado 
// if ( !isset ( $_SESSION["quanticshop"]["id"] ) ){
//     exit;
// }
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

    include "../admin/validacao/functions.php";
    include "../admin/config/conexao.php";

    //recuperar dados do formulario
    $id = $produto_id = $fornecedor_id = $lote = $custo_unitario = $porcentagem_lucro = $venda_unitaria = $data_cadastro = $qtd_produto = "";

    foreach ($_POST as $key => $value) {
        $$key = trim ( $value );

    }
    //verificar se as variaveis estao vazias
     if( empty($produto_id) ){
        echo "<script>alert('Selecione um produto!');history.back();</script>";
    } else if( empty($custo_unitario) ){
        echo "<script>alert('Preencha o Valor!');history.back();</script>";
    } else if( empty($venda_unitaria) ){
        echo "<script>alert('Preencha o Valor!');history.back();</script>";
    } else if( empty($porcentagem_lucro) ){
        echo "<script>alert('Preencha o Valor!');history.back();</script>";
    } else if( empty($data_cadastro) ){
        echo "<script>alert('Preencha a data!');history.back();</script>";
    } else if( empty($fornecedor_id) ){
        echo "<script>alert('Preencha o fornecedor!');history.back();</script>";
    } else if( empty($lote) ){
        echo "<script>alert('Preencha o lote');history.back();</script>";
    } else if( empty($qtd_produto) ){
        echo "<script>alert('Preencha o lote');history.back();</script>";    

    }    

    //iniciar uma transacao
    $pdo->beginTransaction();

    $custo_unitario = formatarValor($custo_unitario);
    $venda_unitaria = formatarValor($venda_unitaria);


   

    if(empty($id)){

        $sql = "INSERT INTO item_compra(custo_unitario, data_cadastro, lote, fornecedor_id, produto_id, venda_unitaria, porcentagem_lucro, qtd_produto)
        VALUES (:custo_unitario, :data_cadastro, :lote, :fornecedor_id, :produto_id, :venda_unitaria, :porcentagem_lucro, :qtd_produto)";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':custo_unitario', $custo_unitario);
        $consulta->bindParam(':data_cadastro', $data_cadastro);
        $consulta->bindParam(':lote', $lote);
        $consulta->bindParam(':fornecedor_id', $fornecedor_id);
        $consulta->bindParam(':produto_id', $produto_id);
        $consulta->bindParam(':venda_unitaria', $venda_unitaria);
        $consulta->bindParam(':porcentagem_lucro', $porcentagem_lucro);
        $consulta->bindParam(':qtd_produto', $qtd_produto);


  
    } else { 
    
        $sql = "UPDATE item_compra SET custo_unitario = :custo_unitario, data_cadastro = :data_cadastro, lote = :lote, 
        fornecedor_id = :fornecedor_id, produto_id = :produto_id, venda_unitaria = :venda_unitaria, porcentagem_lucro = :porcentagem_lucro, qtd_produto = :qtd_produto WHERE id = :id ";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':custo_unitario', $custo_unitario);
        $consulta->bindParam(':data_cadastro', $data_cadastro);
        $consulta->bindParam(':lote', $lote);
        $consulta->bindParam(':fornecedor_id', $fornecedor_id);
        $consulta->bindParam(':produto_id', $produto_id);
        $consulta->bindParam(':venda_unitaria', $venda_unitaria);
        $consulta->bindParam(':porcentagem_lucro', $porcentagem_lucro);
        $consulta->bindParam(':qtd_produto', $qtd_produto);
        $consulta->bindParam(":id", $id);
    }

    if ( $consulta->execute() ) {
        $pdo->commit();
        echo '<script>alert("Produto Salvo com Sucesso");location.href="processoCompra/listaProduto";</script>';
    } else {
        echo '<script>alert("Erro ao salvar");history.back();</script>';
        exit;
    }

} else {
    //mensagem de erro
    //javascript - mensagem alert
    //retornar hostory.back
    echo '<script>alert("Erro ao realizar requisição");history.back();</script>';
}

