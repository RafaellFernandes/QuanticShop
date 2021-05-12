<?php
	$id = "";
	if ( isset ( $p[1]) ) {
		$id = trim ( $p[1] );
	}

	//selecionar o quadrinho
	$sql = "select *, Nome from produto where id = ? limit 1";
	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(1, $id, PDO::PARAM_INT);
	$consulta->execute();
	$linha 		= $consulta->fetch(PDO::FETCH_ASSOC);

	$id           	= $linha["id"];
	$Nome           = $linha["Nome"];
	$FotoProduto   	= $linha["FotoProduto"]."g.jpg";
	$Descricao      = $linha["Descricao"];
  	$ValorProduto 	= $linha["ValorProduto"];
	$ValorProduto   = number_format($ValorProduto,2,",",".");
?>
<!-- 
<h1 class="mt-5"><?//=$Nome;?></h1>
<div class="row">
	<div class="col-4">
		<img src="fotos/<?//=$FotoProduto;?>" class="w-50">
		<p class="ValorProduto">R$ <?//=$ValorProduto;?>
	</div>
	<div class="col-8">
		
		<p><strong>Descrição:</strong> <?//=$Descricao;?></p>
		<p class="text-center">
			<a href="carrinho/add/<?//=$id;?>" class="btn btn-danger btn-lg">
				Adicionar ao Carrinho
			</a>
		</p>
	</div>
</div> -->
<br><br><br>
<div class="card mt-5">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="fotos/<?=$FotoProduto;?>" class="card-img">
    </div>
    <div class="col-md-8">
      <div class="card-body">
		<h5 class="card-title valorProduto"><strong><?=$Nome;?></strong></h5><br>
		<br>
		<p class="valorProduto"><strong>Valor: R$ <?=$ValorProduto;?></strong></p>
		<a href="carrinho/add/<?=$id;?>" class="btn btn-success">Adicionar ao Carrinho</a><br>
		<p class="card-text"><strong>Descrição:</strong> <?=$Descricao;?></p>
		<br>  
	</div>
    </div>
  </div>
</div>