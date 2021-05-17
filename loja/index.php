<?php

	session_start();

	//mostrar erros
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
	error_reporting(E_ALL);

	//criar conexao com banco com PDO
	$servidor = "localhost";
	//em 99% dos casos é localhost

	//usuario de acesso ao banco
	$usuario = "root";
	$senha = "";

	//nome do banco de dados
	$banco = "bancotcc";

	try {
		//criar uma conexao com PDO
		$pdo = new PDO("mysql:host=$servidor;
			dbname=$banco;
			charset=utf8",
			$usuario,
			$senha);

	} catch (PDOException $erro) {

		//mensagem de erro
		$msg = $erro->getMessage();

		echo "<p>Erro ao conectar no banco de dados: $msg </p>";

	}

	//definir a pagina como home
	$pagina = "pages/home";

	//recuperar o parametro
	if ( isset ( $_GET["parametro"] ) )
	{
		$pagina = trim ( $_GET["parametro"]);

		//quebra uma string a partir de um caracter
		$p = explode("/", $pagina);

		//print_r($p);
		// $p[0] - nome da pagina
		// $p[1] - id do registro
		$pagina = $p[0];
	}

	//verificar qual pagina ira carregar
	if ( $pagina == "sobre" )
		$titulo = "Sobre a Quantic Shop";
	else if ( $pagina == "contato" )
		$titulo = "Entre em Contato";
	else if ( $pagina == "departamento" )
		$titulo = "Departamento";
	else
		$titulo = "Página Inicial";

	$porta = $_SERVER["SERVER_PORT"];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <title>Quantic Shop - <?=$titulo;?></title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <base href="http://<?=$_SERVER['SERVER_NAME']. ":$porta" . $_SERVER['SCRIPT_NAME']?>">

  <link href="_arquivos/atomic.png" rel="shortcut icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
  <link href="vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="vendor/venobox/venobox.css" rel="stylesheet">
  <link href="vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="vendor/aos/aos.css" rel="stylesheet">
  <!-- Theme style -->
  <link rel="stylesheet" href="admin/dist/css/adminlte.min.css">
  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/862f0da969.js" crossorigin="anonymous"></script>
  <!-- Ionicons -->
  <link  rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Template Main CSS File -->
  <link href="vendor/css/style.css" rel="stylesheet">
  <link href="vendor/css/styleqs.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <!-- ======= Header ======= -->
  <header id="header" class=" fixed-top" >
    <div class="container-fluid d-flex align-items-center">
      <!--Imagem logo-->
      <a href="home" class="logo mr-2 ml-3"><img src="_arquivos/atomic.png" alt="Quantic Shop" class="img-fluid"></a>
      <h1 class="logo mr-auto"><a href="home" class="navbar-brand">Quantic Shop</a></h1>
      <nav class=" nav-menu ">
        <ul>
          <li><a class="nav-link" href="home"><i class="fas fa-home"></i> Home</a></li>
          <li><a class="nav-link mr-2" href="carrinho"><i class="fa fa-cart-plus" aria-hidden="true"></i> Meu Carrinho</a></li>
          <li class="mt-2 drop-down nav-item dropdown" data-spy="scroll"  data-offset="0"><a href="">Departamento</a>
            <ul>
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
          <li class="drop-down nav-item dropdown mt-2" data-spy="scroll"  data-offset="0"><a href="">Conta</a>
            <ul>
              <li><a class="dropdown-item" href="loginCliente"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
              <li><a class="dropdown-item" href="sairCliente"><i class="fa fa-sign-out" aria-hidden="true"></i> Sair</a></li>
              <li><a class="dropdown-item" href="configuracoesConta"><i class="fa fa-cog" aria-hidden="true"></i> Configurações de conta</a></li>
            </ul>
          </li>

          <form name="buscar" method="post" action="buscar" class="form-inline my-2 my-lg-0 ml-5 mr-4">
          <form name="buscar" method="post" action="buscar" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" name="palavra" placeholder="Pesquisar">
            <button class="btn btn-dark my-2 my-sm-0" type="submit">
                <i class="fas fa-search"></i>
            </button>

          </form>
        </ul>
      </nav><!-- .nav-menu -->
    </div>
  </header><!-- End Header -->
  <main>
    <?php
      //configurar a pagina que ira ser incluida
      $pagina = "pages/".$pagina.".php";
      //verificar se a página existe
      if ( file_exists($pagina) ) {
        include $pagina;
      } else {
        include "pages/404.php";
      }
    ?>
  </main>
  <br>
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="footer-info">
              <br>
              <i class="fab fa-whatsapp"></i>
              <i class="bx bx-envelope"></i><br>
              <strong>Telefone: </strong> +55 (44) 99906-0726
              <br>
              <h8><i>Ou envie um Email para: </i></h8>
              <br>
              <strong>Email:</strong> contato_quanticshop@hotmail.com
              <br>
              <div class="social-links mt-3">
                <a href="https://twitter.com/" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="https://www.facebook.com/" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="https://www.instagram.com/" class="instagram"><i class="bx bxl-instagram"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-md-6 footer-links">
            <h4> Links Uteis</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="contato">Contato</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="sobre">Sobre nós</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="termosCondicoes">Termos e Condições</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="politicaPrivacidade">Politica de Privacidade</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="politicaDevolucao">Politica de Devolução</a></li>
            </ul>
          </div>
          <div class="col-md-6">
            <div class="container">
              <div class="row">
                <h4>  Formas de Pagamento<h4>
                <img src="_arquivos/pagamentos.png">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="copyright">Copyright &copy; Quantic Shop 2020</div>
      <div class="credits">
        <div>
          <a href="politicaPrivacidade">Politica de Privacidade</a> &middot;
          <a href="termosCondicoes">Termos &amp; Condições</a>
        </div>
      </div>
    </div>
  </footer>
  <!-- Fim Footer icofont-simple-up -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up" aria-hidden="true"></i></a>
  <div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="vendor/php-email-form/validate.js"></script>
<script src="vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="vendor/venobox/venobox.min.js"></script>
<script src="vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="vendor/aos/aos.js"></script>
<!-- Template Main JS File -->
<script src="vendor/js/main.js"></script>
<!-- AdminLTE App -->
<script src="admin/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="admin/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="admin/dist/js/demo.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
