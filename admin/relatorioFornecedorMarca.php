<?php
session_start();

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/funcaoBancoPDF.php';

$mpdf = new \Mpdf\Mpdf();
$grupo = selectAllPessoa();
$mpdf->SetDisplayMode("fullpage");
$stylesheet = file_get_contents('stylepdf.css');
date_default_timezone_set('America/Sao_Paulo');
$nome = $_SESSION['quanticshop']['primeiro_nome'];

$html = "
<h2>Relatório de Marca Mais Comprada por Fornecedor</h2>
<p>Data de Emissão: ". date('d/m/Y H:i:s')."</p>
<p>Gerado Por: ". $nome ."</p><hr/>
    <div>
        <table>
            <thead>
                <tr>
                <th>ID MARCA <br> NOME MARCA</th>
                <th>ID FORNECEDOR <br> RAZAO SOCIAL</th>
                <th>CNPJ</th>
                <th>EMAIL<br>SITE</th>
                <th>TELEFONE<br>CELULAR</th>
                <th>CIDADE-UF</th>
                </tr>
            </thead>
            <tbody>";
                    foreach ($grupo as $pessoa) {
                
                    $html = $html ."    <tr>
                        <td>{$pessoa["mid"]}<br>{$pessoa["nome_marca"]}</td>
                        <td>{$pessoa["fid"]}<br>{$pessoa["razaoSocial"]}</td>
                        <td>".($pessoa["cnpj"])."</td>
                        <td>{$pessoa["email"]}<br>{$pessoa["siteFornecedor"]}</td>
                        <td>{$pessoa["telefone"]}<br>{$pessoa["celular"]}</td>
                        <td>{$pessoa["cidade_id"]}<br>{$pessoa["cidade"]}-{$pessoa["estado"]}</td>
                        
                     </tr>";
                 }
               
          $html = $html ."  </tbody>
        </table></div>";


$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output();