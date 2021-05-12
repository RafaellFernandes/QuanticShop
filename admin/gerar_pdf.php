<?php

use Mpdf\Mpdf;

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new Mpdf();

$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "quanticshop";

$conn = mysqli_connect($servidor, $usuario, $senha, $banco);
 
if (!$conn){
    die("Falha na Conexao ao Banco: " . mysqli_connect_error());
} else {
    //
}


$result_produto = "SELECT * FROM produto ";
$resultado_produto = mysqli_query($conn, $result_produto);

$row_produto = mysqli_fetch_assoc($resultado_produto);

$pagina = "

<html>
    <body>
        <div class='container-fluid p-0'>
            <div class='row'>
                <div class='col-12 col-xl-12'>
                    <div class='card'>
                        <div class='card-header'>
                            <h4>Relatório</h4>
                            <h6 class='card-subtitle text-muted'>Produto Estoque</h6>
                        </div>
                        <table class='table table-bordered table-hover table-striped'>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Código</th>
                                    <th>Produto</th>
                                    <th>Valor</th>
                                    <th>Quantidade Estoque</th>
                                    <th>ID Marca</th>
                                    <th>ID Dept.</th>
                                    <th>ID Estoque</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>".$row_produto['id']."</td>
                                    <td>".$row_produto['codigo']."</td>
                                    <td>".$row_produto['nome_produto']."</td>
                                    <td>R$ ".$row_produto['valor_unitario']."</td>
                                    <td> Null </td>
                                    <td>".$row_produto['marca_id']." - nomeMarca </td>
                                    <td>".$row_produto['departamento_id']." - nomeDept </td>
                                    <td> Null </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html> ";

$mpdf->WriteHTML($pagina);

$mpdf->Output();