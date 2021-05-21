<nav class="navbar navbar-dark bg-dark">
	<div class="btn-group btn-group-sm btn-sm">
  		<ul class="nav" id="nav">	
            <li><a class="dropdown-item" href="departamento/eletrodomesticos">Eletrodomésticos</a></li>
            <li><a class="dropdown-item" href="departamento/eletronicos">Eletrônicos</a></li>
            <li><a class="dropdown-item" href="departamento/eletroportateis">Eletroportáteis</a></li>
            <li><a class="dropdown-item" href="departamento/gamer">Gamer</a></li>
            <li><a class="dropdown-item" href="departamento/hardware">Hardware</a></li>
            <li><a class="dropdown-item" href="departamento/impressora">Impressora</a></li>
            <li><a class="dropdown-item" href="departamento/notebooks">Notebooks</a></li>
            <li><a class="dropdown-item" href="departamento/perifericos">Periféricos</a></li>
            <li><a class="dropdown-item" href="departamento/redeinternet">Rede e Internet</a></li>
            <li><a class="dropdown-item" href="departamento/smartHome">Smart Home</a></li>
            <li><a class="dropdown-item" href="departamento/smartphone">Smartphones</a></li>
			<li><a class="dropdown-item" href="departamento/computadores">Computadores</a></li>	  
  		</ul>
	</div>
</nav>
<div class="content-top">
	<h2>Produtos em Destaque</h2>
	<div class="close_but"><i class="close1"></i></div>
	<div class="container-fluid">
		<div class="row shop_box">
			<div class="row container-fluid">
			<!-- <div class="col-sm-3 text-center"> -->
						<?php
							//selecionar 1 produto aleatorios
							$sql = "SELECT id, nome_produto, valor_unitario, foto FROM produto ORDER BY rand() LIMIT 20";
							$consulta = $pdo->prepare($sql);
							$consulta->execute();

							while ( $linha = $consulta->fetch(PDO::FETCH_ASSOC) ) {

								//recuperar as variaveis
								$id 	            = $linha["id"];
								$nome_produto       = $linha["nome_produto"];
								$valor_unitario     = $linha["valor_unitario"];
								$foto            	= $linha["foto"] ."p.jpg";
								//formatar o valor
								$valor_unitario = number_format($valor_unitario, 2, ",", ".");
								//var,casas decimais,sep decimal,sep milhares

								echo "<br>
								<div class='col-sm-3 text-center'>
								<div class='shop_desc'>
										<img src='fotos/$foto' class='img-responsive' alt='$nome_produto'/>
										<div class='clear'></div>
										<h4>$nome_produto</h4>
										<span class='actual'>R$ $valor_unitario</span><br>
										<ul class='buttons'>
											<li class='cart'><a href='produto/$id'>Add ao Carrinho</a></li>
											<li class='shop_btn'><a href='products/$id'>Mais Detalhes</a></li>
											<div class='clear'></div>
										</ul>
									</div></div><br> ";
							}
						?>	
					</div>
				</div>
			</div>			
		</div>
	</div>
</div>
<style>
	.dropdown-item {
		color: white;
	}
</style>