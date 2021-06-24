<?php
    if ( !empty ( $id ) ) {
    	$sql = "SELECT p.id pid, p.*, d.*, m.* 
				FROM produto p 
				INNER JOIN departamento d ON (d.id = p.departamento_id)
				INNER JOIN marca m ON (m.id = p.marca_id)
				WHERE p.id = :pid 
				LIMIT 1";

    	$consulta = $pdo->prepare($sql);
    	$consulta->bindParam(':pid', $id);
    	$consulta->execute();

    	$dados = $consulta->fetch(PDO::FETCH_OBJ);

		$promocao             = $dados->promocao;
		$valorUnitario 	      = $dados->valorUnitario;		
		$id                   = $dados->pid;
		$foto                 = $dados->foto;
		$imagem               = "../$foto";
		$imagem               = explode(",", $foto);
								
	}	
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
<!--product details start-->
<div class="product_details mt-60 mb-60">
	<div class="container">
	    <div class="row">
	        <div class="col-lg-6 col-md-6">
	            <div class="product-details-tab">
	                <div id="img-1" class="zoomWrapper single-zoom">
	                    <a href="#">
	                    	<img id="zoom1" src="../fotos/produtos/<?=$imagem[0]?>" data-zoom-image="../fotos/produtos/<?=$imagem[0]?>" alt="big-1">
	                    </a>
	                </div>
	                <div class="single-zoom-thumb">
	                    <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">			  	
							<?php
								foreach ($imagem as $nomeImagem) {
							?>
							<li>
								<a href="#" class="elevatezoom-gallery active"  data-image="../fotos/produtos/<?=$nomeImagem?>" data-zoom-image="../fotos/produtos/<?=$nomeImagem?>" data-update="" title="<?=$dados->nome_produto?>">
									<img src="../fotos/produtos/<?=$nomeImagem?>" alt="<?=$dados->nome_produto?>">
								</a>
							</li>
							<?php
								}
							?>  
	                    </ul>
	                </div>
	            </div>
	        </div>
	        <div class="col-lg-6 col-md-6">
	            <div class="product_d_right">
	                <form name="formProduto" method="post" action="pages/adicionar">
						<input hidden name="id" value="<?=$id?>">
	                    <h1><?=$dados->nome_produto?></h1>
	                    <div class=" product_ratting">
	                        <ul>
	                            <li><a href="#"><i class="fa fa-star"></i></a></li>
	                            <li><a href="#"><i class="fa fa-star"></i></a></li>
	                            <li><a href="#"><i class="fa fa-star"></i></a></li>
	                            <li><a href="#"><i class="fa fa-star"></i></a></li>
	                            <li><a href="#"><i class="fa fa-star"></i></a></li>
	                            <li class="review"><a href="#"> (250 reviews) </a></li>
	                        </ul>
	                    </div>
	                    <div class="price_box">
	                        <span class="current_price"><?=$valorUnitario;?></span>
	                    </div>
	                    <div class="product_desc">
	                        <ul>
	                            <li>Em Estoque</li>
	                        </ul>
	                        <p>Código do Produto: <?=$dados->codigo?></p>
	                    </div>
						<div class="product_timing">
	                        <div data-countdown="2021/06/24"></div>
	                    </div>
	                    <div class="product_variant quantity">
							<label>Quantidade</label>
							<input min="1" max="100" value="1" type="number"  name="quantidadeCarrinho" placeholder="Quantidade" required>
							<button class="button" type="submit">Add ao Carrinho</button>
	                    </div>
	                    <div class="product_meta">
							<span>Marca: <a href="pages/shop"><?=$dados->nome_marca;?></a></span><br>
	                        <span>Departamento: <a href="departamento/<?=$dados->nome_dept;?>"><?=$dados->nome_dept;?></a></span>
	                    </div>
					</form>
	            </div>
	        </div>
	    </div>
	</div>    
</div>
<!--product details end-->
    
<!--product info start-->
<div class="product_d_info mb-60">
    <div class="container">   
        <div class="row">
            <div class="col-12">
                <div class="product_d_inner">   
                    <div class="product_info_button">    
                        <ul class="nav" role="tablist">
                            <li>
                                <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Descrição</a>
                            </li>
                            <li>
                                 <a data-toggle="tab" href="#sheet" role="tab" aria-controls="sheet" aria-selected="false">Especificação</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="info" role="tabpanel" >
                            <div class="product_info_content">
								<p><?=$dados->descricao;?></p>
                            </div>    
                        </div>
                        <div class="tab-pane fade" id="sheet" role="tabpanel" >
                            <div class="product_info_content">
							<p><?=$dados->espec_tecnica;?></p>
                            </div>    
                        </div>
                    </div>
                </div>     
            </div>
        </div>
    </div>    
</div>  
<!--product info end-->
<script src="pages/carrossel/plugins.js"></script>
<script src="pages/carrossel/main.js"></script>