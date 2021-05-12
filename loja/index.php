<?php
	session_start();
	//mostrar erros
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
	error_reporting(E_ALL);
	
	//definir a pagina como home
	$pagina = "pages/home";

	include "config/conexao.php";

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
		$titulo = "Sobre Nós";

	else if ( $pagina == "contact" )
		$titulo = "Entre em Contato";

	else if ( $pagina == "login" )
		$titulo = "Login";

	else if ( $pagina == "configuracoesConta" )
		$titulo = "Configuração de Conta";
	
	else if ( $pagina == "register" )
		$titulo = "Registre-se";

	else if ( $pagina == "shop" )
		$titulo = "Shop";

	else
		$titulo = "Página Inicial";

	$porta = $_SERVER["SERVER_PORT"];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<title>Quantic Shop - <?=$titulo;?></title>
	<base href="http://<?=$_SERVER['SERVER_NAME']. ":$porta" . $_SERVER['SCRIPT_NAME']?>">
	<link href="vendor/css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="vendor/css/style.css" rel='stylesheet' type='text/css' />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<link rel="shortcut icon" href="vendor/images/saturno.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<script src="vendor/js/jquery.min.js"></script>
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

	 <style>a{text-decoration: none;}</style>

</head>
<body>
  	<div class="header">
		<div class="container">
			<div class="row">
			 	<div class="col-md-12">
				 	<div class="header-left">
						<div class="logo">
							<a href="home"><img src="vendor/images/saturno.png" style="width: 70px; " alt="Quantic Shop - Home"/></a>
						</div>
						<div class="menu">
							<a class="toggleMenu" href="home"><img src="vendor/images/nav.png" alt="Menu" /></a>
							<ul class="nav" id="nav">
								<li><a href="shop">Shop</a></li>
								<li><a href="Home">Home</a></li>
								<li><a href="contact">Contato</a></li>	
								<?php
									if(!isset($_SESSION["quanticshop"]["id"])){
										echo 	'<li><ul class="icon1 sub-icon1 ">
													<li><a href="login">Login</a></li>
												</ul></li>';
									}else{
										echo '<li><ul class="icon1 sub-icon1 ">
										<li><a href="#">Conta</a>
											<ul class="list">
												<div class="check_button dropdown-item"><a href="perfil">Perfil</a></div>
												<div class="check_button dropdown-item"><a href="sair?token='.SHA1(session_id()).'">Sair</a></div>
												<div class="check_button dropdown-item"><a href="configuracoesConta">Configurações de Conta</a></div>             
											</ul>
										</li>
									</ul></li>';
									}
								?>
							</ul>
							<script type="text/javascript" src="vendor/js/responsive-nav.js"></script>
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
						<script src="vendor/js/classie.js"></script>
						<script src="vendor/js/uisearch.js"></script>
						<script>
							new UISearch( document.getElementById( 'sb-search' ) );
						</script>
						<!----//search-scripts---->
						<ul class="icon1 sub-icon1 profile_img">
							<li><a class="active-icon c1" href="#"></a>
								<ul class="sub-icon1 list">
									<div class="product_control_buttons">
										<a href="#"><img src="vendor/images/edit.png" alt=""/></a>
										<a href="#"><img src="vendor/images/close_edit.png" alt=""/></a>
									</div>
									<div class="clear"></div>
									<li class="list_img"><img src="vendor/images/1.jpg" alt=""/></li>
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
				include "pages/error/404.php";
			}
		?>
  	</main>
	<div class="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<ul class="footer_box">
						<h4>Produtos</h4>
						<li><a href="smartphone">Smartphones</a></li>
						<li><a href="notebooks">Notebooks</a></li>
						<li><a href="hardware">Hardwares</a></li>
						<li><a href="gamer">Gamer</a></li>
						<li><a href="smartHome">Smart Home</a></li>
						<li><a href="computadores">Computadores</a></li>
					</ul>
				</div>
				<div class="col-md-3">
					<ul class="footer_box">
						<h4>Sobre</h4>
						<li><a href="sobre">Sobre Nós</a></li>
						<li><a href="#">Empyt</a></li>
					</ul>
				</div>
				<div class="col-md-3">
					<ul class="footer_box">
						<h4>Suporte ao Cliente</h4>
						<li><a href="contact">Contate-Nos</a></li>
						<li><a href="politicaDevolucao">Politica de Devolução</a></li>
						<li><a href="politicaPrivacidade">Politica de Privacidade</a></li>
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
							<li class="twitter"><a href="#"><span> </span></a></li>
							<li class="instagram"><a href="#"><span> </span></a></li>								  				
						</ul>   					
					</ul>
				</div>
			</div>
			<div class="row footer_bottom ">
				<div class="copy">
			    	<p class="text-center">© 2019 - 2021  <a href="home" target="_blank">Quantic Shop™</a></p>
		    	</div>
   			</div>
		</div>
  	</div>  
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>