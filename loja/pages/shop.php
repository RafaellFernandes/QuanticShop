<style>
	
</style>
<!-- Example single danger button -->
<nav class="navbar navbar-dark bg-dark">
<div class="btn-group">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    Departamento
  </button>
  <ul class="dropdown-menu">
  <li><a class="dropdown-item" href="computadores">Computadores</a></li>
              <li><a class="dropdown-item" href="eletrodomesticos">Eletrodomésticos</a></li>
              <li><a class="dropdown-item" href="eletronicos">Eletrônicos</a></li>
              <li><a class="dropdown-item" href="eletroportateis">Eletroportáteis</a></li>
              <li><a class="dropdown-item" href="gamer">Gamer</a></li>
              <li><a class="dropdown-item" href="hardware">Hardware</a></li>
              <li><a class="dropdown-item" href="impressora">Impressora</a></li>
              <li><a class="dropdown-item" href="notebooks">Notebooks</a></li>
              <li><a class="dropdown-item" href="perifericos">Periféricos</a></li>
              <li><a class="dropdown-item" href="redeinternet">Rede e Internet</a></li>
              <li><a class="dropdown-item" href="smartHome">Smart Home</a></li>
              <li><a class="dropdown-item" href="smartphone">Smartphones</a></li>
  </ul>

</nav>

</div>
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
