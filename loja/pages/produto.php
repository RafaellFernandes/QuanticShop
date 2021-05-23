<?php
	// $id = $valor_unitario = NULL;
    //validação do require da senha
    if ( !empty ( $id ) ) {

    	$sql = "select * 
    	from produto
    	where id = :id limit 1";
    	$consulta = $pdo->prepare($sql);
    	$consulta->bindParam(':id', $id);
    	$consulta->execute();

    	//recuperar os dados
    	$linha = $consulta->fetch(PDO::FETCH_OBJ);

        

	// $id = "";
	// if ( isset ( $p[1]) ) {
	// 	$id = trim ( $p[1] );
	// }

	// $id = $_GET['id'];
	// echo $id;

	// //selecionar o quadrinho
	// $sql = "select * from produto where id = ? limit 1";
	// $consulta = $pdo->prepare($sql);
	// // $consulta->bindParam(1, $id, PDO::PARAM_INT);
	// //passar um parametro - id
	// $consulta->bindParam(':id', $id);
	// //executar o sql
	// $consulta->execute();
	// 	// $linha = $consulta->fetch(PDO::FETCH_ASSOC);
	// $linha = $consulta->fetch(PDO::FETCH_ASSOC);

	//executar o comando sql
	// $consulta->execute();

	// while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ){


	$id           	      = $linha->id;
	$nome_produto         = $linha->nome_produto;
	$promocao             = $linha->promocao;
	$foto   	          = $linha->foto."g.jpg";
	$descricao            = $linha->descricao;
  	$venda_unitaria 	  = $linha->venda_unitaria;
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
<br><br><br>
<div class="card mt-5">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="fotos/<?=$foto;?>" class="card-img">
    </div>
    <div class="col-md-8">
      <div class="card-body">
		<h5 class="card-title venda_unitaria"><strong><?=$nome_produto;?></strong></h5><br>
		<br>
		<p class="venda_unitaria"><strong>Valor: R$ <?=$venda_unitaria;?></strong></p>
		<a href="pages/carrinho/<?=$id;?>" class="btn btn-success">Adicionar ao Carrinho</a><br>
		<p class="card-text"><strong>Descrição:</strong> <?=$descricao;?></p>
		<br>  
	</div>
    </div>
  </div>
</div>