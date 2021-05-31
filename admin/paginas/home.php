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
    
    <?php


if ( ! isset ( $_SESSION['quanticshop']['id'] ) ) exit;
?>
<!DOCTYPE html>
<html>
<head>
<title>Relatório de Vendas</title>
<meta charset="utf-8">

<!-- Custom fonts for this template-->
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
</head>
<body>


<h1 class="text-center"></h1>

<table class="table table-hover table-striped table-bordered">
    <thead>
        <th width="5%">ID</th>
        <th width="45%">Nome do Cliente</th>
        <th width="20%">Data</th>
        <th width="15%">Status</th>
        <th width="15%">Total</th>
    </thead>
    <tbody>
        <?php

            //sql para selecionar as vendas
            //data maior que a dataInicial
            //dataFinal seja menor que a data
            $sql = "select v.id, c.primeiro_nome, iv.status, 
            from item_venda iv 
            inner join cliente c on (c.id = v.cliente_id)
            where 
            order by ";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":id", $id);
            $consulta->execute();

            while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {

                //status
                if ( $dados->status == "P" ) {
                    $status = '<span class="badge badge-success">Pago</span>';

                } else if ( $dados->status == "C" ) {
                    $status = '<span class="badge badge-warning">Cancelado</span>';

                } else if ( $dados->status == "D" ) {
                    $status = '<span class="badge badge-danger">Devolvido</span>';

                } else if ( $dados->status == "E" ) {
                    $status = '<span class="badge badge-info">Extraviado</span>';

                } else if ( $dados->status == "A" ) {
                    $status = '<span class="badge badge-primary">Aguardando Pagamento</span>';

                } else if ( $dados->status == "T" ) {
                    $status = '<span class="badge badge-andrey">Troca</span>';
                } 


                ?>
                <tr>
                    <td><?=$dados->id?></td>
                    <td><?=$dados->primeiro_nome?></td>
                    <td><?=$status?></td>
                    <td class="text-center">R$ <?=getTotal($pdo,$dados->id)?></td>
                </tr>
                <?php

            }

        ?>
    </tbody>
</table>
</body>
</html>





<?php


/***************************************
* Pegar o total da venda
************************************** */
function getTotal($pdo, $venda_id) {

    $sql = "select sum(valor * quantidade) total 
    from venda_produto
    where venda_id = :venda_id limit 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":venda_id", $venda_id);
    $consulta->execute();

    $total = $consulta->fetch(PDO::FETCH_OBJ)->total;

    //$dados = $consulta->fetch(PDO::FETCH_OBJ);
    //$total = $dados->total;

    return number_format($total,2,",",".");
} 



?>
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