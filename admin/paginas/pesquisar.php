<?php
 //verificar se não está logado
 if ( !isset ( $_SESSION["bancotcc"]["id"] ) ){
    exit;
  }

  include "../config/conexao.php";
  
  //mostrar erros
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
    error_reporting(E_ALL);

    $pesquisar = $_POST["pesquisar"];
    $result_produtos = "SELECT * FROM produto WHERE Nome LIKE '%$pesquisar%' LIMIT 5";
    $resultado_produto = mysqli_query($conn, $result_produtos);

    while($rows_produto = mysqli_fetch_array($resultado_produto)) {
        echo " Nome: ".$rows_produto['Nome']."<br>";
    }
?>
