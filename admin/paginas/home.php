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
    echo "<script>location.href='http://localhost//QuanticShop/erros/401.php'</script>";
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
<!-- Area Chart -->
<div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-dark">Faturamento (12 Meses)</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Ano', 'Vendas'],
          <?php 
          $sql = "SELECT sum(iv.quantidade*iv.valor) total, date_format(v.data, '%m/%Y') dataM
                FROM venda v
                INNER JOIN item_venda iv ON (v.id = iv.venda_id)
                GROUP BY date_format(v.data, '%m/%Y') 
                ORDER BY dataM
                LIMIT 12";  
            $consulta = $pdo->prepare($sql);
              $consulta->execute();
              while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {        
          ?>
          ['<?=$dados->data?>',  <?=$dados->total?>],
          <?php } ?>
        ]);
   
        var options = {
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>

<div id="curve_chart" class="w-100 h-100" style=""></div>

                                    </div>
                                </div>
                            </div>
                        </div>
