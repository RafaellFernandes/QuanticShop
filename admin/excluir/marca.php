<?php
//verificar se nao esta logado
if ( !isset ( $_SESSION["bancotcc"]["id"] ) ) {
    exit;
}

//se nao existe o id
if ( !isset ($id) ) {
    echo '<script>alert("Erro ao Realizar Requisição");history.back();</script>';
    exit;
}

//verificar se existe algum vinculo com produto
$sql = "SELECT * FROM produto WHERE Marca_id = ? LIMIT 1";
$consulta = $pdo->prepare($sql);
$consulta->bindParam(1, $id);
$consulta->execute();
$dados = $consulta->fetch(PDO::FETCH_OBJ);

if (!empty($dados->$id)) {
    echo '<script>alert("Não é possível excluir este registro, Pois existe um Produto relacionado com esta Marca.");history.back();</script>';
    exit;
}

//excluir a marca
$sql = "DELETE FROM marca WHERE id = ? LIMIT 1";
$verificar = $pdo->prepare($sql);
$verificar->bindParam(1, $id);
//verificar se executou
if (!$verificar->execute()) {
    $erro = $verificar->errorInfo();
    echo '<script>alert("Erro ao excluir!");history.back();</script>';
    exit;
}

echo "<script>location.href='listar/marca';</script>";

?>