<?php
	$id = "";
	if ( isset ( $p[1]) ) {
		$id = trim ( $p[1] );
	}

	//selecionar o quadrinho
	$sql = "select *, nome_produto from produto where id = ? limit 1";
	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1, $id, PDO::PARAM_INT);
	$consulta->execute();
	$linha 		= $consulta->fetch(PDO::FETCH_ASSOC);

	$id           	      = $linha["id"];
	$nome_produto         = $linha["nome_produto"];
	$promocao             = $linha["promocao"];
	$foto   	          = $linha["foto"]."g.jpg";
	$descricao            = $linha["descricao"];
  	$valor_unitario 	  = $linha["valor_unitario"];
	

    if ( empty ( $promocao ) ) {
		//1499.99 -> 1.499,99
		$valor_unitario = "R$ " . number_format($valor_unitario, 2, ",", ".");
		$desc = "";
	} else {
		//valor normal
		$desc = "R$ " . number_format($valor_unitario, 2, ",", ".");
		//valor promocional
		$valor_unitario = "R$ " . number_format($promocao, 2, ",", ".");
	}
	?>
<br><br><br>
<div class="card mt-5">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="fotos/<?=$foto;?>" class="card-img">
    </div>
    <div class="col-md-8">
      <div class="card-body">
		<h5 class="card-title valor_unitario"><strong><?=$nome_produto;?></strong></h5><br>
		<br>
		<p class="valor_unitario"><strong>Valor: R$ <?=$valor_unitario;?></strong></p>
		<a href="pages/carrinho/<?=$id;?>" class="btn btn-success">Adicionar ao Carrinho</a><br>
		<p class="card-text"><strong>Descrição:</strong> <?=$descricao;?></p>
		<br>  
	</div>
    </div>
  </div>
</div>