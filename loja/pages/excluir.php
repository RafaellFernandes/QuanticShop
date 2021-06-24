<?php
	//verificar se a variável $pagina não existe
	if ( !isset ( $pagina ) ) exit;

	//recuperar o id
	$id = trim ( $_GET['id'] ?? NULL );

	//verificar se esta vazio
	if (empty ( $id ) ) {
		//mensagem de erro e voltar á página anterior
		echo "<script>alert('Produto inválido');history.back();</script>";
		exit;
	}

	//excluir o produto
	unset ( $_SESSION['carrinho'][$id] );

	//redirecionar para o carrinho
	echo "<script>location.href='pages/carrinho';</script>";
?>