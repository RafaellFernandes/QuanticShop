<div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-touch="false" data-bs-pause="false">
    <div class="carousel-inner">
        <div class="carousel-item active"  data-bs-interval="8000">
            <img src="vendor/images/produtos_slide/geladeiraEvolution.webp" class="d-block w-100" alt="Geladeira Samsung Evolution" width="1400px" height="600px">
        </div>
        <div class="carousel-item" data-bs-interval="5000">
            <video class="bg_video" preload autobuffer autostart autoplay loop >
                <source src="vendor/images/produtos_slide/galaxys21-videodisplay.webm" type="video/webm">
            </video>
        </div>
        <div class="carousel-item"  data-bs-interval="8000">
            <img src="vendor/images/produtos_slide/geladeiraEvolution.webp" class="d-block w-100" alt="..." width="1400px" height="600px">
        </div>
        <div class="carousel-item"  data-bs-interval="4000">
            <video class="bg_video" autobuffer autostart autoplay loop name="video" >
                <source src="vendor/images/produtos_slide/2021-windfree.webm" type="video/webm">
            </video>
        </div>
        <div class="carousel-item"  data-bs-interval="8000">
            <img src="vendor/images/produtos_slide/geladeiraEvolution.webp" class="d-block w-100" alt="..." width="1400px" height="600px">
        </div>
        
        <div class="carousel-item"  data-bs-interval="6000">
            <video class="bg_video" autobuffer autostart autoplay loop name="video" >
                <source src="vendor/images/produtos_slide/windfreev.webm" type="video/webm">
            </video>
        </div>
       
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
 <!-- ============================================== -->

<div class="main">
	<div class="content-top">
		<h2>Destaques</h2>
        <?php
			$SendPesqUser = filter_input(INPUT_POST, 'SendPesqUser', FILTER_SANITIZE_STRING);
			if($SendPesqUser){
				$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
				$result_usuario = "SELECT * FROM produto WHERE nome_produto LIKE '%$nome%' ";
				$resultado_usuario = mysqli_query($conn, $result_usuario);
				while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
					echo "ID: " . $row_usuario['id'] . "<br>";
					echo "Nome: " . $row_usuario['nome_produto'] . "<br>";
					echo "E-mail: " . $row_usuario['valor_unitario'] . "<br>";
					echo "<a href='edit_usuario.php?id=" . $row_usuario['id'] . "'>Editar</a><br>";
					echo "<a href='proc_apagar_usuario.php?id=" . $row_usuario['id'] . "'>Apagar</a><br><hr>";
                    
				}
			}
		?>
	</div>
</div>

<div class="content-bottom prod">
    <div class="container-fluid">
        <div class="row content_bottom-text">
           <div class="col-md-12">
                <h3 class="text-center">Produtos Mais Comprados</h3>
                <h5 class="mb-5 text-center"><b>Esses são os Produtos Mais Comprados pelos Nossos Clientes, de uma olhada Tambem!<b></h5>
                <div class="container">
                    <div class="row justify-content-center">
                      <?php
                        $sql = "SELECT p.id pid, p.ativo pativo, p.*
                                FROM produto p 
                                ORDER BY p.vezesVendido DESC";

                        $consulta = $pdo->prepare($sql);
                        $consulta->execute();                            

                          while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
                          //separar
                          $pid 		                     = $dados->pid;
                          $foto                        = $dados->foto;
                          $nome_produto 		           = $dados->nome_produto;
                          $venda_unitaria              = $dados->venda_unitaria;
                        
                          $vezesVendido                = $dados->vezesVendido;
                          $foto                        = "../fotos/".$foto."p.jpg";
                          $pativo					             = $dados->pativo;
                        
                    
                          //se tiver promo - valor = valor da promo
                          //senao valor = valor do produto
                    
                          //se a promo esta vazio - valor = valor do produto
                          if ( empty ( $promocao ) ) {
                              //1499.99 -> 1.499,99
                              $venda_unitaria = "R$ " . number_format($venda_unitaria, 2, ",", ".");
                              $desc = "";
                          } else {
                              //valor normal
                              $desc = "R$ " . number_format($venda_unitaria, 2, ",", ".");
                              //valor promocional
                              $venda_unitaria = "R$ " . number_format($promocao, 2, ",", ".");
                          }
                          //mostrar na tela
                          if ($pativo == "1"){
                              echo "<div class='col-3 text-center'>
                              <img src='fotos/$foto' class='w-65'>
                              <p>$nome_produto</p>
                              
                              <p class='valor'>R$ $venda_unitaria</p>
                              <a href='pages/produto/$pid'
                              class='btn btn-info'>Detalhes</a><br>
                              </div>";
            
                        }
                        }
                      ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <h3 class="text-center mt-3 mb-3"><strong>Marcas Parceiras</strong></h3>
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
                  <img src="vendor/img/clients/client-9.png" class="img-fluid" alt="Xiaomi">
              </div>
              <div class="col-lg-1 col-md-1 col-2">
                  <img src="vendor/img/clients/client-5.png" class="img-fluid" alt="Apple">
              </div>
              <div class="col-lg-2 col-md-2 col-2">
                  <img src="vendor/img/clients/client-6.png" class="img-fluid" alt="Google">
              </div>
              <div class="col-lg-2 col-md-2 col-2">
                  <img src="vendor/img/clients/client-22.png" class="img-fluid" alt="Microsoft">
              </div>
              <div class="col-lg-2 col-md-2 col-2">
                 <img src="vendor/img/clients/client-13.png" class="img-fluid" alt="HyperX">
              </div>
              <div class="col-lg-2 col-md-2 col-2">
                  <img src="vendor/img/clients/client-12.png" class="img-fluid" alt="Redragon">
              </div>
              <div class="col-lg-2 col-md-2 col-2">
                  <img src="vendor/img/clients/client-19.png" class="img-fluid" alt="DxRacer">
              </div>
              <div class="col-lg-2 col-md-2 col-2">
                  <img src="vendor/img/clients/client-7.png" class="img-fluid" alt="Lenovo">
              </div>
            </div>
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>