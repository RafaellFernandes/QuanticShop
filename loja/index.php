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
	<base href="http://<?=$_SERVER['SERVER_NAME']. ":$porta" . $_SERVER['SCRIPT_NAME']?>">
	<style>.cookieConsentContainer{z-index:999;width:350px;min-height:20px;box-sizing:border-box;padding:30px 30px 30px 30px;background:#232323;overflow:hidden;position:fixed;bottom:30px;right:30px;display:none}.cookieConsentContainer .cookieTitle a{font-family:OpenSans,arial,sans-serif;color:#fff;font-size:22px;line-height:20px;display:block}.cookieConsentContainer .cookieDesc p{margin:0;padding:0;font-family:OpenSans,arial,sans-serif;color:#fff;font-size:13px;line-height:20px;display:block;margin-top:10px}.cookieConsentContainer .cookieDesc a{font-family:OpenSans,arial,sans-serif;color:#fff;text-decoration:underline}.cookieConsentContainer .cookieButton a{display:inline-block;font-family:OpenSans,arial,sans-serif;color:#fff;font-size:14px;font-weight:700;margin-top:14px;background:#000;box-sizing:border-box;padding:15px 24px;text-align:center;transition:background .3s}.cookieConsentContainer .cookieButton a:hover{cursor:pointer;background:#3e9b67}@media (max-width:980px){.cookieConsentContainer{bottom:0!important;left:0!important;width:100%!important}}</style>
	<link href="vendor/css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="vendor/css/style.css" rel='stylesheet' type='text/css' />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	 <!-- Font Awesome -->
	 <script src="https://kit.fontawesome.com/862f0da969.js" crossorigin="anonymous"></script>

	 <!-- Ionicons -->
	 <link  rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	
	<link rel="shortcut icon" href="vendor/images/saturno.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<script src="vendor/js/jquery.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
							<a href="vendor/home"><img src="vendor/images/saturno.png" style="width: 70px; " alt="Quantic Shop - Home"/></a>
						</div>
						<div class="menu">
							<a class="toggleMenu" href="home"><img src="vendor/images/nav.png" alt="Menu" /></a>
							<ul class="nav" id="nav">
								<li><a href="pages/home">Home</a></li>
								<li><a href="pages/shop">Shop</a></li>
								<li><a href="pages/sobre">Sobre</a></li>
								<li><a href="pages/contact">Contato</a></li>
								<li><a href="pages/carrinho"><i class="fa fa-cart-plus" aria-hidden="true"></i></a></li>
								<li><ul class="icon1 sub-icon1 ">
								<?php
									if(!isset($_SESSION["quanticshop"]["id"])){
										echo '<li><a href="login/login">Login</a></li>';
									}else{
										echo '<li><a href="#">Conta</a>
												<ul class="list">
													<div class="check_button dropdown-item"><a href="login/perfil">Perfil</a></div>
													<div class="check_button dropdown-item"><a href="login/sair">Sair</a></div>
													<div class="check_button dropdown-item"><a href="login/configuracoesConta">Configurações de Conta</a></div>             
												</ul>
											</li>';
									}
								?></ul></li>
							</ul>
								<div class="header_right">
									<div class="search-box">
										<div class="sb-search">
											<form method="POST" action="">
												<input type="text" name="nome" placeholder="PESQUISAR">
												<input style="background-color:#fff" name="SendPesqUser" type="submit" value="ENVIAR">
											</form>
											<?php
												$SendPesqUser = filter_input(INPUT_POST, 'SendPesqUser', FILTER_SANITIZE_STRING);
												if($SendPesqUser){
													$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
													$result_usuario = "SELECT * FROM produto WHERE nome_produto LIKE '%$nome%'";
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
										<!-- https://celke.com.br/artigo/como-pesquisar-com-php-e-mysqli -->
									</div>
								</div>
								<script type="text/javascript" src="vendor/js/responsive-nav.js"></script>
							</div>	
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
						<!-- <li><a href="#">Empyt</a></li> -->
					</ul>
				</div>
				<div class="col-md-3">
					<ul class="footer_box">
						<h4>Suporte ao Cliente</h4>
						<li><a href="politicas/contact">Contate-Nos</a></li>
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
							<li class="twitter"><a href="https://twitter.com/"><span> </span></a></li>
							<li class="instagram"><a href="https://www.instagram.com/"><span> </span></a></li>	
							<li class="facebook"><a href="https://www.facebook.com/"><span> </span></a></li>								  				
						</ul>   					
					</ul>
				</div>
			</div>
			<div class="row footer_bottom ">
				<div class="copy">
			    	<p class="text-center">© 2019 - 2021  <a href="pages/home" target="_blank">Quantic Shop™</a></p>
		    	</div>
   			</div>
		</div>
  	</div>  
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
	<script>var purecookieTitle="Cookies.",purecookieDesc="Ao usar este site, você aceita automaticamente o uso de Cookies.",purecookieLink='<a href="https://www.cssscript.com/privacy-policy/" target="_blank">O que é?</a>',purecookieButton="Aceito";function pureFadeIn(e,o){var i=document.getElementById(e);i.style.opacity=0,i.style.display=o||"block",function e(){var o=parseFloat(i.style.opacity);(o+=.02)>1||(i.style.opacity=o,requestAnimationFrame(e))}()}function pureFadeOut(e){var o=document.getElementById(e);o.style.opacity=1,function e(){(o.style.opacity-=.02)<0?o.style.display="none":requestAnimationFrame(e)}()}function setCookie(e,o,i){var t="";if(i){var n=new Date;n.setTime(n.getTime()+24*i*60*60*1e3),t="; expires="+n.toUTCString()}document.cookie=e+"="+(o||"")+t+"; path=/"}function getCookie(e){for(var o=e+"=",i=document.cookie.split(";"),t=0;t<i.length;t++){for(var n=i[t];" "==n.charAt(0);)n=n.substring(1,n.length);if(0==n.indexOf(o))return n.substring(o.length,n.length)}return null}function eraseCookie(e){document.cookie=e+"=; Max-Age=-99999999;"}function cookieConsent(){getCookie("purecookieDismiss")||(document.body.innerHTML+='<div class="cookieConsentContainer" id="cookieConsentContainer"><div class="cookieTitle"><a style="color: white;">'+purecookieTitle+'</a></div><div class="cookieDesc"><p>'+purecookieDesc+" "+purecookieLink+'</p></div><div class="cookieButton"><a style="color: white;" onClick="purecookieDismiss();">'+purecookieButton+"</a></div></div>",pureFadeIn("cookieConsentContainer"))}function purecookieDismiss(){setCookie("purecookieDismiss","1",1),pureFadeOut("cookieConsentContainer")}window.onload=function(){cookieConsent()};</script>
</body>
</html>