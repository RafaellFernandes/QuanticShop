<style>
</style>

<div class="main">
	<ul class="nav nav-pills bg-dark ">
		<li class="nav-item mt-3 mb-3">
			<a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true" style="color: white;">Compre por:</a>
		</li>
		<li class="nav-item dropdown mt-3 mb-3">
			<a class="nav-link dropdown-toggle active" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"> Por Departamento</a>
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
		</li>
		<li class="nav-item dropdown mt-3 mb-3">
			<a class="nav-link dropdown-toggle active" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"> Por Marca</a>
			<ul class="dropdown-menu">
				<select name="marca_id" id="marca_id" class="form-control" required data-parsley-required-message="selecione uma opção">
                    <option value="<?=$marca_id;?>">Selecione a Marca</option>
                        <?php
                            $sql = "SELECT * FROM marca ORDER BY id";
                            $consulta = $pdo->prepare($sql);
                            $consulta->execute();

                            while ($d = $consulta->fetch(PDO::FETCH_OBJ) ) {
                                //separar os dados
                                $id   = $d->id;
                                $nome_marca = $d->nome_marca;
                                echo '<option value="'.$id.'">'.$nome_marca.'</option>';
                            }                    
                        ?>
                </select>
			</ul>
		</li>
		<li class="nav-item mt-3 mb-3">
			<a class="nav-link" href="#">Link</a>
		</li>
	</ul>





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
