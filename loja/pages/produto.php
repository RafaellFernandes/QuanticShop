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
		// $foto      			= "../fotos/{$dados->foto}m.jpg"; 
		// $fotog     = "../fotos/{$dados->foto}g.jpg"; 
		$valorUnitario 	  = $dados->valorUnitario;
		$id = "";

		$foto            = $dados->foto;
		$imagem          = "../$foto";
		$imagem          = explode(",", $foto);
							
		
								
	}	
    if ( empty ( $promocao ) ) {
		//1499.99 -> 1.499,99
		$valorUnitario = "R$ " . number_format($valorUnitario, 2, ",", ".");
		$desc = "";
	} else {
		//valor normal
		$desc = "R$ " . number_format($valorUnitario, 2, ",", ".");
		//valor promocional
		$valorUnitario = "R$ " . number_format($promocao, 2, ",", ".");
	}
?>
<div class="card">
  <div class=" mt-3">
    <div class="col-md-5" >
		<a href="../fotos/produtos/<?=$imagem[0]?>" data-lightbox="foto" title="<?=$dados->nome_produto?>">
        	<img src="../fotos/produtos/<?=$imagem[0]?>" alt="<?=$dados->nome_produto?>" width="100%" height="100%">
      	</a>
		  	
<?php
// //$imagem = a variavel que recebe do banco  --- FAZER FRONTEND !!!
	 foreach ($imagem as $nomeImagem) {
		 ?>
			<div class="col-md-5" >
				<a href="../fotos/produtos/<?=$nomeImagem?>" data-lightbox="foto" title="<?=$dados->nome_produto?>">
					<img src="../fotos/produtos/<?=$nomeImagem?>" alt="<?=$dados->nome_produto?>" width="15%" height="15%">
				</a>
			</div>
			<?php
			}
	?>
    </div>

    <div class="col-md-7 mb-5">
      	<div class="card-body">
			<h4 class="card-title venda_unitaria"><strong><?=$dados->nome_produto?></strong></h4>
			<p>Código do Produto: <?=$dados->codigo?></p>
			<h5 class="venda_unitaria mt-5"><strong>Valor: R$ <?=$dados->valorUnitario;?></strong></h5>
		
			<form name="formProduto" method="post" action="pages/adicionar">
				<input type="hidden" name="id" value="<?=$dados->id?>">
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
