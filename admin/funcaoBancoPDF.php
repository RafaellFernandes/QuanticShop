<?php
function abrirBanco(){
    $conexao = new mysqli("localhost", "root", "", "quanticshop");
    return $conexao;

}

function selectAllMarca(){
    $banco = abrirBanco();
    $sql = "SELECT ic.id icid, ic.status icstatus, ic.*,
                m.id mid, m.*, 
                f.id fid, f.*, 
                p.id pid, p.ativo pativo, p.*  
            FROM item_compra ic
            INNER JOIN produto p ON (p.id = ic.produto_id)
            INNER JOIN fornecedor f ON (f.id = ic.fornecedor_id)
            INNER JOIN marca m ON (m.id = p.marca_id)
            WHERE ic.status = 1
            ORDER BY p.vezesVendido DESC";

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
    $sql = "SELECT p.id pid, p.ativo pativo, p.*, m.id mid, m.*, d.id did, d.*  
            FROM produto p 
            INNER JOIN departamento d ON (d.id = p.departamento_id)
            INNER JOIN marca m ON (m.id = p.marca_id)
            WHERE p.ativo = 1
            ORDER BY p.vezesVendido ASC ";

    $resultado = $banco->query($sql);
    $banco->close();
    while ($row = mysqli_fetch_array($resultado)) {
        $grupo[] = $row;
    }
    return $grupo;
}

function selectAllProdutoMenosVend(){
    $banco = abrirBanco();
    $sql = "SELECT p.id pid, p.ativo pativo, p.*, m.id mid, m.*, d.id did, d.*  
            FROM produto p 
            INNER JOIN departamento d ON (d.id = p.departamento_id)
            INNER JOIN marca m ON (m.id = p.marca_id)
            WHERE p.ativo = 1
            ORDER BY p.vezesVendido DESC ";

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