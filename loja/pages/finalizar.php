<?php
	//verificar se a variável $pagina não existe
	if ( !isset ( $pagina ) ) exit;

	$id = $_SESSION["quanticshop"]["id"];
	$sql = "SELECT * FROM cliente WHERE id = $id";

	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(":id", $id);
	$consulta->execute();
	$dados = $consulta->fetch(PDO::FETCH_OBJ);

?>
<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">   
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="pages/home">Home</a></li>
						<li><a href="pages/carrinho">Carrinho</a></li>
                        <li>Finalizar Pedido</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>         
</div>
<!--breadcrumbs area end-->

<!--Checkout page section-->
<div class="Checkout_section mt-60">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="user-actions">
                    <h3> 
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        Deseja Comprar Mais?
                        <a class="Returning" href="pages/shop">Retornar</a>     
                    </h3>    
                </div>  
            </div>
        </div>
        <div class="checkout_form">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <form method="post" target="pagseguro" action="https://pagseguro.uol.com.br/v2/checkout/payment.html">
                        <h3>DETALHES DE COBRANÇA</h3>
                        <div class="row mt-3">
							<input type="hidden" name="encoding" value="UTF-8">
						 
							<!-- Dados do comprador (opcionais) --> 
                            <div class="col-lg-6 mb-20">
                                <label>Primeiro Nome</label>
                                <input name="senderName" type="text" value="<?=$dados->primeiro_nome;?>">    
                            </div>
                            <div class="col-lg-6 mb-20">
                                <label>Sobrenome</label>
                                <input type="text" value="<?=$dados->sobrenome;?>"> 
                            </div>
                            <div class="col-lg-6 mb-20">
                                <label>Cidade</label>
                                <input name="shippingAddressCity" type="text" value="<?=$dados->cidade;?>">     
                            </div>
							<div class="col-lg-6 mb-20">
                                <label>Estado</label>
                                <input name="shippingAddressState" type="text" value="<?=$dados->estado;?>">     
                            </div>
                            <div class="col-lg-6 mb-20">
                                <label>Cep</label>
                                <input name="shippingAddressPostalCode" type="text" value="<?=$dados->cep;?>">     
                            </div>
                            <div class="col-lg-6 mb-20">
								<label>Bairro</label>
                                <input name="shippingAddressDistrict" type="text" value="<?=$dados->bairro;?>">      
                            </div>
                            <div class="col-12 mb-20">
                                <label>Endereço </label>
                                <input name="shippingAddressStreet" type="text" value="<?=$dados->endereco;?>">    
                            </div> 
							<div class="col-lg-6 mb-20">
                                <label>N° Residencia</label>
                                <input name="shippingAddressNumber" type="text" value="<?=$dados->numero_resid;?>">    
                            </div> 
                            <div class="col-lg-6 mb-20">
                                <label>Complemento</label>
                                <input name="shippingAddressComplement" type="text" value="<?=$dados->complemento;?>"> 
                            </div>
                            <div class="col-lg-6 mb-20">
                                <label>Celular</label>
                                <input name="senderPhone" type="text" value="<?=$dados->celular;?>">    
                            </div> 
                            <div class="col-lg-6 mb-20">
                                <label>CPF</label>
                                <input type="text" value="<?=$dados->cpf;?>"> 
                            </div> 
                            <div class="col-12 mb-20">
                                <label> Email </label>
                                <input name="senderEmail" type="text" value="<?=$dados->email;?>"> 
                            </div>      	    	    	    	    	    	    
                        </div>  
					</div>
					<div class="col-lg-6 col-md-6">
                        <h3>Sua Compra</h3> 
						<?php
							//verificar se existem produtos no carrinho
							if ( isset ( $_SESSION['carrinho'] ) )
								//count - contar número de linhas
								$produtos = count( $_SESSION['carrinho'] );
						?>
                        <div class="order_table table-responsive">
							<!-- Campos obrigatórios -->  
							<input name="receiverEmail" type="hidden" value="suporte@lojamodelo.com.br">  
        					<input name="currency" type="hidden" value="BRL">  

                            <table>
                                <thead>
                                    <tr>
                                        <th>Produto</th>
                                        <th>Qtd</th>
										<th>Valor Unit.</th>
										<th>Valor Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        //mostrar o itens do $_SESSION['carrinho']
                                        //print_r ( $_SESSION['carrinho'] );

                                        $i = $totalGeral = 0;

                                        //se existem produtos no carrinho
                                        if ( $produtos > 0 ) {	
                                            //percorrer o array e mostrar os produtos
                                            foreach ( $_SESSION['carrinho'] as $dados ) {
                                                //somar mais 1
                                                $i++;
                                                //recuperar os dados do array carrinho
                                                $id = $dados["id"];
                                                $nome_produto = $dados["nome_produto"];
                                                $valorUnitario = $dados["valorUnitario"];
                                                $quantidadeCarrinho = $dados["quantidadeCarrinho"];
                                                $total = $dados["total"];

                                                //somar o totalGeral
                                                $totalGeral = $total + $totalGeral;
                                                //formatar os valores
                                                $valorUnitario = number_format($valorUnitario, 2, "," , ".");
                                                $total = number_format($total, 2, ",", ".");

                                                //mostrar os resultados em uma linha da tabela
                                            
                                                echo "<tr>
                                                    <td>{$nome_produto}</td>
                                                    <td>{$quantidadeCarrinho}</td>
                                                    <td>R$ {$valorUnitario}</td>
                                                    <td>R$ {$total}</td>
                                                </tr>";	

                                                //formatar o valor com 2 casas decimais
                                                $valorPagseguro = number_format($dados['valorUnitario'],2,".","");
                                                //1.9 => 1.90

                                                echo "<input name=\"itemId{$i}\" type=\"hidden\" value=\"000{$i}\">  
                                                <input name=\"itemDescription{$i}\" type=\"hidden\" value=\"{$nome_produto}\">  
                                                <input name=\"itemAmount{$i}\" type=\"hidden\" value=\"{$valorPagseguro}\">  
                                                <input name=\"itemQuantity{$i}\" type=\"hidden\" value=\"{$quantidadeCarrinho}\">  
                                                <input name=\"itemWeight{$i}\" type=\"hidden\" value=\"1000\">";		
                                            }

                                        }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>  </th>
                                        <td>  </td>
                                    </tr>
									<tr>
                                        <th>  </th>
                                        <td>  </td>
                                    </tr>
									
                                    <tr class="order_total">
                                        <th>Total do Pedido</th>
                                        <td><strong>R$ <?=number_format($totalGeral, 2, "," , ".");?></strong></td>
                                    </tr>
                                </tfoot>
                            </table>     
                        </div>
						<div class="clear"></div>
						<div class="clear"></div>
                        <div class="payment_method mt-5 ">
                            <p class="mt-5"><strong>Pagamento Feito com PagSeguro</strong></p> 
                            <div class="order_button">
                                <button type="submit">Efetuar Pagamento</button> 
                            </div>    
                        </div> 
                    </form>         
                </div>
            </div> 
        </div> 
    </div>       
</div>
<!--Checkout page section end-->