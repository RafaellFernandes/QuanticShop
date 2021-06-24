<?php
	//verificar se a variável $pagina não existe
	if ( !isset ( $pagina ) ) exit;
	
	if ( isset ( $_SESSION['cliente']['primeiro_nome'] ) ) {

		echo "<p><strong>Olá ".$_SESSION['cliente']['primeiro_nome']." - <a href='login/sair.php'>Efetuar Logout</a></strong></p>";
	}
	
	//iniciar uma variavel chamada $produtos com o valor
	$produtos = 0;
	
	//verificar se existem produtos no carrinho
	if ( isset ( $_SESSION['carrinho'] ) )
		//count - contar número de linhas
		$produtos = count( $_SESSION['carrinho'] );
?>
<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">   
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="pages/home">Home</a></li>
						<li>Carrinho</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>         
</div>
<!--breadcrumbs area end-->
<p class="alert alert-warning mt-4">
	Existem <?=$produtos?> produto(s) diferente(s) no carrinho:
</p>
<!--shopping cart area start -->
<div class="shopping_cart_area mt-40">
    <div class="container">  
        <form action="#"> 
            <div class="row">
                <div class="col-12">
                    <div class="table_desc">
                        <div class="cart_page table-responsive">
                            <table>
								<thead>
									<tr>
										<th class="product_thumb">Imagem</th>
										<th class="product_name">Produto</th>
										<th class="product-price">Preço</th>
										<th class="product_quantity">Quantidade</th>
										<th class="product_total">Total</th>
										<th class="product_remove">Excluir</th>
									</tr>
								</thead>
								<tbody>
									<?php
										//mostrar o itens do $_SESSION['carrinho']
										$totalGeral = 0;
										//se existem produtos no carrinho
										if ( $produtos > 0 ) {	
											$disabled=NULL;
											//percorrer o array e mostrar os produtos
											foreach ( $_SESSION['carrinho'] as $dados ) {
												//recuperar os dados do array carrinho
												$id                   = $dados["id"];
												$nome_produto         = $dados["nome_produto"];
												$valorUnitario        = $dados["valorUnitario"];
												$quantidadeCarrinho   = $dados["quantidadeCarrinho"];
												$foto                 = $dados["foto"];
												$total                = $dados["total"];
												$foto                 = explode(",",$foto);
												$foto                 = $foto[0];

												//somar o totalGeral
												$totalGeral = $total + $totalGeral;
												//formatar os valores
												$valorUnitario = number_format($valorUnitario, 2, "," , ".");
												$total = number_format($total, 2, ",", ".");
												//mostrar os resultados em uma linha da tabela
												
												echo "<tr>
														<td class='product_thumb'><img src='../fotos/produtos/{$foto}' alt='{$nome_produto}'></td>
														<td class='product_name'>{$nome_produto}</td>
														<td class='product-price'>R$ {$valorUnitario}</td>
														<td class='product_quantity'>{$quantidadeCarrinho}</td>
														<td class='product_total'>R$ {$total}</td>
														<td class='product_remove'>
															<a type='button' onclick='excluirProduto({$id})'>
																<i class='fas fa-times'></i>
															</a>
														</td>
													</tr>";		
											}
										} else {
											$disabled="disabled";
										}
										// $disabled="disabled";
									?>
								</tbody>
                    		</table>   
                		</div>         
           		 	</div>
				</div>
			</div>
			<!--coupon code area start-->
			<div class="coupon_area">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<div class="coupon_code left">
							<h3>Limpar</h3>
							<div class="coupon_inner">   
								<p>Deseja Limpar o Carrinho?</p> 
								<a href="pages/limpar" type="button" class="btn btn-danger btn-sm">
									<i class="fas fa-check"></i> Excluir Tudo
								</a>
							</div>    
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="coupon_code right">
							<h3>Total Carrinho</h3>
							<div class="coupon_inner">
								<div class="cart_subtotal">
									<p>Subtotal</p>
									<p class="cart_amount">R$ <?=number_format($totalGeral, 2, "," , ".");?></p>
								</div>
								<div class="cart_subtotal">
									<p>Total</p>
									<p class="cart_amount">R$ <?=number_format($totalGeral, 2, "," , ".");?></p>
								</div>
								<div class="checkout_btn">
									<a href='pages/finalizar/<?=$id?>' class='btn btn-primary' <?=$disabled?> >Finalizar Pedido</a><br>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>     
		</form> 
	</div>     
</div>
<!--shopping cart area end -->
<script>
	function excluirProduto(id) {
		//perguntar se deseja excluir
		console.log(id);
		if ( confirm ("Deseja realmente excluir este item?") ) {
			//envio para página que irá excluir com o id do produto
			location.href="pages/excluir&id="+id;
		}
	}
</script>