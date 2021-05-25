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
  <div class="row no-gutters mt-3">
    <div class="col-md-5" >
		<a href="<?=$fotog?>" data-lightbox="foto" title="<?=$dados->nome_produto?>">
        	<img src="<?=$foto?>" alt="<?=$dados->nome_produto?>" width="100%" height="100%">
      	</a>
    </div>
    <div class="col-md-7">
      <div class="card-body">
		<h5 class="card-title venda_unitaria"><strong><?=$dados->nome_produto?></strong></h5><br>
		<p>Código do Produto: <?=$dados->codigo?></p>
		<br>
		<p class="venda_unitaria"><strong>Valor: R$ <?=$dados->venda_unitaria;?></strong></p>
		<a href="pages/carrinho/<?=$dados->id;?>" class="btn btn-success">Adicionar ao Carrinho</a><br>
		
		<br>  
	</div>
    </div>
	<div class="container-fluid mt-5">
	<div class="row col-12">
	<p class="card-body"><strong>Descrição:</strong> <?=$dados->descricao;?></p>
	<p class="card-body"><?=$dados->espec_tecnica;?></p>
	</div>
	</div>
  </div>
</div>