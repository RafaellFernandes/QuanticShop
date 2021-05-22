<?php
//verificar se não está logado
if (!isset($_SESSION["quanticshop"]["id"])) {
	exit;
}
include "config/conexao.php";
?>
<div class="row mb-2 mb-xl-3">
<div><h6> Olá <?=$_SESSION["quanticshop"]["primeiro_nome"];?> Seja Bem vindo(a).</h6></div>
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
                        <div class="card-body">
                            <h5 class="card-title mb-4">TCC</h5>
                            <h4 class="mt-1 mb-3">
                                <?php
                                    $date = strtotime("June 24, 2021 7:00 PM");
                                    $remaining = $date - time();
                                    $days_remaining = floor($remaining / 86400);
                                    $hours_remaining = floor(($remaining % 86400) / 3600);
                                    echo "Faltam $days_remaining Dias e $hours_remaining Horas Restantes";
								?>
                            </h4>
                            <div class="mb-1">
                                <span>Documentação: </span>
                                <span class=" text-warning "> <i class="mdi mdi-arrow-bottom-right"></i>
                                    <?php $rem = strtotime('2021-05-30 19:00:00') - time();
                                        $day = floor($rem / 86400);
                                        $hr = floor(($rem % 86400) / 3600);
                                        $min = floor(($rem % 3600) / 60);
                                        $sec = ($rem % 60);
                                        if ($day) echo "$day Dias ";
                                        if ($hr) echo "$hr Horas ";
                                        if ($min) echo "$min Minutos ";
                                        if ($sec) echo "$sec Segundos ";
                                        echo "Restantes...";
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title mb-4">Clientes Cadastrados</h3>
                            <h2 class="mt-1 mb-3">
                                <?php
                                    $total = 0;
                                    $n = 1;
                                    $sql = "SELECT count(*) as t FROM cliente";
                                    $sql = $pdo->query($sql);
                                    $sql = $sql->fetch();
                                    $total = $sql['t'];
                                    echo $total;
                                ?>
                            </h2>
                            <div class="mb-1">
                                <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>+<?=$total; ?> </span>
                                <span class="text-muted"> desde a semana passada</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Produtos Vendidos</h4>
                            <h2 class="mt-1 mb-3">
                                <?php
                                    $conn = mysqli_connect('localhost','root','','quanticshop');
 
                                    $resultado = mysqli_query($conn, "SELECT sum(vezesVendido) FROM produto");
                                    $linhas = mysqli_num_rows($resultado);
                                 
                                    while($linhas = mysqli_fetch_array($resultado)){
                                         echo $linhas['sum(vezesVendido)'].'<br/>';
                                    }
                                 
                                ?>
                            </h2>
                            <div class="mb-1">
                                <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> +25 </span>
                                <span class="text-muted"> desde a semana passada</span>
                            </div>
                        </div>
                    </div><!--
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Ganhos</h5>
                            <h1 class="mt-1 mb-3">$21.300</h1>
                            <div class="mb-1">
                                <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 6.65% </span>
                                <span class="text-muted"> desde a semana passada</span>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Pedidos</h5>
                            <h1 class="mt-1 mb-3">64</h1>
                            <div class="mb-1">
                                <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -2.25% </span>
                                <span class="text-muted"> desde a semana passada</span>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Empty</h5>
                            <h1 class="mt-1 mb-3">00</h1>
                            <div class="mb-1">
                                <span class="text-primary"> <i class="mdi mdi-arrow-bottom-right"></i> 00.00% </span>
                                <span class="text-muted"> desde a semana passada</span>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

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
</div>

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