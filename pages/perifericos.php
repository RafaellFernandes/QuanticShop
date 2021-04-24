<br>
<br>
<br>
<br>
<h2><strong> Periféricos </strong></h2>
<br>
<div class="row">
	<?php
		//selecionar 1 produto aleatorios
		$sql = "SELECT id, nome_produto, valor_unitario, foto, departamento_id FROM produto WHERE departamento_id IN (4)";
		$consulta = $pdo->prepare($sql);
		$consulta->execute();

		while ( $linha = $consulta->fetch(PDO::FETCH_ASSOC) ) {

			//recuperar as variaveis
			$id 	            = $linha["id"];
			$nome_produto       = $linha["nome_produto"];
			$valor_unitario     = $linha["valor_unitario"];
			$foto    	        = $linha["foto"] ."p.jpg";

			//formatar o valor
			$valor_unitario = number_format($valor_unitario, 2, ",", ".");
			//var,casas decimais,sep decimal,sep milhares

			echo "<div class='col-3 text-center'>
					<img src='fotos/$foto' class='w-75'>
					<p>$nome_produto</p>
					<p class='valor'>R$ $valor_unitario</p>
					<a href='produto/$id'
					class='btn btn-info'>Detalhes</a>
				</div>";
		}
	?>
</div>