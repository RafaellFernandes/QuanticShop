<nav class="navbar navbar-dark bg-dark">
	<div class="btn-group btn-group-sm btn-sm">
  		<ul class="nav" id="nav">	
            <li><a class="dropdown-item" href="departamento/eletrodomesticos">Eletrodomésticos</a></li>
            <!-- <li><a class="dropdown-item" href="departamento/eletronicos">Eletrônicos</a></li> -->
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
	<h2>Rede e Internet</h2>
	<div class="close_but"><i class="close1"></i></div>
	<div class="container-fluid">
		<div class="row shop_box">
			<div class="row container-fluid">
				<?php
					//selecionar 1 produto aleatorios
					$sql = "SELECT id, nome_produto, venda_unitaria, foto, departamento_id FROM produto WHERE departamento_id IN (11)";
					$consulta = $pdo->prepare($sql);
					$consulta->execute();

					while ( $linha = $consulta->fetch(PDO::FETCH_ASSOC) ) {

					//separar os campos
					$id              	= $linha["id"];
					$nome_produto       = $linha["nome_produto"];
					$venda_unitaria    	= $linha["venda_unitaria"];
					$FotoProduto    	= $linha["foto"]."p.jpg";

					$venda_unitaria = number_format($venda_unitaria, 2, ",", ".");

					echo "<div class='col-4 mt-3 text-center'>
							<img src='fotos/$foto' class='w-100 '>
							<p>$nome_produto</p>
							<p class='valor'>R$ $venda_unitaria</p>
							<a href='pages/produto/$id' class='btn btn-danger'>Detalhes</a>
						</div>";
				}
				?>
			</div>
		</div>
	</div>
</div>
<style>
	.dropdown-item {
		color: white;
	}
</style>