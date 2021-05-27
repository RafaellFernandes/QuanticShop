<?php
function abrirBanco(){
    $conexao = new mysqli("localhost", "root", "", "quanticshop");
    return $conexao;

}

function selectAllMarca(){
    $banco = abrirBanco();
    $sql = "SELECT m.id mid, m.nome_marca, f.id fid, f.*, c.id cid, p.id pid, v.vezesVendido
            FROM item_compra c
            INNER JOIN produto p ON (p.id = c.produto_id)
            INNER JOIN fornecedor f ON (f.id = c.fornecedor_id)
            INNER JOIN marca m ON (m.id = p.marca_id)
            INNER JOIN item_venda v ON (v.produto_id = p.id)
            WHERE c.ativo = 1
            ORDER BY v.vezesVendido DESC";

    $resultado = $banco->query($sql);
    $banco->close();
    while ($row = mysqli_fetch_array($resultado)) {
        $grupo[] = $row;
    }
    return $grupo;
}

function selectAllPessoa(){
    $banco = abrirBanco();
    $sql = "SELECT * FROM cliente WHERE ativo = 1 ORDER BY id";
    $resultado = $banco->query($sql);
    $banco->close();
    while ($row = mysqli_fetch_array($resultado)) {
        $grupo[] = $row;
    }
    return $grupo;
}

function selectAllProdutoMaisVend(){
    $banco = abrirBanco();
    $sql = "SELECT p.id pid, p.ativo pativo, p.*, m.id mid, m.*, d.id did, d.*,v.id vid, v.vezesVendido, c.venda_unitaria  
    FROM produto p 
    INNER JOIN departamento d ON (d.id = p.departamento_id)
    INNER JOIN marca m ON (m.id = p.marca_id) 
    INNER JOIN item_venda v ON (v.produto_id = p.id) 
    INNER JOIN item_compra c ON (c.produto_id = p.id)
    WHERE p.ativo = 0
    ORDER BY v.vezesVendido DESC";

    $resultado = $banco->query($sql);
    $banco->close();
    while ($row = mysqli_fetch_array($resultado)) {
        $grupo[] = $row;
    }
    return $grupo;
}

function selectAllProdutoMenosVend(){
    $banco = abrirBanco();
    $sql = "SELECT p.id pid, p.ativo pativo, p.*, m.id mid, m.*, d.id did, d.*,v.id vid, v.vezesVendido, c.venda_unitaria  
    FROM produto p 
    INNER JOIN departamento d ON (d.id = p.departamento_id)
    INNER JOIN marca m ON (m.id = p.marca_id) 
    INNER JOIN item_venda v ON (v.produto_id = p.id) 
    INNER JOIN item_compra c ON (c.produto_id = p.id)
    WHERE p.ativo = 0
    ORDER BY v.vezesVendido ASC";

    $resultado = $banco->query($sql);
    $banco->close();
    while ($row = mysqli_fetch_array($resultado)) {
        $grupo[] = $row;
    }
    return $grupo;
}

function selectAllEstoque(){
    $banco = abrirBanco();
    $sql = "SELECT p.id pid, p.ativo pativo, p.*,e.id eid, e.*, c.id cid, c.ativo cativo, date_format(c.data_cadastro, '%d/%m/%Y') dataCadastro, c.*, v.vezesVendido 
    FROM produto p 
    INNER JOIN estoque e ON (p.id = e.produto_id) 
    INNER JOIN item_compra c ON (p.id = c.produto_id) 
    INNER JOIN item_venda v ON (v.produto_id = p.id) 
    WHERE c.ativo = 1
    ORDER BY p.id";

    $resultado = $banco->query($sql);
    $banco->close();

    while ($row = mysqli_fetch_array($resultado)) {
        $grupo[] = $row;
    }
    return $grupo;
}

function nomePessoa(){
    session_start();
    $nome = $_SESSION['quanticshop']['primeiro_nome'] ." ". $_SESSION['quanticshop']['sobrenome'];
    return $nome;
}

function dataEmissao(){

    date_default_timezone_set('America/Sao_Paulo');
    $data = date('d/m/Y H:i:s');
    return $data;
}