<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/funcaoBancoPDF.php';

$mpdf = new \Mpdf\Mpdf();

$grupo = selectAllEstoque();
$nome = nomePessoa();
$data = dataEmissao();

$mpdf->SetDisplayMode("fullpage");
$stylesheet = file_get_contents('stylepdf.css');

$html = "
<h1 class='h2'><img src='img/saturno.png' width='50' height='50'> Quantic Shop ☄</h1>
<h2>Relatório Gerencial de Estoque</h2>
<p class='p1'>Data de Emissão: ".$data."</p><hr/>
    <div>
        <table>
            <thead>
                <tr>
                    <th>ID<br>PRDT</th>
                    <th class='numero'>CODIGO</th>
                    <th class='nome'>PRODUTO</th>
                    <th>ID<br>ETQ</th>
                    <th>QTDE<br>ESTOQUE</th>
                    <th>LOTE</th>
                    <th>DATA CADASTRO</th>
                    <th>QTDE<br>COMPRA</th>
                    <th>CUSTO<br>UNITARIO</th>
                   
                </tr>
            </thead>
            <tbody>";
                foreach ($grupo as $estoque) {
                    
                    $html = $html ."    <tr>
                        <td>{$estoque["pid"]}</td>
                        <td>".($estoque["codigo"])."</td>
                        <td>".($estoque["nome_produto"])."</td>
                        <td>{$estoque["eid"]}</td>
                        <td>{$estoque["qtd_estoque"]}</td>
                        <td>{$estoque["lote"]}</td>
                        <td>{$estoque["dataCadastro"]}</td>
                        <td>R$ ".($estoque["qtdProdutoComprado"])."</td>
                        <td>".($estoque["custo_unitario"])."</td>
                        
                    </tr>";
                }
                   
          $html = $html ."  
            </tbody>
        </table>
    </div><hr/>
    <p class='p2'>Gerado Por: ". $nome ."</p>";


$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output();