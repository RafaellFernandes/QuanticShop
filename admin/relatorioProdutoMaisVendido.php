<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/funcaoBancoPDF.php';

$mpdf = new \Mpdf\Mpdf();

$grupo = selectAllProdutoMaisVend();
$nome = nomePessoa();
$data = dataEmissao();

$mpdf->SetDisplayMode("fullpage");
$stylesheet = file_get_contents('stylepdf.css');

$html = "
<h1 class='h2'><img src='img/saturno.png' width='50' height='50'> Quantic Shop ☄</h1>
<h2>Relatório de Produtos Mais Vendidos</h2>
<p>Data de Emissão: ".$data."</p><hr/>
    <div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th class='nome'>NOME PRODUTO</th>
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
        </table></div>
        <hr/>
    <p class='p2'>Gerado Por: ". $nome ."</p>";


$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output();