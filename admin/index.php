<?php
  //iniciar a sessão
  session_start();

  //mostrar erros
  ini_set('display_errors',1);
  ini_set('display_startup_erros',1);
  error_reporting(E_ALL);

  //iniciar a variavel pagina
  $pagina = "login/login";

  //incluir o arquivo de conexao
  include "config/conexao.php";

  $site   = $_SERVER['SERVER_NAME'];
  $porta  = $_SERVER['SERVER_PORT'];
  $url    = $_SERVER['SCRIPT_NAME'];

  $h = "http";

  if( isset($_SERVER['HTTPS']) ) {
    $h = "https";
  }

  $base = "$h://$site:$porta/$url";

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Site Feito para o TCC">
	<meta name="author" content="Rafael e Juliana">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="static/img/icons/icon-48x48.png" />

	<base href="<?=$base;?>">
	<title>Sistema Quantic</title>

	<link href="static/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

	<script src="assets/mask/jquery.mask.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
  	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
  
	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
	<script src="https://kit.fontawesome.com/862f0da969.js" crossorigin="anonymous"></script>

	<link href="login/styleLogin.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">

	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<style>
		a{
			text-decoration: none;
		}

	</style>
	
</head>

<body>
	<div class="wrapper">
		
	<?php
        //completar o nome da página
        $pagina = $pagina.".php";

        //se não esta logado
        //mostrar tela do login
        if ( !isset ( $_SESSION["quanticshop"]["id"] ) ){
          //incluir o login
          include $pagina;
        } else {

        //mostrar a pagina bonita do template
    ?>
		<nav id="sidebar" class="sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.html" style="text-decoration: none;">
					<span class="align-middle">Quantic Shop</span>
				</a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="paginas/home">
						  <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="login/perfil">
						  <i class="align-middle" data-feather="user"></i> <span class="align-middle">Perfil</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="login/configuracoes">
						  <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Configurações</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="paginas/pages-invoice">
						  <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Fatura</span>
						</a>
					</li>

					<li class="sidebar-header">
						Gerenciamento
					</li>

					<li class="sidebar-item">
						<a href="#cadlist" data-bs-toggle="collapse" class="sidebar-link collapsed">
						  <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Cadastro</span>
						</a>
						<ul id="cadlist" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="cadastro/cidade">Cidade</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="cadastro/clienteF">Cliente Pessoa Fisica</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="cadastro/clienteJ">Cliente Pessoa Juridica</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="cadastro/departamento">Departamentos</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="cadastro/fornecedor">Fornecedor</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="cadastro/marca">Marca</a></li>
							<li class="sidebad-item"><a class="sidebar-link" href="cadastro/produto">Produto</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="cadastro/transportadora">Transportadora</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="cadastro/usuario">Usuario</a></li>
						</ul>
					</li>

					<li class="sidebar-item">
						<a href="#cadlist1" data-bs-toggle="collapse" class="sidebar-link collapsed">
						  <i class="align-middle" data-feather="list"></i> <span class="align-middle">Listagem</span>
						</a>
						<ul id="cadlist1" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="listagem/cidade">Cidade</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="listagem/cliente">Cliente</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="listagem/departamento">Departamentos</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="listagem/fornecedor">Fornecedor</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="listagem/marca">Marca</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="listagem/produto">Produto</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="listagem/transportadora">Transportadora</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="listagem/usuario">Usuario</a></li>
						</ul>
					</li>

					<li class="sidebar-item">
						<a href="#cadlist2" data-bs-toggle="collapse" class="sidebar-link collapsed">
						  <i class="align-middle" data-feather="user-x"></i> <span class="align-middle">Inativados</span>
						</a>
						<ul id="cadlist2" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="lista_inativos/cliente">Cliente</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="lista_inativos/departamento">Departamento</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="lista_inativos/fornecedor">Fornecedor</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="lista_inativos/marca">Marca</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="lista_inativos/produto">Produto</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="lista_inativos/transportadora">Transportadora</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="lista_inativos/usuario">Usuario</a></li>
						</ul>
					</li>

					<li class="sidebar-header">
						Relatórios e Etc
					</li>
					<li class="sidebar-item">
						<a data-bs-target="#ui3" data-bs-toggle="collapse" class="sidebar-link collapsed">
						  <i class="align-middle" data-feather="file"></i> <span class="align-middle">Relatórios</span>
						</a>
						<ul id="ui3" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="relatorios/clientesAtivos">Clientes Ativos</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="relatorios/financeiro">Financeiro</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="relatorios/fornecedorMarca">Marca Mais Comprada por Fornecedor</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="relatorios/produtoMaisVendido">Produto Mais Vendido</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="relatorios/produtoMenosVendido">Produto Menos Vendido</a></li>
						</ul>
					</li>

					<li class="sidebar-header">
						Controle de Processos
					</li>
					<li class="sidebar-item">
						<a data-bs-target="#ui" data-bs-toggle="collapse" class="sidebar-link collapsed">
						  <i class="align-middle" data-feather="shopping-bag"></i> <span class="align-middle">Compra</span>
						</a>
						<ul id="ui" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="processoCompra/produtoCompra">Cadastro</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="processoCompra/listaProduto">Lista Entrada</a></li>
								
						</ul>
					</li>
					<li class="sidebar-item">
						<a data-bs-target="#ui1" data-bs-toggle="collapse" class="sidebar-link collapsed">
						  <i class="align-middle" data-feather="server"></i> <span class="align-middle">Estoque</span>
						</a>
						<ul id="ui1" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="controleEstoque/estoque">Controle Estoque</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="controleEstoque/listaEstoque">Lista Estoque</a></li>
							
							<!-- <li class="sidebar-item"><a class="sidebar-link" href="">null</a></li> -->
						</ul>
					</li>
					<li class="sidebar-item">
						<a data-bs-target="#ui2" data-bs-toggle="collapse" class="sidebar-link collapsed">
						  <i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle">Venda</span>
						</a>
						<ul id="ui2" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
						<li class="sidebar-item"><a class="sidebar-link" href="venda/vendaProduto">Venda</a></li>
						<li class="sidebar-item"><a class="sidebar-link" href="controleEstoque/listaEstoque">Lista Estoque</a></li>
						</ul>
					</li>
				</ul>

				<div class="sidebar-cta">
					<div class="sidebar-cta-content text-center">
						<strong class="d-inline-block mb-2">Quantic Shop</strong>
						<div class="mb-3 text-sm">
							Fazer Logout
						</div>
						<div class="d-grid">
							<a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#sair"><i class="align-middle mr-1" data-feather="log-out"></i> Log out</a>
						</div>
					</div>
				</div>
				
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle d-flex">
          <i class="hamburger align-self-center"></i>
        </a>
				<form class="d-none d-sm-inline-block">
					<div class="input-group input-group-navbar">
						<input type="text" class="form-control" placeholder="Pesquisar..." aria-label="Search">
						<button class="btn" type="button">
							<i class="align-middle" data-feather="search"></i>
						</button>
					</div>
				</form>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none " href="#" data-bs-toggle="dropdown">
							<i class="fas fa-cog"></i>
							</a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
								<img src="../fotos/<?=$_SESSION["quanticshop"]["foto"];?>p.jpg" class="avatar img-fluid rounded me-1" alt="<?=$_SESSION["quanticshop"]["primeiro_nome"];?>" /> <span class="text-dark"><?=$_SESSION["quanticshop"]["primeiro_nome"];?></span>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="login/perfil"><i class="align-middle me-1" data-feather="user"></i> Perfil</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="login/configuracoes"><i class="align-middle me-1" data-feather="settings"></i>Configurações</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#sair"><i class="align-middle mr-1" data-feather="log-out"></i> Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">

					<?php
						//adicionar a programação para abrir a página desejada

						$pagina = "paginas/home.php";

						//verificar se o parametro existe
						if ( isset ( $_GET["parametro"])){
						//recuperar o parametro
						$p = trim ( $_GET["parametro"] );
						//separar por /
						$p = explode("/", $p);

						$pasta 		= $p[0];
						$arquivo  = $p[1];

						//configurar nome do arquivo
						$pagina = "$pasta/$arquivo.php";

						//verificar se o id ou o 3 item existe
						if ( isset ( $p[2] ) )
							$id = $p[2];
						}

						//verificar se a pagina existe
						if ( file_exists($pagina) )
						include $pagina;
						else
						include "paginas/erros/404.php";

					?>
				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a href="../loja/pages/home" class="text-muted" ><strong>Quantic Shop</strong></a> &copy;
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="paginas/politicaPrivacidade">Privacidade</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="paginas/termosCondicoes">Termos</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="sair" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Quantic Shop</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					Deseja Fazer o Logout?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Voltar</button>
					<a  class="btn btn-danger" href="login/sair.php?token='.md5(session_id()).'">Sair</a>
				</div>
			</div>
		</div>
	</div>
	<?php
	//continuação do codigo php
  		}
	?>
	<script src="static/js/app.js"></script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
			var gradient = ctx.createLinearGradient(0, 0, 0, 225);
			gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
			gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
			// Line chart
			new Chart(document.getElementById("chartjs-dashboard-line"), {
				type: "line",
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "Sales ($)",
						fill: true,
						backgroundColor: gradient,
						borderColor: window.theme.primary,
						data: [
							2115,
							1562,
							1584,
							1892,
							1587,
							1923,
							2566,
							2448,
							2805,
							3438,
							2917,
							3327
						]
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					tooltips: {
						intersect: false
					},
					hover: {
						intersect: true
					},
					plugins: {
						filler: {
							propagate: false
						}
					},
					scales: {
						xAxes: [{
							reverse: true,
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}],
						yAxes: [{
							ticks: {
								stepSize: 1000
							},
							display: true,
							borderDash: [3, 3],
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}]
					}
				}
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Pie chart
			new Chart(document.getElementById("chartjs-dashboard-pie"), {
				type: "pie",
				data: {
					labels: ["Chrome", "Firefox", "IE"],
					datasets: [{
						data: [4306, 3801, 1689],
						backgroundColor: [
							window.theme.primary,
							window.theme.warning,
							window.theme.danger
						],
						borderWidth: 5
					}]
				},
				options: {
					responsive: !window.MSInputMethodContext,
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					cutoutPercentage: 75
				}
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Bar chart
			new Chart(document.getElementById("chartjs-dashboard-bar"), {
				type: "bar",
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "This year",
						backgroundColor: window.theme.primary,
						borderColor: window.theme.primary,
						hoverBackgroundColor: window.theme.primary,
						hoverBorderColor: window.theme.primary,
						data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
						barPercentage: .75,
						categoryPercentage: .5
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					scales: {
						yAxes: [{
							gridLines: {
								display: false
							},
							stacked: false,
							ticks: {
								stepSize: 20
							}
						}],
						xAxes: [{
							stacked: false,
							gridLines: {
								color: "transparent"
							}
						}]
					}
				}
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var markers = [{
					coords: [31.230391, 121.473701],
					name: "Shanghai"
				},
				{
					coords: [28.704060, 77.102493],
					name: "Delhi"
				},
				{
					coords: [6.524379, 3.379206],
					name: "Lagos"
				},
				{
					coords: [35.689487, 139.691711],
					name: "Tokyo"
				},
				{
					coords: [23.129110, 113.264381],
					name: "Guangzhou"
				},
				{
					coords: [40.7127837, -74.0059413],
					name: "New York"
				},
				{
					coords: [34.052235, -118.243683],
					name: "Los Angeles"
				},
				{
					coords: [41.878113, -87.629799],
					name: "Chicago"
				},
				{
					coords: [51.507351, -0.127758],
					name: "London"
				},
				{
					coords: [40.416775, -3.703790],
					name: "Madrid "
				}
			];
			var map = new jsVectorMap({
				map: "world",
				selector: "#world_map",
				zoomButtons: true,
				markers: markers,
				markerStyle: {
					initial: {
						r: 9,
						strokeWidth: 7,
						stokeOpacity: .4,
						fill: window.theme.primary
					},
					hover: {
						fill: window.theme.primary,
						stroke: window.theme.primary
					}
				}
			});
			window.addEventListener("resize", () => {
				map.updateSize();
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			document.getElementById("datetimepicker-dashboard").flatpickr({
				inline: true,
				prevArrow: "<span title=\"Previous month\">&laquo;</span>",
				nextArrow: "<span title=\"Next month\">&raquo;</span>",
			});
		});
	</script>

</body>

</html>