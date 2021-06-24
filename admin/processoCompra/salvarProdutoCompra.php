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
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

//verificar se existem dados no POST
if ( $_POST ) {

    include "validacao/functions.php";
    include "config/conexao.php";

    //recuperar dados do formulario
    $id = $produto_id = $nome_produto = $lote = $fornecedor_id = $razaoSocial = $data_cadastro = $ativo = $qtdprodutoComprado = $venda_unitaria = $custo_unitario = $porcentagem_lucro = "";

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
    } else if( empty($qtdprodutoComprado) ){
        echo "<script>alert('Preencha a quantida de produtos');history.back();</script>";    
    }    

    //iniciar uma transacao
    $pdo->beginTransaction();

    $venda_unitaria = formatarValor($venda_unitaria);
    $custo_unitario = formatarValor($custo_unitario);

    if(empty($id)){

        $sql = "INSERT INTO item_compra( data_cadastro, lote, fornecedor_id, produto_id, qtdprodutoComprado, ativo, venda_unitaria, custo_unitario, porcentagem_lucro)
        VALUES (:data_cadastro, :lote, :fornecedor_id, :produto_id, :qtdprodutoComprado, :ativo, :venda_unitaria, :custo_unitario, :porcentagem_lucro)";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':data_cadastro', $data_cadastro);
        $consulta->bindParam(':lote', $lote);
        $consulta->bindParam(':fornecedor_id', $fornecedor_id);
        $consulta->bindParam(':produto_id', $produto_id);
        $consulta->bindParam(':qtdprodutoComprado', $qtdprodutoComprado);
        $consulta->bindParam(':ativo', $ativo);
        $consulta->bindParam(':venda_unitaria', $venda_unitaria);
        $consulta->bindParam(':custo_unitario', $custo_unitario);
        $consulta->bindParam(':porcentagem_lucro', $porcentagem_lucro);
        
        //SQL que vai pega o id do produto e dar um update nele se o ativo for 1
        if($ativo = 1){
            $sqlProduto = "UPDATE produto set ativo = 1, valorUnitario = $venda_unitaria WHERE id = $produto_id";
            $ativaProduto = $pdo->prepare($sqlProduto);
            $ativaProduto->execute();

        }

    } else { 
    
        $sql = "UPDATE item_compra SET data_cadastro = :data_cadastro, lote = :lote, 
        fornecedor_id = :fornecedor_id, produto_id = :produto_id, qtdprodutoComprado= :qtdprodutoComprado, ativo = :ativo, venda_unitaria = :venda_unitaria, custo_unitario = :custo_unitario WHERE id = :id ";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':data_cadastro', $data_cadastro);
        $consulta->bindParam(':lote', $lote);
        $consulta->bindParam(':fornecedor_id', $fornecedor_id);
        $consulta->bindParam(':produto_id', $produto_id);
        $consulta->bindParam(':qtdprodutoComprado', $qtdprodutoComprado);
        $consulta->bindParam(':ativo', $ativo);
        $consulta->bindParam(':venda_unitaria', $venda_unitaria);
        $consulta->bindParam(':custo_unitario', $custo_unitario);
        $consulta->bindParam(":id", $id);

        //ativa o produto no banco
        if($ativo = 0){
            $sqlProduto = "UPDATE produto set ativo = 1, valorUnitario = $venda_unitaria WHERE id = $produto_id";
            $ativaProduto - $pdo->prepare($sqlProduto);
            $ativaProduto->execute();
        }
    }

    if ( $consulta->execute() ) {
        $pdo->commit();
        $titulo = "Sucesso";
        $mensagem = "Produto Salvo";
        $icone = "success";
        mensagem($titulo, $mensagem, $icone);
        exit;


        if ( $ativaProduto->execute() ) {
            $pdo->commit();
            $titulo = "Sucesso";
            $mensagem = "Produto Ativo";
            $icone = "success";
            mensagem($titulo, $mensagem, $icone);
            exit;   
        }

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

