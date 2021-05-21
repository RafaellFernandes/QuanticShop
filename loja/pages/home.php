<style>
.video{
  width: 100%;
  height:auto;
}
</style>

<div id="myCarousel" class="carousel slide" data-bs-ride="carousel" id="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="5" aria-label="Slide 6"></button>
  </div>
  <div class="carousel-inner">

    <div class="carousel-item active ">
      <!-- <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg> -->
      <img src="vendor/images/produtos_slide/geladeiraEvolution.webp">
    </div>

    <div class="carousel-item video" id="video">
      <video class="bg_video" autobuffer autostart autoplay loop id="video" name="video">
        <source src="vendor/images/produtos_slide/2021-windfree.webm" type="video/webm">
      </video>
      <div class="container">
        <div class="carousel-caption text-start" style="color: black; text-decoration: bold;">
          <h1>Wind Free</h1>
          <p>O Clima Perfeito </br> Sem Vento</p>
          <p><a class="btn btn-sm btn-primary" href="#">Saiba mais</a></p>

        </div>
      </div>
    </div>

    <div class="carousel-item video"  id="video">
      <video class="bg_video" preload autobuffer autostart autoplay loop id="video" width="100%" height="100%" >
        <source src="vendor/images/produtos_slide/nestAudio.mp4" type="video/mp4" >
      </video>
      <div class="container">
        <div class="carousel-caption text-start" style="color: black; text-decoration: bold;">
          <h1>Google Nest Audio</h1>
          <p><a class="btn btn-sm btn-primary" href="#">Saiba mais</a></p>
        </div>
      </div>
    </div>

    <div class="carousel-item video"  id="video">
      <video class="bg_video" preload autobuffer autostart autoplay loop id="video" >
        <source src="vendor/images/produtos_slide/galaxys21.webm" type="video/webm" >
      </video>
      <div class="container">
        <div class="carousel-caption text-start" style="color: black; text-decoration: bold;">
          <h1 >Samsung Galaxy S21</h1>
          <p><a class="btn btn-sm btn-primary" href="#">Saiba mais</a></p>
        </div>
      </div>
    </div>

    <div class="carousel-item ">
      <img src="vendor/images/produtos_slide/hx-cloud-2-wireless.jpg"  width="100%" height="100%">
      <div class="container">
        <div class="carousel-caption text-start">
          <h1>HyperX Cloud 2 Wireless</h1>
          <p><a class="btn btn-sm btn-primary" href="#">Saiba mais</a></p>
        </div>
      </div>
    </div>

    <div class="carousel-item ">
      <img src="vendor/images/produtos_slide/hx-keyfeatures.jpg" width="110%" height="auto">
      <div class="container">
        <div class="carousel-caption text-start">
          <h1>HyperX </h1>
          <p><a class="btn btn-sm btn-primary" href="#">Saiba mais</a></p>
        </div>
      </div>
    </div>

  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<script>
    // capturar evento 'play'
    $('video').on('play', function (e) {
        $("#carousel").carousel('pause');
    });

    //capturar os 3 eventos, stop pause e ended
    $('video').on('stop pause ended', function (e) {
        $("#carousel").carousel();
    });
</script>

 <!-- ============================================== -->

<!-- <div class="main">
	<div class="content-top">
		<h2>Destaques</h2>
	
		<div class="close_but"><i class="close1"> </i></div>
		<ul id="flexiselDemo3">
			<li><img src="vendor/images/board1.jpg" /></li>
			<li><img src="vendor/images/board2.jpg" /></li>
			<li><img src="vendor/images/board3.jpg" /></li>
			<li><img src="vendor/images/board4.jpg" /></li>
			<li><img src="vendor/images/board5.jpg" /></li>
		</ul>
		<h3>Produtos em Destaque</h3>
		<script type="text/javascript">
      $(window).load(function() {
        $("#flexiselDemo3").flexisel({
          visibleItems: 5,
          animationSpeed: 1000,
          autoPlay: true,
          autoPlaySpeed: 3000,    		
          pauseOnHover: true,
          enableResponsiveBreakpoints: true,
          responsiveBreakpoints: { 
            portrait: { 
              changePoint:480,
              visibleItems: 1
            }, 
            landscape: { 
              changePoint:640,
              visibleItems: 2
            },
            tablet: { 
              changePoint:768,
              visibleItems: 3
            }
          }
        }); 
		  });
		</script>
		<script type="text/javascript" src="vendor/js/jquery.flexisel.js"></script>
	</div>
</div> -->

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
								//separar os dados
								$pid 		                     = $dados->pid;
                $foto                        = $dados->foto;
                $nome_produto 		           = $dados->nome_produto;
                $valor_unitario              = $dados->valor_unitario;
                $valor_unitario              = number_format($valor_unitario,2, '.' , ',');
                $vezesVendido                = $dados->vezesVendido;
                $imagem                      = "../fotos/".$foto."p.jpg";
                $pativo					             = $dados->pativo;

								//mostrar na tela
								if ($pativo == "1"){
                  echo '<div class="col-12 col-md-4">
                  <div class="card " style="width: 18rem;">
                        <img src="'.$imagem.'" class="card-img-top" alt="'.$nome_produto.'">
                          <div class="card-body">
                            <h5 class="card-title">'.$nome_produto.'</h5>
                            <p class="card-text">R$ '.$valor_unitario.'</p>
                            <a href="products/'.$pid.'" class="btn btn-primary">Comprar</a>
                          </div>
                        </div>
                        </div>
                    ';
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