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
	$banco = "quanticshop";

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
	if ( isset ( $_GET["parametro"] ) ) {

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
	<base href="http://<?=$_SERVER['SERVER_NAME']. ":$porta" . $_SERVER['SCRIPT_NAME']?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="_arquivos/icon/logo.png" rel="shortcut icon">
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="css/style.css" rel='stylesheet' type='text/css' />

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<script src="js/jquery.min.js"></script>
	<!--<script src="js/jquery.easydropdown.js"></script>-->
	<!--start slider -->
	<link rel="stylesheet" href="css/fwslider.css" media="all">
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/fwslider.js"></script>
	<!--end slider -->
	<script type="text/javascript">
		$(document).ready(function() {
			$(".dropdown img.flag").addClass("flagvisibility");

			$(".dropdown dt a").click(function() {
				$(".dropdown dd ul").toggle();
			});
							
			$(".dropdown dd ul li a").click(function() {
				var text = $(this).html();
				$(".dropdown dt a span").html(text);
				$(".dropdown dd ul").hide();
				$("#result").html("Selected value is: " + getSelectedValue("sample"));
			});
							
			function getSelectedValue(id) {
				return $("#" + id).find("dt a span.value").html();
			}

			$(document).bind('click', function(e) {
				var $clicked = $(e.target);
				if (! $clicked.parents().hasClass("dropdown"))
				$(".dropdown dd ul").hide();
			});

			$("#flagSwitcher").click(function() {
				$(".dropdown img.flag").toggleClass("flagvisibility");
			});
		});
	</script>
</head>
<body>
  	<div class="header">
		<div class="container">
			<div class="row">
			 	<div class="col-md-12">
				 	<div class="header-left">
						<div class="logo">
							<a href="home"><img src="images/logo.png" alt="Quantic Shop - Home"/></a>
						</div>
						<div class="menu">
							<a class="toggleMenu" href="#"><img src="images/nav.png" alt="Menu" /></a>
							<ul class="nav" id="nav">
								<li><a href="shop">Shop</a></li>
								<li><a href="Home">Home</a></li>
                			<!-- <li><a href="#">vazio</a></li> -->
								<li><a href="contact">Contato</a></li>								
								<li><ul class="icon1 sub-icon1 ">
										<li><a href="#">Conta</a>
											<ul class="list">
												<div class="check_button dropdown-item"><a href="login">Login</a></div>
												<div class="check_button dropdown-item"><a href="sairCliente">Sair</a></div>
												<div class="check_button dropdown-item"><a href="configuracoesConta">Configurações de Conta</a></div>             
											</ul>
										</li>
								</ul></li>
							</ul>
							<script type="text/javascript" src="js/responsive-nav.js"></script>
				    	</div>							
	    		  		<div class="clear"></div>
	    	  		</div>
	        		<div class="header_right">
						<!-- start search-->
						<div class="search-box">
							<div id="sb-search" class="sb-search">
								<form>
									<input class="sb-search-input" placeholder="Pesquisar..." type="search" name="search" id="search">
									<input class="sb-search-submit" type="submit" value="">
									<span class="sb-icon-search"> </span>
								</form>
							</div>
						</div>
						<!----search-scripts---->
						<script src="js/classie.js"></script>
						<script src="js/uisearch.js"></script>
						<script>
							new UISearch( document.getElementById( 'sb-search' ) );
						</script>
						<!----//search-scripts---->
						<ul class="icon1 sub-icon1 profile_img">
							<li><a class="active-icon c1" href="#"></a>
								<ul class="sub-icon1 list">
									<div class="product_control_buttons">
										<a href="#"><img src="images/edit.png" alt=""/></a>
										<a href="#"><img src="images/close_edit.png" alt=""/></a>
									</div>
									<div class="clear"></div>
									<li class="list_img"><img src="images/1.jpg" alt=""/></li>
									<li class="list_desc">
										<h4>
											<a href="#">velit esse molestie</a>
										</h4>
										<span class="actual">1 x $12.00</span>
									</li>
									
									<div class="login_buttons">
										<div class="check_button"><a href="checkout.html">Check out</a></div>
										<div class="login_button"><a href="login.html">Login</a></div>
										<div class="clear"></div>
									</div>
									
									<div class="clear"></div>
								</ul>
							</li>
				    	</ul>
		        		<div class="clear"></div>
	        		</div>
	      		</div>
		  	</div>
	  	</div>
	</div>
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
	<div class="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<ul class="footer_box">
						<h4>Produtos</h4>
						<li><a href="#">Smartphones</a></li>
						<li><a href="#">Notebooks</a></li>
						<li><a href="#">Hardwares</a></li>
						<li><a href="#">Gamer</a></li>
						<li><a href="#">Smart Home</a></li>
						<li><a href="#">Computadores</a></li>
					</ul>
				</div>
				<div class="col-md-3">
					<ul class="footer_box">
						<h4>Sobre</h4>
						<li><a href="#">Careers and internships</a></li>
						<li><a href="#">Sponserships</a></li>
						<li><a href="#">team</a></li>
						<li><a href="#">Catalog Request/Download</a></li>
					</ul>
				</div>
				<div class="col-md-3">
					<ul class="footer_box">
						<h4>Suporte ao Cliente</h4>
						<li><a href="contact">Contate-Nos</a></li>
						<li><a href="politicaDevolucao">Politica de Devolução</a></li>
						<li><a href="politicaPrivacidade">Politica de Privacidade</a></li>
						<li><a href="#">Garantia</a></li>
						<li><a href="termosCondicoes">Termos e Condições</a></li>
					</ul>
				</div>
				<div class="col-md-3">
					<ul class="footer_box">
						<h4>Newsletter</h4>
						<div class="footer_search">
							<form>
								<input type="text" value="Entre com seu Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Entre com seu Email';}">
								<input type="submit" value="Go">
							</form>
						</div>
						<ul class="social">	
							<li class="facebook"><a href="#"><span> </span></a></li>
							<li class="twitter"><a href="#"><span> </span></a></li>
							<li class="instagram"><a href="#"><span> </span></a></li>								  				
						</ul>   					
					</ul>
				</div>
			</div>
			<div class="row footer_bottom">
				<div class="copy">
			    	<p>© 2019 - 2021  <a href="home" target="_blank">Quantic Shop™</a></p>
		    	</div>
   			</div>
		</div>
  	</div>  
</body>
</html>
	  
<!-- Vendor JS Files -->
<!-- <script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="vendor/php-email-form/validate.js"></script> -->

<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script> -->