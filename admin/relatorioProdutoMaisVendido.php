<?php
session_start();

require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();


function abrirBanco(){
    $conexao = new mysqli("localhost", "root", "", "quanticshop");
    return $conexao;
}

function selectAllPessoa(){
    $banco = abrirBanco();
    $sql = "SELECT p.id pid, p.ativo pativo, p.*, m.id mid, m.*, d.id did, d.*  
            FROM produto p 
            INNER JOIN departamento d ON (d.id = p.departamento_id)
            INNER JOIN marca m ON (m.id = p.marca_id)
            WHERE p.ativo = 1
            ORDER BY p.vezesVendido DESC ";

    $resultado = $banco->query($sql);
    $banco->close();
    while ($row = mysqli_fetch_array($resultado)) {
        $grupo[] = $row;
    }
    return $grupo;
}

$grupo = selectAllPessoa();

// $mpdf->SetDisplayMode("fullpage");

$stylesheet = file_get_contents('stylepdf.css');
date_default_timezone_set('America/Sao_Paulo');

$nome = $_SESSION['quanticshop']['primeiro_nome'];
// $nome =  $_SERVER['HTTP_USER_AGENT'];

$html = "
<h2>Relatório de Produtos Mais Vendidos</h2>
<p>Data de Emissão: ". date('d/m/Y H:i:s')."</p>
<p>Gerado Por: ". $nome ."</p><hr/>
    <div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOME PRODUTO</th>
                    <th>CODIGO</th>
                    <th>VALOR UNITARIO</th>
                    <th>VEZES VENDIDA</th>
                    <th>ID - MARCA</th>
                    <th>ID - DEPARTAMENTO</th>
                </tr>
            </thead>
            <tbody>";
                    foreach ($grupo as $pessoa) {
                
                    $html = $html ."    <tr>
                        <td>{$pessoa["pid"]}</td>
                        <td>".($pessoa["nome_produto"])."</td>
                        <td>".($pessoa["codigo"])."</td>
                        <td>R$ ".($pessoa["valor_unitario"])."</td>
                        <td>".($pessoa["vezesVendido"])."</td>
                        <td>".($pessoa["marca_id"])."-".($pessoa["nome_marca"])."</td>
                        <td>".($pessoa["departamento_id"])."-".($pessoa["nome_dept"])."</td>
                     </tr>";
                 }
               
          $html = $html ."  </tbody>
        </table></div>";


$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output();