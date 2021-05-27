<?php
	//verificar se a variável $pagina não existe
	if ( !isset ( $pagina ) ) exit;

	if ( $_POST ) {

		//recuperar as variáveis
		$id = trim ( $_POST['id'] ?? NULL );
		$quantidadeCarrinho = trim ( $_POST['quantidadeCarrinho'] ?? 1 );

		//verificar se o id está vazio
		if ( empty ( $id ) ) {
			echo "<script>alert('Produto inválido');history.back();</script>";
			exit;
		}

		//selecionar os dados do banco id, nome_produto, venda_unitaria, promocao 
		$sql = "SELECT *
			FROM produto 
			WHERE id = :id limit 1";

$consulta = $pdo->prepare($sql);
$consulta->bindParam(':id', $id);
$consulta->execute();
$dados = $consulta->fetch(PDO::FETCH_OBJ);

		//separar os dados
		// $id = $dados["id"];
		$nome_produto = $dados->nome_produto;
		$venda_unitaria = $dados->venda_unitaria;
		$promocao = $dados->promocao;

		//o valorProduto sempre será o valor do produto
		$valorProduto = $venda_unitaria;
		//se existir um valor promo, valorProduto será o valor Promo
		if ( !empty ( $promocao ) ) {
			$valorProduto = $promocao;
		}

		//valor total
		$total = $valorProduto * $quantidadeCarrinho;

		//guardar esses valores na sessao
		$_SESSION["carrinho"][$id] = array("id"=>$id, 
										"nome_produto"=>$nome_produto,
										"venda_unitaria"=>$valorProduto,
										"quantidadeCarrinho"=>$quantidadeCarrinho,
										"total"=>$total);
		//print_r ( $_SESSION['carrinho'] );

		//redirecionar para o carrinho
		echo "<script>location.href='index.php?pages=carrinho';</script>";

		exit;

	}

	//mensagem de erro - não esta inserindo nada
?>
<script type="text/javascript">
	//mostrar pop up com mensagem - voltar para a página anterior
	alert('Requisição inválida, tente novamente');history.back();
</script>