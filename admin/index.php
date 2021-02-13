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
  //$url    = $_SERVER['SERVER_NAME'];

  $h = "http";

  if( isset($_SERVER['HTTPS']) ) {
    $h = "https";
  }

  $base = "$h://$site:$porta/$url";

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <base href="<?=$base;?>">
  
	<link rel="shortcut icon" href="assets/img/icons/icon-48x48.png" />
  
  <title> QS - Sistem </title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> <!-- <script>$(document).ready(function(){alert('funcionou a instalação!');});</script>  -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/862f0da969.js" crossorigin="anonymous"></script>
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <!-- <link href="assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" /> -->
  <!-- <link href="assets/demo/demo.css" rel="stylesheet" />  -->
  <link href="assets/css/app.css" rel="stylesheet">
</head>

<body>

      <?php
        //completar o nome da página
        $pagina = $pagina.".php";

        //se não esta logado
        //mostrar tela do login
        if ( !isset ( $_SESSION["bancotcc"]["id"] ) ){
          //incluir o login
          include $pagina;
        } else {

        //mostrar a pagina bonita do template
    ?>
   <div class="wrapper">
		<nav id="sidebar" class="sidebar">

     	<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="paginas/home">
          <span class="align-middle">Quantic Shop</span>
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Paginas
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="paginas/home">
              <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
            </a>
					</li>

          <li class="sidebar-item">
						<a href="#cad" data-toggle="collapse" class="sidebar-link collapsed">
              <i class="align-middle" data-feather="users"></i> <span class="align-middle">Cadastros</span>
            </a>
						<ul id="cad" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="cadastro/cidade">Cidade</a></li>
              <li class="sidebar-item"><a class="sidebar-link" href="cadastro/cliente">Cliente</a></li>
              <li class="sidebar-item"><a class="sidebar-link" href="cadastro/departamento">Departamentos</a></li>
              <li class="sidebar-item"><a class="sidebar-link" href="cadastro/fornecedor">Fornecedor</a></li>
              <li class="sidebar-item"><a class="sidebar-link" href="cadastro/marca">Marca</a></li>
              <li class="sidebar-item"><a class="sidebar-link" href="cadastro/produto">Produto</a></li>
              <li class="sidebar-item"><a class="sidebar-link" href="cadastro/transportadora">Transportadora</a></li>
              <li class="sidebar-item"><a class="sidebar-link" href="cadastro/usuario">Usuario</a></li>
						</ul>
          </li>
          
          <li class="sidebar-item">
						<a href="#list" data-toggle="collapse" class="sidebar-link collapsed">
              <i class="align-middle" data-feather="users"></i> <span class="align-middle">Listagem</span>
            </a>
						<ul id="list" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
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
						<a class="sidebar-link" href="paginas/pages-invoice">
              <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Invoice</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="paginas/pages-blank">
              <i class="align-middle" data-feather="book"></i> <span class="align-middle">Pagina em Branco</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a href="#auth" data-toggle="collapse" class="sidebar-link collapsed">
              <i class="align-middle" data-feather="users"></i> <span class="align-middle">Autenticação</span>
            </a>
						<ul id="auth" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="paginas/pages-sign-in">Entrar</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="paginas/pages-sign-up">Cadastrar</a></li>
						</ul>
					</li>

					<li class="sidebar-header">
						Ferramentas e Componentes
					</li>
	
					<li class="sidebar-item">
						<a data-target="#forms" data-toggle="collapse" class="sidebar-link collapsed">
              <i class="align-middle" data-feather="check-circle"></i> <span class="align-middle">Formulários</span>
            </a>
						<ul id="forms" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="paginas/forms-layouts">Form Layouts</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="paginas/forms-basic-inputs">Basic Inputs</a></li>
						</ul>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="paginas/tables-bootstrap">
              <i class="align-middle" data-feather="list"></i> <span class="align-middle">Tabelas</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="paginas/maps-google">
              <i class="align-middle" data-feather="map"></i> <span class="align-middle">Mapas</span>
            </a>
					</li>
				</ul>
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
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">
                <img src="../fotos/<?=$_SESSION["bancotcc"]["Foto"];?>p.jpg" class="avatar img-fluid rounded mr-1" alt="<?=$_SESSION["bancotcc"]["Nome"];?>" /> <span class="text-dark"><?=$_SESSION["bancotcc"]["Nome"];?></span>
              </a>
							<div class="dropdown-menu dropdown-menu-right">

								<a class="dropdown-item" href="paginas/pages-profile"><i class="align-middle mr-1" data-feather="user"></i> Perfil</a>
                <a class="dropdown-item" href="#"><i class="align-middle mr-1" data-feather="pie-chart"></i> Analytics</a>
                
                <div class="dropdown-divider"></div>
                
								<a class="dropdown-item" href="login/configuracoes"><i class="align-middle mr-1" data-feather="settings"></i> Configurações & Privacidade</a>
               
                <div class="dropdown-divider"></div>
                
								<a class="dropdown-item"  href="login/sair.php?token='.md5(session_id()).'">Log out</a>
							</div>
						</li>
					</ul>
				</div>
      </nav>		
      <main class="content">
      <div class="container-fluid">
        <!-- <div class="container-fluid p-0"> -->
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
              include "paginas/404.php";

          ?>
        </div>
      </main>
     <!-- Fim Corpo/Home -->
     <!-- Inicio Footer -->
     <footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-left">
							<p class="mb-0">
								<a href="../home" class="text-muted"><strong>Quantic Shop</strong></a> &copy;
							</p>
						</div>
						<div class="col-6 text-right">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="#">Suporte</a>
								</li>
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
    
  

<?php
	//continuação do meu codigo php
  }

?>


<script src="assets/js/app.js"></script>
<!--   Core JS Files   -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="assets/mask/jquery.mask.min.js" ></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>

  <!-- <script src="assets/js/core/jquery.min.js"></script> -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <!-- Place this tag in your head or just before your close body tag. -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtweTlU_p3Vq4ctPGUJfCLI9TpU1peRO4"></script>
  <!-- Chart JS -->
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/black-dashboard.min.js?v=1.0.0"></script><!-- Black Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>

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
    var map = new JsVectorMap({
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
      prevArrow: "<span class=\"fas fa-chevron-left\" title=\"Previous month\"></span>",
      nextArrow: "<span class=\"fas fa-chevron-right\" title=\"Next month\"></span>",
    });
  });
</script>

</body>

</html>