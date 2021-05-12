<?php

//verificar se nao esta logado
if ( !isset ( $_SESSION["quanticshop"]["id"] ) ) {
    exit;
}

	$op = $produto = "";
	if ( isset ( $p[1] ) ) $op = trim ( $p[1] );
	if ( isset ( $p[2] ) ) $produto = trim ( $p[2] );

	if ( $op == "add" ) {

		$sql = "SELECT id, nome_produto, valor_unitario FROM produto WHERE id = ? LIMIT 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1, $produto, PDO::PARAM_INT);
		$consulta->execute();
		$linha 	  = $consulta->fetch(PDO::FETCH_OBJ);

		if ( isset ( $linha->id ) ) { 
			$id 	        = 	$linha->id;
			$nome_produto   =	$linha->nome_produto;
			$valor_unitario =	$linha->valor_unitario;

			$_SESSION["carrinho"][$id] = array("id"=>$id, "nome_produto"=>$nome_produto, "valor_unitario"=>$valor_unitario, "quantidade"=>1);
		}

	} else if ( $op == "quantidade" ) {

		$quantidade = 1;
		if ( isset ( $p[3] ) ) $quantidade = trim ( $p[3] );
		$_SESSION["carrinho"][$produto]["quantidade"] = $quantidade;

	} else if ( $op == "del" ) {

		unset ( $_SESSION["carrinho"][$produto] );

	} else if ( $op == "limpar" ) {

		unset ( $_SESSION["carrinho"] );

	}

?>
<br><br><br>
<div class="mr-5 ml-5 mt-5 mb-5">
	<h1>Carrinho de Compras:</h1>
	<?php
		if ( isset ( $_SESSION["carrinho"] ) ) {
			?>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<td>Nome do Produto</td>
						<td>Valor Unitário</td>
						<td>Quantidade</td>
						<td>Total</td>
						<td>Excluir</td>
					</tr>
				</thead>

			<?php

			$geral = 0;

			foreach ( $_SESSION["carrinho"] as $c ) {
				
				$id 		    = $c["id"];
				$nome_produto   = $c["nome_produto"];
				$valor_unitario = $c["valor_unitario"];
				$quantidade     = $c["quantidade"];

				$total = $valor_unitario * $quantidade;

				$geral = $total + $geral;

				$valor_unitario = number_format($valor_unitario,2,",",".");
				$total = number_format($total,2,",",".");

				echo "<tr>
					<td>$nome_produto</td>
					<td>$valor_unitario</td>
					<td>
						<input type='text' value='$quantidade' onblur='adicionaQuantidade($id, this.value)' class='form-control'>
					</td>
					<td>$total</td>
					<td><a href='carrinho/del/$id' class='btn btn-danger btn-sn'><i class='fas fa-trash'></i></a> </td>
				</tr>";
			}
			$geral = number_format($geral,2,",",".");
			?>
				<tfoot>
					<tr>
						<td colspan="3">TOTAL:</td>
						<td colspan="2">R$ <?=$geral;?></td>
					</tr>
				</tfoot>
			</table>
				

				<a href="carrinho/limpar" class="btn btn-danger btn-lg float-left">
				<i class="fas fa-check"></i> Limpar Carrinho
				</a>

				<a href="loginCliente" class="btn btn-success btn-lg float-right">
				<i class="fas fa-check"></i> Realizar pagamento
				</a>

			
				<br>
			</form>

			<br>
			<script type="text/javascript">
				function adicionaQuantidade(produto, quantidade) {
					location.href = 'carrinho/quantidade/'+produto+"/"+quantidade;
				}		
			</script>
		
			<?php
		}else{
			echo "<p class=\"alert alert-danger\">Não existem produtos no carrinho</p>";
			
		}
		

	?>
</div>
 
