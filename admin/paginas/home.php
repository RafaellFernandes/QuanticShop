<?php
include "validacao/functions.php";
if (!isset($_SESSION["quanticshop"]["id"])) {
    $titulo = "Erro";
    $mensagem = "Usuário Não Logado";
    $icone = "error";
    mensagem($titulo, $mensagem, $icone);
exit;
}

if ($_SESSION["quanticshop"]["nivelAcesso"] != "admin") {
    $titulo = "Erro";
    $mensagem = "Erro na Requisição da Página";
    $icone = "error";
    mensagem($titulo, $mensagem, $icone);
exit;
}

include "config/conexao.php";
?>
<div class="row mb-2 mb-xl-3">
<div><h6> Olá <?=$_SESSION["quanticshop"]["primeiro_nome"]." ".$_SESSION["quanticshop"]["sobrenome"];?> Seja Bem vindo(a).</h6></div>
    <div class="col-auto d-none d-sm-block">
        <h3>Painel de <strong>Análise</strong></h3>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-xxl-5 d-flex">
        <div class="w-100">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <!-- <div class="card-body"> -->
                            <!-- <h5 class="card-title mb-4">TCC</h5>
                            <h4 class="mt-1 mb-3"> -->
                                <?php
                                    // $date = strtotime("June 24, 2021 7:00 PM");
                                    // $remaining = $date - time();
                                    // $days_remaining = floor($remaining / 86400);
                                    // $hours_remaining = floor(($remaining % 86400) / 3600);
                                    // echo "Faltam $days_remaining Dias e $hours_remaining Horas Restantes";
								?>
                            </h4>
                            <!-- <div class="mb-1">
                                <span>Documentação: </span>
                                <span class=" text-danger "> <i class="mdi mdi-arrow-bottom-right"></i>
                                    <?php 
                                    // $rem = strtotime('2021-06-07 19:00:00') - time();
                                    //     $day = floor($rem / 86400);
                                    //     $hr = floor(($rem % 86400) / 3600);
                                    //     $min = floor(($rem % 3600) / 60);
                                    //     $sec = ($rem % 60);
                                    //     if ($day) echo "$day Dias ";
                                    //     if ($hr) echo "$hr Horas ";
                                    //     if ($min) echo "$min Minutos ";
                                    //     if ($sec) echo "$sec Segundos ";
                                    //     echo "Restantes...";
                                    ?>
                                </span>
                            </div> -->
                        </div> 
                    </div>
                </div> 
    <!-- Content Row -->
    <div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-dark shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                       Produtos Vendidos </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                    <?php
                                    $conn = mysqli_connect('localhost','root','','quanticshop');
 
                                    $resultado = mysqli_query($conn, "SELECT sum(vezesVendido) FROM item_venda");
                                    $linhas = mysqli_num_rows($resultado);
                                 
                                    while($linhas = mysqli_fetch_array($resultado)){
                                         echo $linhas['sum(vezesVendido)'].'<br/>';
                                    }
                                 
                                ?>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-dark shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                      Vendas  </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                    <?php
                                    $total = 0;
                                    $n = 1;
                                    $sql = "SELECT count(*) as t FROM item_venda";
                                    $sql = $pdo->query($sql);
                                    $sql = $sql->fetch();
                                    $total = $sql['t'];
                                    echo $total;
                                ?>
                </div>
                <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-dark shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Usuarios
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></div>
                            <?php
                                    $total = 0;
                                    $n = 1;
                                    $sql = "SELECT count(*) as t FROM usuario";
                                    $sql = $pdo->query($sql);
                                    $sql = $sql->fetch();
                                    $total = $sql['t'];
                                    echo $total;
                                ?>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-user fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pending Requests Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-dark shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                        Clientes</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                    <?php
                                    $total = 0;
                                    $n = 1;
                                    $sql = "SELECT count(*) as t FROM cliente";
                                    $sql = $pdo->query($sql);
                                    $sql = $sql->fetch();
                                    $total = $sql['t'];
                                    echo $total;
                                ?>
                </div>
                <div class="col-auto">
                    <i class="fas fa-users fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Content Row -->

    <!-- <div class="col-xl-12 col-xxl-7">
        <div class="card flex-fill w-100">
            <div class="card-header">

                <h5 class="card-title mb-0">Movimento Recente</h5>
            </div>
            <div class="card-body py-3">
                <div class="chart chart-sm">
                    <canvas id="chartjs-dashboard-line"></canvas>
                </div>
            </div>
        </div>
    </div> -->
    
   

<!-- <div class="row">
    <div class="col-12 col-md-6 col-xxl-3 d-flex order-2 order-xxl-3">
        <div class="card flex-fill w-100">
            <div class="card-header">

                <h5 class="card-title mb-0">Uso do navegador</h5>
            </div>
            <div class="card-body d-flex">
                <div class="align-self-center w-100">
                    <div class="py-3">
                        <div class="chart chart-xs">
                            <canvas id="chartjs-dashboard-pie"></canvas>
                        </div>
                    </div>

                    <table class="table mb-0">
                        <tbody>
                            <tr>
                                <td>Chrome</td>
                                <td class="text-end">4306</td>
                            </tr>
                            <tr>
                                <td>Firefox</td>
                                <td class="text-end">3801</td>
                            </tr>
                            <tr>
                                <td>IE</td>
                                <td class="text-end">1689</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
        <div class="card flex-fill w-100">
            <div class="card-header">

                <h5 class="card-title mb-0">Real-Time</h5>
            </div>
            <div class="card-body px-4">
                <div id="world_map" style="height:350px;"></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xxl-3 d-flex order-1 order-xxl-1">
        <div class="card flex-fill">
            <div class="card-header">

                <h5 class="card-title mb-0">Calendario</h5>
            </div>
            <div class="card-body d-flex">
                <div class="align-self-center w-100">
                    <div class="chart">
                        <div id="datetimepicker-dashboard"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-lg-8 col-xxl-9 d-flex">
        <div class="card flex-fill">
            <div class="card-header">

                <h5 class="card-title mb-0">Ultimos Projetos</h5>
            </div>
            <table class="table table-hover my-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th class="d-none d-xl-table-cell">Start Date</th>
                        <th class="d-none d-xl-table-cell">End Date</th>
                        <th>Status</th>
                        <th class="d-none d-md-table-cell">Assignee</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Project Apollo</td>
                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                        <td><span class="badge bg-success">Done</span></td>
                        <td class="d-none d-md-table-cell">Vanessa Tucker</td>
                    </tr>
                    <tr>
                        <td>Project Fireball</td>
                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                        <td><span class="badge bg-danger">Cancelled</span></td>
                        <td class="d-none d-md-table-cell">William Harris</td>
                    </tr>
                    <tr>
                        <td>Project Hades</td>
                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                        <td><span class="badge bg-success">Done</span></td>
                        <td class="d-none d-md-table-cell">Sharon Lessman</td>
                    </tr>
                    <tr>
                        <td>Project Nitro</td>
                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                        <td><span class="badge bg-warning">In progress</span></td>
                        <td class="d-none d-md-table-cell">Vanessa Tucker</td>
                    </tr>
                    <tr>
                        <td>Project Phoenix</td>
                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                        <td><span class="badge bg-success">Done</span></td>
                        <td class="d-none d-md-table-cell">William Harris</td>
                    </tr>
                    <tr>
                        <td>Project X</td>
                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                        <td><span class="badge bg-success">Done</span></td>
                        <td class="d-none d-md-table-cell">Sharon Lessman</td>
                    </tr>
                    <tr>
                        <td>Project Romeo</td>
                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                        <td><span class="badge bg-success">Done</span></td>
                        <td class="d-none d-md-table-cell">Christina Mason</td>
                    </tr>
                    <tr>
                        <td>Project Wombat</td>
                        <td class="d-none d-xl-table-cell">01/01/2021</td>
                        <td class="d-none d-xl-table-cell">31/06/2021</td>
                        <td><span class="badge bg-warning">In progress</span></td>
                        <td class="d-none d-md-table-cell">William Harris</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-12 col-lg-4 col-xxl-3 d-flex">
        <div class="card flex-fill w-100">
            <div class="card-header">

                <h5 class="card-title mb-0">Monthly Sales</h5>
            </div>
            <div class="card-body d-flex w-100">
                <div class="align-self-center chart chart-lg">
                    <canvas id="chartjs-dashboard-bar"></canvas>
                </div>
            </div>
        </div>
    </div>
</div> -->