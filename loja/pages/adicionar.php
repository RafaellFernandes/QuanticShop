<?php
	//verificar se a variável $pagina não existe
	if ( !isset ( $pagina ) ) exit;

	if ( $_POST ) {

		//recuperar as variáveis
		$id = trim ( $_POST['id'] ?? NULL );
		$quantidade = trim ( $_POST['quantidade'] ?? 1 );

		//verificar se o id está vazio
		if ( empty ( $id ) ) {
			echo "<script>alert('Produto inválido');history.back();</script>";
			exit;
		}

		//selecionar os dados do banco
		$sql = "select id, nome_produto, valor_unitario, promocao 
			from produto 
			where id = ".(int)$id." limit 1";


		//separar os dados
		$id = $dados["id"];
		$produto = $dados["nome_produto"];
		$valor = $dados["valor_unitario"];
		$promo = $dados["promocao"];

		//o valorProduto sempre será o valor do produto
		$valorProduto = $valor_unitario;
		//se existir um valor promo, valorProduto será o valor Promo
		if ( !empty ( $promocao ) ) {
			$valorProduto = $promocao;
		}

		//valor total
		$total = $valorProduto * $quantidade;

		//guardar esses valores na sessao
		$_SESSION["carrinho"][$id] = array("id"=>$id, 
										"nome_produto"=>$nome_produto,
										"valor_unitario"=>$valorProduto,
										"quantidade"=>$quantidade,
										"total"=>$total);
		//print_r ( $_SESSION['carrinho'] );

		//redirecionar para o carrinho
		echo "<script>location.href = 'carrinho/quantidade/'+produto+"/"+quantidade;</script>";

		exit;

	}

	//mensagem de erro - não esta inserindo nada
?>
<script type="text/javascript">
	//mostrar pop up com mensagem - voltar para a página anterior
	alert('Requisição inválida, tente novamente');history.back();
</script>