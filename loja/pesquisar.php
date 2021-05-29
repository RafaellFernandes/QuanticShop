<?php
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $dbname = "quanticshop";
    //Criar a conexao
    $conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
    
    $pesquisar = $_POST['pesquisar'];
    $result_cursos = "SELECT * FROM produto WHERE nome_produto LIKE '%$pesquisar%' ORDER BY id ";
    $resultado_cursos = mysqli_query($conn, $result_cursos);
    
    while($rows_cursos = mysqli_fetch_array($resultado_cursos)){
        echo "Produto: ".$rows_cursos['nome_produto']."<br>";
    }
?>