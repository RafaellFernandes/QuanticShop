<br>
<br>
<br>
<br>
<h2><strong> Smartphones </strong></h2>
<br>
<div class="row">
	<?php
		//selecionar 1 produto aleatorios
		$sql = "SELECT id, Nome, ValorProduto, FotoProduto, departamento_id FROM produto WHERE departamento_id IN (5)";
		$consulta = $pdo->prepare($sql);
		$consulta->execute();

		while ( $linha = $consulta->fetch(PDO::FETCH_ASSOC) ) {

			//recuperar as variaveis
			$id 	            = $linha["id"];
			$Nome               = $linha["Nome"];
			$ValorProduto      	= $linha["ValorProduto"];
			$FotoProduto     	= $linha["FotoProduto"] ."p.jpg";

			//formatar o valor
			$ValorProduto = number_format($ValorProduto, 2, ",", ".");
			//var,casas decimais,sep decimal,sep milhares

			echo "<div class='col-3 text-center'>
					<img src='fotos/$FotoProduto' class='w-75'>
					<p>$Nome</p>
					<p class='valor'>R$ $ValorProduto</p>
					<a href='produto/$id'
					class='btn btn-info'>Detalhes</a>
				</div>";
		}
	?>
</div>