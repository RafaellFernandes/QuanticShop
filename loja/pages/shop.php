<nav class="navbar navbar-dark bg-dark">
	<div class="btn-group btn-group-sm btn-sm">
  		<ul class="nav" id="nav">	
            <li><a class="dropdown-item" href="departamento/eletrodomesticos">Eletrodomésticos</a></li>
            <li><a class="dropdown-item" href="departamento/eletroportateis">Eletroportáteis</a></li>
            <li><a class="dropdown-item" href="departamento/gamer">Gamer</a></li>
            <li><a class="dropdown-item" href="departamento/hardware">Hardware</a></li>
            <li><a class="dropdown-item" href="departamento/impressora">Impressora</a></li>
            <li><a class="dropdown-item" href="departamento/notebooks">Notebooks</a></li>
            <li><a class="dropdown-item" href="departamento/perifericos">Periféricos</a></li>
            <!-- <li><a class="dropdown-item" href="departamento/redeinternet">Rede e Internet</a></li> -->
            <li><a class="dropdown-item" href="departamento/smartHome">Smart Home</a></li>
            <li><a class="dropdown-item" href="departamento/smartphone">Smartphones</a></li>
			<li><a class="dropdown-item" href="departamento/computadores">Computadores</a></li>	  
  		</ul>
	</div>
</nav>

<article>
												<form name="form_pesquisa" id="form_pesquisa" method="post" action="">
													<fieldset>
													
															<div class="input-prepend">
																<span class="add-on"><i class="icon-search"></i></span>
																<input type="text" name="pesquisaCliente" id="pesquisaCliente" value="" tabindex="1" placeholder="Pesquisar cliente..." />
															</div>
													</fieldset>
												</form>
												<div id="contentLoading">
													<div id="loading"></div>
												</div>
												<section class="jumbotron">
													<div id="MostraPesq"></div>
												</section>
											</article>
										
<div class="content-top">
	<h2>Produtos em Destaque</h2>
	<div class="close_but"><i class="close1"></i></div>
	<div class="container-fluid">
		<!-- <div class="row"> -->
		<div class="card-group">
			
			<!-- <div class="col-sm-3 text-center"> -->
						<?php
							//selecionar 1 produto aleatorios
							$sql = "SELECT * FROM produto WHERE ativo = 1 ORDER BY rand() LIMIT 30";
							$consulta = $pdo->prepare($sql);
							$consulta->execute();

							while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {

								//recuperar as variaveis
								$id 	            = $dados->id;
								$nome_produto       = $dados->nome_produto;
								$valorUnitario       = $dados->valorUnitario;
								$foto                = $dados->foto;
								$imagem              = explode(",", $foto);
								//formatar o valor
								$valorUnitario = number_format($valorUnitario, 2, ",", ".");
								//var,casas decimais,sep decimal,sep milhares

								?>
								<div class='col-sm-2 text-center m-3'>
										<div class='card'>
											<img src='../fotos/produtos/<?=$imagem[0]?>' class='card-img-top' width='40' height='auto' alt='<?=$nome_produto?>'>
											<div class='card-body'>
												<p class='card-title'><?=$nome_produto?></p>
												<p class='card-text' style='color: green;'>R$ <?=$valorUnitario?> </p>
												<a href='pages/produto/<?=$id?>' class='btn btn-primary'>Detalhes</a><br>
											</div>
										</div>
									</div>
								<?php
							}
						?>	
			
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