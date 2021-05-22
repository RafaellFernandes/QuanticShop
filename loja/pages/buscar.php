<?php
	//include "config/conexao.php";
	$link = new mysqli("localhost","root","","quanticshop");
	
	$pesquisar = $_POST['buscar'];
	//$result_produto = "SELECT * FROM produto WHERE Nome LIKE '%$pesquisar%' LIMIT 1";
	$result_produto = mysqli_query($link, "SELECT * FROM produto WHERE nome_produto LIKE '%$pesquisar%' LIMIT 1");
	
	$rows_produto = mysqli_fetch_array($result_produto, MYSQLI_ASSOC);
	 
	//echo $rows_produto;
    
    
     while ( $rows_produto = $result_produto->fetch_array(PDO::FETCH_OBJ) ) {
         echo "Produtos: ".$rows_produto['Nome']."<br>";

    }
   //$result = mysqli_query($link, "SELECT descricao FROM quartos WHERE nome_quarto='Quarto Ibiza'");
?>