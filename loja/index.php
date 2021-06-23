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
	switch ($pagina) {
		case $pagina == "sobre" :
			# code...
			$titulo = "Sobre Nós";
			break;
			
		case $pagina == "contact" :
				# code...
			$titulo = "Entre em Contato";
			break;

		case $pagina == "login"  :
			# code...
			$titulo = "Login";
			break;	

		case $pagina == "configuracoesConta" :
			# code...
			$titulo = "Configuração de Conta";
			break;

		case $pagina == "register" :
			# code...
			$titulo = "Registre-se";
			break;	

		case  $pagina == "shop" :
			$titulo = "Shop";
			break;

		default:
			# code...
			$titulo = "Página Inicial";
			break;
		}

	$porta = $_SERVER["SERVER_PORT"];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<title>Quantic Shop - <?=$titulo;?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<base href="http://<?=$_SERVER['SERVER_NAME']. ":$porta" . $_SERVER['SCRIPT_NAME']?>">
	<style>.cookieConsentContainer{z-index:999;width:350px;min-height:20px;box-sizing:border-box;padding:30px 30px 30px 30px;background:#232323;overflow:hidden;position:fixed;bottom:30px;right:30px;display:none}.cookieConsentContainer .cookieTitle a{font-family:OpenSans,arial,sans-serif;color:#fff;font-size:22px;line-height:20px;display:block}.cookieConsentContainer .cookieDesc p{margin:0;padding:0;font-family:OpenSans,arial,sans-serif;color:#fff;font-size:13px;line-height:20px;display:block;margin-top:10px}.cookieConsentContainer .cookieDesc a{font-family:OpenSans,arial,sans-serif;color:#fff;text-decoration:underline}.cookieConsentContainer .cookieButton a{display:inline-block;font-family:OpenSans,arial,sans-serif;color:#fff;font-size:14px;font-weight:700;margin-top:14px;background:#000;box-sizing:border-box;padding:15px 24px;text-align:center;transition:background .3s}.cookieConsentContainer .cookieButton a:hover{cursor:pointer;background:#3e9b67}@media (max-width:980px){.cookieConsentContainer{bottom:0!important;left:0!important;width:100%!important}}</style>
	
	<link href="vendor/css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="vendor/css/style.css" rel='stylesheet' type='text/css' />
	<link rel="shortcut icon" href="img/saturno1.png">
	
	<link rel='stylesheet' href='vendor/css/css.css' type='text/css'>
	<link rel="stylesheet" href="vendor/css/ionicons.min.css">
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel='stylesheet' href="pages/carrossel/carrossel.css" type='text/css'/>
	<link rel='stylesheet' href="pages/carrossel/owl.css" type='text/css'/>
	<link rel="stylesheet" href="pages/carrossel/style.css" type='text/css'>
	<link rel="stylesheet" href="pages/carrossel/styleProduto.css" type='text/css'>
	<link rel="stylesheet" href="pages/carrossel/customProduto.css" type='text/css'>
	
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<script src="vendor/js/jquery.min.js"></script>
	<script src="vendor/js/sweetalert.js"></script>
	<script src="vendor/js/fontawessome.js"></script>

	<style>
		.img {
			max-width: 50%;
			max-height: 50%;
		}

		a{
			text-decoration: none;
			color: #000;
		}

		.a1{
			color: #fff;
		}

		.a2{
			color: #000;
		}

		.a2:hover{
			color: purple;
		}
	</style>

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

<script type="text/javascript">
	$(document).ready(function(){
		
		//Aqui a ativa a imagem de load
		function loading_show(){
			$('#loading').html("<img src='img/loading.gif'/>").fadeIn('fast');
		}
			
		//Aqui desativa a imagem de loading
		function loading_hide(){
			$('#loading').fadeOut('fast');
		}       
			
		// aqui a função ajax que busca os dados em outra pagina do tipo html, não é json
		function load_dados(valores, page, div)
		{
			$.ajax
				({
					type: 'POST',
					dataType: 'html',
					url: page,
					beforeSend: function(){//Chama o loading antes do carregamento
						loading_show();
					},
					data: valores,
					success: function(msg)
					{
						loading_hide();
						var data = msg;
						$(div).html(data).fadeIn();             
					}
				});
		}
			
		//Aqui eu chamo o metodo de load pela primeira vez sem parametros para pode exibir todos
		load_dados(null, 'pesquisa.php', '#MostraPesq');
			
		//Aqui uso o evento key up para começar a pesquisar, se valor for maior q 0 ele faz a pesquisa
		$('#pesquisaCliente').keyup(function(){
					
			var valores = $('#form_pesquisa').serialize()//o serialize retorna uma string pronta para ser enviada
					
			//pegando o valor do campo #pesquisaCliente
			var $parametro = $(this).val();
					
			if($parametro.length >= 1){
				load_dados(valores, 'pesquisa.php', '#MostraPesq');
			}else{
				load_dados(null, 'pesquisa.php', '#MostraPesq');
			}
		});
		
	});
</script>
</head>
<body>
	<!-- Botao de Subir a Pagina -->
		<a id="subirTopo">
			<i class="fas fa-rocket"></i><br>Subir
		</a>
	<!-- ***** -->

	<!-- ***** Preloader Start ***** -->
	<div id="preloader">
		<div class="jumper">
			<div></div>
			<div></div>
			<div></div>
		</div>
	</div>  
	<!-- ***** Preloader End ***** -->

	<div class="header">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="header-left">
						<div class="logo">
					 		<a href="pages/home"><img src="vendor/images/logo_branco.png" style="width: 90px; " alt="Quantic Shop - Home"/></a>
					 	</div>
						<div class="menu">
							<a class="toggleMenu" href="#"><img src="vendor/images/nav.png" alt="" /></a>
							<ul class="nav" id="nav">
								<li><a href="pages/home">Home</a></li>
								<li><a href="pages/shop">Shop</a></li>
								<li><a href="pages/sobre">Sobre</a></li>
								<li><a href="pages/contact">Contato</a></li>
								<li><a href="pages/carrinho">Carrinho <i class="fa fa-cart-plus" aria-hidden="true"></i></a></li>								
								<div class="clear"></div>
							</ul>
							<script type="text/javascript" src="vendor/js/responsive-nav.js"></script>
						</div>							
	    		    <div class="clear"></div>
	    	    	</div>
					<div class="header_right">
						<div class="search-box">
							<div id="sb-search" class="sb-search">
								<form name="form_pesquisa" id="form_pesquisa" method="post" action="pages/search">
									<input class="sb-search-input" placeholder="Pesquisar Produto ... "  type="search" name="pesquisaCliente" id="pesquisaCliente" value="" tabindex="1">
									<button class="sb-search-submit" type="submit" value="" onclick="carregar()" ></button>
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
							<li class="li"><a class="a1" href="#">Conta</a>
								<ul class="sub-icon1 list">
									<?php
										if(!isset($_SESSION["quanticshop"]["id"])){
											echo ' 	<div class="product_control_buttons">
														<a class="a2" href="login/login">Entre na sua Conta <i class="fa fa-user-plus"></i></a>
													</div>
													<div class="clear"></div>';										
											}else{
												
												$id = $_SESSION["quanticshop"]["id"];
												$sql = "SELECT foto, primeiro_nome FROM cliente WHERE id = $id";
												$consulta = $pdo->prepare($sql);
												$consulta->bindParam(":id", $id);
												$consulta->execute();
												$dados = $consulta->fetch(PDO::FETCH_OBJ);

												echo '<div class="product_control_buttons">
														<a href="login/perfil"><img src="../fotos/'.$dados->foto.'p.jpg" alt="'.$dados->primeiro_nome.'" width=75 height=75/></a>
													</div>
													<div class="login_buttons">
													<br>
														<hr class="my-0" />
														<p class="mt-2 mb-2">Olá '.$dados->primeiro_nome.', Seja Bem Vindo(a)!</p>
														<div class="check_button"><a href="login/perfil">Perfil</a></div>
														<div class="check_button"><a href="login/configuracaoConta">Configurações de Conta</a></div>
														<div class="check_button"><a href="login/sair">Sair</a></div>
														<div class="clear"></div>
													</div>';
											}	
									?>
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
			$pagina = "pages/home.php";
			if ( isset ( $_GET["parametro"])){
				$p = trim ( $_GET["parametro"] );
				$p = explode("/", $p);
				$pasta 		= $p[0];
				$arquivo  = $p[1];
				$pagina = "$pasta/$arquivo.php";
				if ( isset ( $p[2] ) )
					$id = $p[2];
			}
			if ( file_exists($pagina) ){
				include $pagina;

			}else{
				echo "<script>location.href='http://localhost//QuanticShop/error/404.php'</script>";
			}	
		?>
  	</main>
	<div class="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<ul class="footer_box">
						<h4>Produtos</h4>
						<li><a href="departamento/smartphone">Smartphones</a></li>
						<li><a href="departamento/notebooks">Notebooks</a></li>
						<li><a href="departamento/hardware">Hardwares</a></li>
						<li><a href="departamento/gamer">Gamer</a></li>
						<li><a href="departamento/smartHome">Smart Home</a></li>
						<li><a href="departamento/computadores">Computadores</a></li>
					</ul>
				</div>
				<div class="col-md-3">
					<ul class="footer_box">
						<h4>Sobre</h4>
						<li><a href="pages/sobre">Sobre Nós</a></li>
					</ul>
				</div>
				<div class="col-md-3">
					<ul class="footer_box">
						<h4>Suporte ao Cliente</h4>
						<li><a href="pages/contact">Contate-Nos</a></li>
						<li><a href="politicas/politicaDevolucao">Politica de Devolução</a></li>
						<li><a href="politicas/politicaPrivacidade">Politica de Privacidade</a></li>
						<li><a href="politicas/termosCondicoes">Termos e Condições</a></li>
					</ul>
				</div>
				<div class="col-md-3">
					<ul class="footer_box">
						<h4>GOOD NEWS</h4>
						<div class="footer_search">
							<form>
								<input type="text" value="Entre com seu Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Entre com seu Email';}">
								<input type="submit" value="Go">
							</form>
						</div>
						<ul class="social">	
							<li class="twitter"><a href="https://twitter.com/" target="_blank"><span> </span></a></li>
							<li class="instagram"><a href="https://www.instagram.com/" target="_blank"><span> </span></a></li>	
							<li class="facebook"><a href="https://www.facebook.com/" target="_blank"><span> </span></a></li>								  				
						</ul>   					
					</ul>
				</div>
			</div>
			<div class="row footer_bottom">
				<div class="copy">
			    	<p class="text-center">© 2019 - 2021  <a href="pages/home" target="_blank">Quantic Shop™</a></p>
		    	</div>
   			</div>
		</div>
  	</div>   
	<script>
		function carregar(){
			window.location.href="pages/search";
			// window.alert("teste");
		}
	</script>
	<script src="pages/carrossel/owl.js"></script>
	<script src="pages/carrossel/custom.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script>var purecookieTitle="Cookies.",purecookieDesc="Ao usar este site, você aceita automaticamente o uso de Cookies.",purecookieLink='<a href="https://www.cssscript.com/privacy-policy/" target="_blank">O que é?</a>',purecookieButton="Aceito";function pureFadeIn(e,o){var i=document.getElementById(e);i.style.opacity=0,i.style.display=o||"block",function e(){var o=parseFloat(i.style.opacity);(o+=.02)>1||(i.style.opacity=o,requestAnimationFrame(e))}()}function pureFadeOut(e){var o=document.getElementById(e);o.style.opacity=1,function e(){(o.style.opacity-=.02)<0?o.style.display="none":requestAnimationFrame(e)}()}function setCookie(e,o,i){var t="";if(i){var n=new Date;n.setTime(n.getTime()+24*i*60*60*1e3),t="; expires="+n.toUTCString()}document.cookie=e+"="+(o||"")+t+"; path=/"}function getCookie(e){for(var o=e+"=",i=document.cookie.split(";"),t=0;t<i.length;t++){for(var n=i[t];" "==n.charAt(0);)n=n.substring(1,n.length);if(0==n.indexOf(o))return n.substring(o.length,n.length)}return null}function eraseCookie(e){document.cookie=e+"=; Max-Age=-99999999;"}function cookieConsent(){getCookie("purecookieDismiss")||(document.body.innerHTML+='<div class="cookieConsentContainer" id="cookieConsentContainer"><div class="cookieTitle"><a style="color: white;">'+purecookieTitle+'</a></div><div class="cookieDesc"><p>'+purecookieDesc+" "+purecookieLink+'</p></div><div class="cookieButton"><a style="color: white;" onClick="purecookieDismiss();">'+purecookieButton+"</a></div></div>",pureFadeIn("cookieConsentContainer"))}function purecookieDismiss(){setCookie("purecookieDismiss","1",1),pureFadeOut("cookieConsentContainer")}window.onload=function(){cookieConsent()};</script>
	<script type="text/javascript">
		jQuery(document).ready(function(){

		jQuery("#subirTopo").hide();

		jQuery('a#subirTopo').click(function () {
				jQuery('body,html').animate({
				scrollTop: 0
				}, 200);
				return false;
		});

		jQuery(window).scroll(function () {
				if (jQuery(this).scrollTop() > 1000) {
					jQuery('#subirTopo').fadeIn();
				} else {
					jQuery('#subirTopo').fadeOut();
				}
			});
		});
	</script>
</body>
</html>