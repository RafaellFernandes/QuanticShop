<?php
    if ( !empty ( $id ) ) {
    	$sql = "SELECT * 
    	FROM produto
    	WHERE id = :id LIMIT 1";
    	$consulta = $pdo->prepare($sql);
    	$consulta->bindParam(':id', $id);
    	$consulta->execute();
    	$dados = $consulta->fetch(PDO::FETCH_OBJ);

		$promocao             = $dados->promocao;
		$foto      = "../fotos/{$dados->foto}m.jpg"; 
		$fotog     = "../fotos/{$dados->foto}g.jpg"; 
		$venda_unitaria 	  = $dados->venda_unitaria;
		$id = "";
	}	
    if ( empty ( $promocao ) ) {
		//1499.99 -> 1.499,99
		$venda_unitaria = "R$ " . number_format($venda_unitaria, 2, ",", ".");
		$desc = "";
	} else {
		//valor normal
		$desc = "R$ " . number_format($venda_unitaria, 2, ",", ".");
		//valor promocional
		$venda_unitaria = "R$ " . number_format($promocao, 2, ",", ".");
	}
?>
<div class="card">
  <div class=" mt-3">
    <div class="col-md-5" >
		<a href="<?=$fotog?>" data-lightbox="foto" title="<?=$dados->nome_produto?>">
        	<img src="<?=$foto?>" alt="<?=$dados->nome_produto?>" width="100%" height="100%">
      	</a>
    </div>
    <div class="col-md-7 mb-5">
      	<div class="card-body">
			<h4 class="card-title venda_unitaria"><strong><?=$dados->nome_produto?></strong></h4>
			<p>Código do Produto: <?=$dados->codigo?></p>
			<h5 class="venda_unitaria mt-5"><strong>Valor: R$ <?=$dados->venda_unitaria;?></strong></h5>
		

		<form name="formProduto" method="post" action="index.php?pagina=adicionar">
			<input type="hidden" name="id" value="<?=$id?>">
			<div class="input-group">
				<input type="number" name="quantidadeCarrinho" value="1" class="form-control form-control-lg" placeholder="Quantidade" required
				inputmode="numeric">
				<div class="input-group-append">
					<button type="submit" class="btn btn-success btn-lg">
						<i class="fas fa-check"></i> Adicionar ao Carrinho
					</button>
				</div>
			</div>
		</form>
		</div>
    </div>
  </div>
</div>
<div class="container mt-5">
	<div class="row">
		<h3 class="text-center"><strong>Descrição do Produto:</strong></h3>
		<p><?=$dados->descricao;?></p>	
	</div>
</div>
<div class="container-fluid mt-4"> 
	<div class="row">
		<p><?=$dados->espec_tecnica;?></p>
	</div>
</div>