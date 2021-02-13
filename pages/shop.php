<div class="main">
	<div class="content-top">
		<h2>Produtos em Destaque</h2>
		<!-- <p>Produtos em Destaque</p> -->
		<div class="close_but"><i class="close1"></i></div>
		<div class="container-fluid">
			<div class="row shop_box">
				<div class="row container-fluid">
					<div class="col-md-3 text-center">
						<?php
							//selecionar 1 produto aleatorios
							$sql = "SELECT id, Nome, ValorProduto, FotoProduto FROM produto ORDER BY rand() LIMIT 4";
							$consulta = $pdo->prepare($sql);
							$consulta->execute();

							while ( $linha = $consulta->fetch(PDO::FETCH_ASSOC) ) {

								//recuperar as variaveis
								$id 	            = $linha["id"];
								$Nome               = $linha["Nome"];
								$ValorProduto      	= $linha["ValorProduto"];
								$FotoProduto     	= $linha["FotoProduto"] ."p.jpg";

								//formatar o valor
								$ValorProduto = number_format($ValorProduto, 2, ",", ".");
								//var,casas decimais,sep decimal,sep milhares

								echo "<br><div class='shop_desc'>
										<img src='fotos/$FotoProduto' class='img-responsive' alt='$Nome'/>
										<div class='clear'></div>
										<h4>$Nome</h4>
										<span class='actual'>R$ $ValorProduto</span><br>
										<ul class='buttons'>
											<li class='cart'><a href='produto/$id'>Add ao Carrinho</a></li>
											<li class='shop_btn'><a href='products/$id'>Mais Detalhes</a></li>
											<div class='clear'></div>
										</ul>
									</div><br> ";
							}
						?>	
					</div>
				</div>
			</div>			
				<!-- <span class='reducedfrom'>$66.00</span>
<span class='new-box'>
										<span class='new-label'>Novo</span>
									</span>
									<span class='sale-box'>
										<span class='sale-label'>Promo!</span>
									</span>
 ------------------------------------------------------

				<div class="col-md-3 shop_box"><a href="single.html">
					<img src="images/pic5.jpg" class="img-responsive" alt=""/>
					<span class="new-box">
						<span class="new-label">New</span>
					</span>
					<span class="sale-box">
						<span class="sale-label">Sale!</span>
					</span>
					<div class="shop_desc">
						<h3><a href="#">aliquam volutp</a></h3>
						<p>Lorem ipsum consectetuer adipiscing </p>
						<span class="reducedfrom">$66.00</span>
						<span class="actual">$12.00</span><br>
						<ul class="buttons">
							<li class="cart"><a href="#">Add To Cart</a></li>
							<li class="shop_btn"><a href="#">Read More</a></li>
							<div class="clear"> </div>
					    </ul>
				    </div>
				</a></div>

				<div class="col-md-3 shop_box"><a href="single.html">
					<img src="images/pic6.jpg" class="img-responsive" alt=""/>
					<span class="new-box">
						<span class="new-label">New</span>
					</span>
					<div class="shop_desc">
						<h3><a href="#">aliquam volutp</a></h3>
						<p>Lorem ipsum consectetuer adipiscing </p>
						<span class="actual">$12.00</span><br>
						<ul class="buttons">
							<li class="cart"><a href="#">Add To Cart</a></li>
							<li class="shop_btn"><a href="#">Read More</a></li>
							<div class="clear"> </div>
					    </ul>
				    </div>
				</a></div>

				<div class="col-md-3 shop_box"><a href="single.html">
					<img src="images/pic7.jpg" class="img-responsive" alt=""/>
					<span class="new-box">
						<span class="new-label">New</span>
					</span>
					<span class="sale-box">
						<span class="sale-label">Sale!</span>
					</span>
					<div class="shop_desc">
						<h3><a href="#">aliquam volutp</a></h3>
						<p>Lorem ipsum consectetuer adipiscing </p>
						<span class="reducedfrom">$66.00</span>
						<span class="actual">$12.00</span><br>
						<ul class="buttons">
							<li class="cart"><a href="#">Add To Cart</a></li>
							<li class="shop_btn"><a href="#">Read More</a></li>
							<div class="clear"> </div>
					    </ul>
				    </div>
				</a></div>

				<div class="col-md-3 shop_box"><a href="single.html">
					<img src="images/pic8.jpg" class="img-responsive" alt=""/>
					<span class="new-box">
						<span class="new-label">New</span>
					</span>
					<div class="shop_desc">
						<h3><a href="#">aliquam volutp</a></h3>
						<p>Lorem ipsum consectetuer adipiscing </p>
						<span class="reducedfrom">$66.00</span>
						<span class="actual">$12.00</span><br>
						<ul class="buttons">
							<li class="cart"><a href="#">Add To Cart</a></li>
							<li class="shop_btn"><a href="#">Read More</a></li>
							<div class="clear"> </div>
					    </ul>
				    </div>
				</a></div>
			</div> -->

			 <!-- <div class="row">
				<div class="col-md-3 shop_box"><a href="single.html">
					<img src="images/pic9.jpg" class="img-responsive" alt=""/>
					<span class="new-box">
						<span class="new-label">New</span>
					</span>
					<div class="shop_desc">
						<h3><a href="#">aliquam volutp</a></h3>
						<p>Lorem ipsum consectetuer adipiscing </p>
						<span class="actual">$12.00</span><br>
						<ul class="buttons">
							<li class="cart"><a href="#">Add To Cart</a></li>
							<li class="shop_btn"><a href="#">Read More</a></li>
							<div class="clear"> </div>
					    </ul>
				    </div>
				</a></div>
				<div class="col-md-3 shop_box"><a href="single.html">
					<img src="images/pic10.jpg" class="img-responsive" alt=""/>
					<span class="new-box">
						<span class="new-label">New</span>
					</span>
					<span class="sale-box">
						<span class="sale-label">Sale!</span>
					</span>
					<div class="shop_desc">
						<h3><a href="#">aliquam volutp</a></h3>
						<p>Lorem ipsum consectetuer adipiscing </p>
						<span class="actual">$12.00</span><br>
						<ul class="buttons">
							<li class="cart"><a href="#">Add To Cart</a></li>
							<li class="shop_btn"><a href="#">Read More</a></li>
							<div class="clear"> </div>
					    </ul>
				    </div>
				</a></div>
				<div class="col-md-3 shop_box"><a href="single.html">
					<img src="images/pic11.jpg" class="img-responsive" alt=""/>
					<span class="new-box">
						<span class="new-label">New</span>
					</span>
					<div class="shop_desc">
						<h3><a href="#">aliquam volutp</a></h3>
						<p>Lorem ipsum consectetuer adipiscing </p>
						<span class="reducedfrom">$66.00</span>
						<span class="actual">$12.00</span><br>
						<ul class="buttons">
							<li class="cart"><a href="#">Add To Cart</a></li>
							<li class="shop_btn"><a href="#">Read More</a></li>
							<div class="clear"> </div>
					    </ul>
				    </div>
				</a></div>
				<div class="col-md-3 shop_box"><a href="single.html">
					<img src="images/pic12.jpg" class="img-responsive" alt=""/>
					<span class="new-box">
						<span class="new-label">New</span>
					</span>
					<span class="sale-box">
						<span class="sale-label">Sale!</span>
					</span>
					<div class="shop_desc">
						<h3><a href="#">aliquam volutp</a></h3>
						<p>Lorem ipsum consectetuer adipiscing </p>
						<span class="reducedfrom">$66.00</span>
						<span class="actual">$12.00</span><br>
						<ul class="buttons">
							<li class="cart"><a href="#">Add To Cart</a></li>
							<li class="shop_btn"><a href="#">Read More</a></li>
							<div class="clear"> </div>
					    </ul>
				    </div>
				</a></div>
			</div>  -->
		</div>
	</div>
</div>
