<?php

	$id = "";
	//verificar se existe o parametro para id
	if ( isset ( $p[1] ) ) {
		//p -> array explode que esta no index.php
		$id = trim ( $p[1] );
	}

	//selecionar departamento
	$sql = "SELECT nome_dept FROM departamento 
		WHERE id = ? LIMIT 1";
	//executar o sql
	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1, $id, PDO::PARAM_INT);
	$consulta->execute();
	$linha = $consulta->fetch(PDO::FETCH_ASSOC);
	
	//separar os campos de resultado
	$nome_dept = $linha["nome_dept"];

	//mostrar o nome do Departamento na tela
	echo "<h1>$nome_dept</h1>";	
?>

<div class="row">
	<?php
		//selecionar os produtos daquele departamento
		$sql = "SELECT id, nome_produto, venda_unitaria, 
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
			$venda_unitaria    = $linha["venda_unitaria"];
			$foto    	        = $linha["foto"]."p.jpg";

			$venda_unitaria = number_format($venda_unitaria, 2, ",", ".");

			echo "<div class='col-4 mt-3 text-center'>
					<img src='fotos/$foto' class='w-100 '>
					<p>$nome_produto</p>
					<p class='valor'>R$ $venda_unitaria</p>
					<a href='pages/produto/$id' class='btn btn-danger'>Detalhes</a>
				</div>";
		}

	?>
</div>
