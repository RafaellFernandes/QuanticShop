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
            <li><a class="dropdown-item" href="departamento/smartHome">Smart Home</a></li>
            <li><a class="dropdown-item" href="departamento/smartphone">Smartphones</a></li>
			<li><a class="dropdown-item" href="departamento/computadores">Computadores</a></li>	  
  		</ul>
	</div>
</nav>
<div class="latest-products">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Impressoras: </h2>
                </div>
            </div>
            <?php
				$sql = "SELECT p.id pid, p.*, e.* 
                        FROM produto p
                        INNER JOIN estoque e ON (p.id = e.produto_id) 
                        WHERE ativo = 1 AND departamento_id IN (12) AND qtd_estoque > 10";
				$consulta = $pdo->prepare($sql);
				$consulta->execute();

				while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
					$pid 	             = $dados->pid;
					$nome_produto        = $dados->nome_produto;
					$valorUnitario       = $dados->valorUnitario;
					$foto                = $dados->foto;
					$imagem              = explode(",", $foto);

					//se a promo esta vazio - valor = valor do produto
                    if ( empty ( $promocao ) ) {
                        //1499.99 -> 1.499,99
                        $valorUnitario = "R$ " . number_format($valorUnitario, 2, ",", ".");
                        $desc = "";
                    } else {
                        //valor normal
                        $desc = "R$ " . number_format($valorUnitario, 2, ",", ".");
                        //valor promocional
                        $valorUnitario = "R$ " . number_format($promocao, 2, ",", ".");
                    }
			?>
            <div class='col-md-4'>
                <div class='product-item'>
                    <a href='pages/produto/<?=$pid?>'><img src='../fotos/produtos/<?=$imagem[0]?>' align='right' class="img" alt='<?=$nome_produto?>' title='Produto: <?=$nome_produto?>'></a>
                    <div class='down-content'>
                        <a href='pages/produto/<?=$pid?>'><h4><?=$nome_produto?></h4></a>
                        <h6><?=$valorUnitario?></h6>
                        <a href='pages/produto/<?=$pid?>' class='btn btn-primary'>Detalhes</a><br>           
                    </div>
                </div>
            </div>
			<?php
                }
            ?>
        </div>
    </div>
</div>
<style>
	.dropdown-item {
		color: white;
	}
</style>