<?php

/*//verificar se não está logado
if ( !isset ( $_SESSION["bancotcc"]["id"] ) ){
    exit;
}
*/
$cidade = $_GET["cidade"] ?? "";
$estado = $_GET["estado"] ?? "";

if ( (empty($cidade) ) or (empty($estado) ) ){
    echo "Erro";
    exit;
}
    
    
include "config/conexao.php";

$sql = "SELECT id FROM cidade WHERE cidade = :cidade AND estado = :estado LIMIT 1";

$consulta = $pdo->prepare($sql);
$consulta->bindParam(":cidade",$cidade);
$consulta->bindParam(":estado",$estado);
$consulta->execute();

$d = $consulta->fetch(PDO::FETCH_OBJ);

if(empty($d->id)) {
    echo "Erro";
} else {
    echo $d->id;
}