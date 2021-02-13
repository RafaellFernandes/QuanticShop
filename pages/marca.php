<?php

	$id = "";
	//verificar se existe o parametro para id
	if ( isset ( $p[1] ) ) {
		//p -> array explode que esta no index.php
		$id = trim ( $p[1] );
	}

	//selecionar departamento
	$sql = "SELECT Marca FROM marca
		WHERE id = ? LIMIT 1";
	//executar o sql
	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1, $id, PDO::PARAM_INT);
	$consulta->execute();
    $linha = $consulta->fetch(PDO::FETCH_ASSOC);
    
	//separar os campos de resultado
	$Marca = $linha["Marca"];

	//mostrar o nome do Departamento na tela
	echo "<h1>$Marca</h1>";
?>
<div class="row">
	<?php
		//selecionar os produtos daquele departamento
		$sql = "SELECT id, Nome, ValorProduto, 
			FotoProduto
            FROM produto";
            
		//executar o sql
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1, $id, PDO::PARAM_INT);
		$consulta->execute();

		while ( $linha = $consulta->fetch(PDO::FETCH_ASSOC) ) {

			//separar os campos
			$id              	= $linha["id"];
			$Nome               = $linha["Nome"];
			$ValorProduto     	= $linha["ValorProduto"];
			$FotoProduto    	= $linha["FotoProduto"]."p.jpg";

			$ValorProduto = number_format($ValorProduto,2,",",".");

			echo "<div class='col-4 mt-3 text-center'>
					<img src='fotos/$FotoProduto' class='w-100 '>
					<p>$Nome</p>
					<p class='valor'>R$ $ValorProduto</p>
					<a href='produto/$id' class='btn btn-danger'>Detalhes</a>
				</div>";
		}

	?>
</div>
