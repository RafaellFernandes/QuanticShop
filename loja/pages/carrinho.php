<?php
	//verificar se a variável $pagina não existe
	if ( !isset ( $pagina ) ) exit;
?>
<h1 class="text-center">Carrinho de Compras</h1>

<?php
	
	if ( isset ( $_SESSION['cliente']['nome'] ) ) {

		echo "<p><strong>Olá ".$_SESSION['cliente']['nome']." - <a href='sair.php'>Efetuar Logout</a></strong></p>";
	}

	//iniciar uma variavel chamada $produtos com o valor
	$produtos = 0;
	
	//verificar se existem produtos no carrinho
	if ( isset ( $_SESSION['carrinho'] ) )
		//count - contar número de linhas
		$produtos = count( $_SESSION['carrinho'] );

?>

<p class="alert alert-warning">
	Existem <?=$produtos?> produto(s) diferente(s) no carrinho:
</p>

<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<td>Nome do Produto</td>
			<td>Quantidade</td>
			<td>Vlr Unit.</td>
			<td>Vlr Total</td>
			<td></td>
		</tr>
	</thead>
	<tbody>
	<?php
		//mostrar o itens do $_SESSION['carrinho']
		//print_r ( $_SESSION['carrinho'] );

		$totalGeral = 0;

		//se existem produtos no carrinho
		if ( $produtos > 0 ) {	

			//percorrer o array e mostrar os produtos
			foreach ( $_SESSION['carrinho'] as $dados ) {
				//recuperar os dados do array carrinho
				$id = $dados["id"];
				$produto = $dados["produto"];
				$valor = $dados["valor"];
				$quantidade = $dados["quantidade"];
				$total = $dados["total"];

				//somar o totalGeral
				$totalGeral = $total + $totalGeral;
				//formatar os valores
				$valor = number_format($valor, 2, "," , ".");
				$total = number_format($total, 2, ",", ".");

				//mostrar os resultados em uma linha da tabela
				//tr - linha
				//td - célula ou coluna
				echo "<tr>
					<td>{$produto}</td>
					<td>{$quantidade}</td>
					<td>R$ {$valor}</td>
					<td>R$ {$total}</td>
					<td>
						<button type='button' class='btn btn-danger btn-sm' onclick='excluirProduto({$id})'>
							<i class='fas fa-trash'></i>
						</button>
					</td>
				</tr>";			
			}

		}
	?>
	</tbody>
	<tfoot>
		<tr>
			<td>Valor Total:</td>
			<td></td>
			<td></td>
			<td>R$ <?=number_format($totalGeral, 2, "," , ".");?></td>
			<td></td>
		</tr>
	</tfoot>
</table>

<a href="index.php?pagina=limpar" class="btn btn-danger btn-lg float-left">
	Limpar Carrinho
</a>
<a href="index.php?pagina=finalizar" class="btn btn-success btn-lg float-right">
	Finalizar Pedido
</a>

<div class="clearfix"></div>

<script>
	//funcao para perguntar se quer realmente excluir o produto
	function excluirProduto(id) {
		//perguntar se deseja excluir
		if ( confirm ("Deseja realmente excluir este item?") ) {
			//envio para página que irá excluir com o id do produto
			location.href="index.php?pagina=excluir&id="+id;
		}
	}
</script>