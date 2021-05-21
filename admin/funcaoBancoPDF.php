<?php

function abrirBanco(){
    $conexao = new mysqli("localhost", "root", "", "quanticshop");
    return $conexao;
}

function selectAllPessoa(){
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