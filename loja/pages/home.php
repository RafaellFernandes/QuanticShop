<!-- Banner Starts Here -->
<div class="banner header-text">
    <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
          <div class="text-content">
            <h4>QuanticShop</h4>
            <h2 style="color: black;">Nós Trazemos o Futuro.</h2>
          </div>
        </div>
        <div class="banner-item-02">
            <!--  -->
        </div>
        <div class="banner-item-03">
            <div class="text-content">
                <h2>HyperX</h2>
            </div>
        </div>
        <div class="banner-item-04">
            <div class="text-content">
                <h4>Quantic quis tellus.</h4>
                <h2 style="color: black;">Da nobis Future.</h2>
            </div>
        </div>
        <div class="banner-item-05">
            <div class="text-content" style="background-color: rgba(128, 128, 128, 0.5); ">
                <h4>QuanticShop</h4>
                <h2 style="color: black; ">A Modernidade que sua Casa Precisa.</h2>
            </div>
        </div>
    </div>
</div>
<!-- Banner Ends Here -->

<!-- Inicio: Produtos em Destaque  -->
<div class="latest-products">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Produtos em Destaque</h2>
                    <a href="pages/shop">Ver Mais <i class="fa fa-angle-right"></i></a>
                </div>
            </div>
            <?php
                $sql = "SELECT p.id pid, p.ativo pativo, p.*, v.*, e.id eid, e.*
                        FROM produto p 
                        INNER JOIN item_venda v ON (v.produto_id = p.id)
                        INNER JOIN estoque e ON (p.id = e.produto_id)
                        WHERE p.ativo = 1 AND e.qtd_estoque > 10
                        ORDER BY v.vezesVendido DESC LIMIT 6";

                $consulta = $pdo->prepare($sql);
                $consulta->execute();                            

                while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
                    //separar
                    $pid 		        = $dados->pid;
                    $nome_produto 	    = $dados->nome_produto;
                    $valorUnitario      = $dados->valorUnitario;
                    $vezesVendido       = $dados->vezesVendido;
                    $foto               = $dados->foto;
                    $imagem             = explode(",", $foto);
                    $pativo			    = $dados->pativo;
                        
                    //se tiver promo - valor = valor da promo
                    //senao valor = valor do produto
                    
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
                    //mostrar na tela
                    echo "<div class='col-md-4'>
                            <div class='product-item'>
                                <a href='pages/produto/$pid'><img align='right' src='../fotos/produtos/$imagem[0]' class='img' alt='$nome_produto' title='Produto: $nome_produto'></a>
                                <div class='down-content'>
                                    <a href='pages/produto/$pid'><h4>$nome_produto</h4></a>
                                    <h6>$valorUnitario</h6>
                                    <a href='pages/produto/$pid' class='btn btn-primary'>Detalhes</a><br>           
                                </div>
                            </div>
                        </div>";
                }
            ?>
        </div>
    </div>
</div>
<!-- Fim: Produtos em Destaque  -->

<!-- Inicio: Contate-Nos  -->
<div class="call-to-action mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="inner-content">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Alguma Duvida?</h4>
                            <p>Entre em Contato Conosco! :)</p>
                        </div>
                        <div class="col-lg-4 col-md-6 text-right">
                            <a href="pages/contact" class="filled-button">Contate-Nos</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fim: Contate-Nos  -->