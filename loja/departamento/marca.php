<?php

	$id = "";
	//verificar se existe o parametro para id
	if ( isset ( $p[1] ) ) {
		//p -> array explode que esta no index.php
		$id = trim ( $p[1] );
	}

	//selecionar departamento
	$sql = "SELECT nome_marca FROM marca
		WHERE id = ? LIMIT 1";
	//executar o sql
	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1, $id, PDO::PARAM_INT);
	$consulta->execute();
    $linha = $consulta->fetch(PDO::FETCH_ASSOC);
    
	//separar os campos de resultado
	$nome_marca = $linha["nome_marca"];

	//mostrar o nome do Departamento na tela
	echo "<h1>$nome_marca</h1>";
?>
<div class="row">
	<?php
		//selecionar os produtos daquele departamento
		$sql = "SELECT id, nome_produto, valor_unitario, 
			foto
            FROM produto";
            
		//executar o sql
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1, $id, PDO::PARAM_INT);
		$consulta->execute();

		while ( $linha = $consulta->fetch(PDO::FETCH_ASSOC) ) {

			//separar os campos
			$id              	= $linha["id"];
			$nome_produto       = $linha["nome_produto"];
			$valor_unitario    	= $linha["valor_unitario"];
			$FotoProduto    	= $linha["foto"]."p.jpg";

			$ValorProduto = number_format($ValorProduto,2,",",".");

			echo "<div class='col-4 mt-3 text-center'>
					<img src='fotos/$foto' class='w-100 '>
					<p>$nome_produto</p>
					<p class='valor'>R$ $valor_unitario</p>
					<a href='pages/produto/$id' class='btn btn-danger'>Detalhes</a>
				</div>";
		}

	?>
</div>