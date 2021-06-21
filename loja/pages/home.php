<!-- Banner Starts Here -->
<div class="banner header-text">
    <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
          <!-- <div class="text-content">
            <h4>Find your car today!</h4>
            <h2>Lorem ipsum dolor sit amet</h2>
          </div> -->
        </div>
        <div class="banner-item-02">
            <div class="text-content">
                <h4>Fugiat Aspernatur</h4>
                <h2>Laboriosam reprehenderit ducimus</h2>
            </div>
        </div>
        <div class="banner-item-03">
            <div class="text-content">
                <h4>Saepe Omnis</h4>
                <h2>Quaerat suscipit unde minus dicta</h2>
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
                $sql = "SELECT p.id pid, p.ativo pativo, p.*, v.*
                        FROM produto p 
                        INNER JOIN item_venda v ON (v.produto_id = p.id)
                        WHERE p.ativo = 1 
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
<div class="call-to-action">
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

<!-- Inicio: Marcas Parceiras  -->
<div class="container-fluid mt-5">
    <h3 class="text-center mt-3 mb-3"><strong>Algumas Marcas Parceiras</strong></h3>
    <section id="clients" class="clients">
        <div class="row" data-aos="zoom-in">
            <div class="row d-flex align-items-center">
              <div class="col-lg-2 col-md-1 col-2">
                  <img src="vendor/img/clients/client-1.png" class="img-fluid" alt="Nvidia">
              </div>
              <div class="col-lg-2 col-md-2 col-2">
                  <img src="vendor/img/clients/client-3.png" class="img-fluid" alt="AMD">
              </div>
              <div class="col-lg-2 col-md-2 col-2">
                  <img src="vendor/img/clients/client-4.png" class="img-fluid" alt="Intel">
              </div>
              <div class="col-lg-2 col-md-2 col-2">
                  <img src="vendor/img/clients/client-2.png" class="img-fluid" alt="Samsung">
              </div>
              <div class="col-lg-2 col-md-2 col-2">
              <img src="vendor/img/clients/client-13.png" class="img-fluid" alt="HyperX">
              </div>
              <div class="col-lg-1 col-md-1 col-2">
                  <img src="vendor/img/clients/client-5.png" class="img-fluid" alt="Apple">
              </div>
            </div>
        </div>
    </section>
</div>
<!-- Fim: Marcas Parceiras  -->

