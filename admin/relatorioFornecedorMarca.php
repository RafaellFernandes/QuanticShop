<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/funcaoBancoPDF.php';

$mpdf = new \Mpdf\Mpdf();

$grupo = selectAllMarca();
$nome = nomePessoa();
$data = dataEmissao();

$mpdf->SetDisplayMode("fullpage");
$stylesheet = file_get_contents('stylepdf.css');

$html = "
<h1 class='h2'><img src='img/saturno.png' width='50' height='50'> Quantic Shop ☄</h1>
<h2>Relatório de Marca Mais Comprada por Fornecedor</h2>
<p>Data de Emissão: ". $data ."</p><hr/>

    <div>
        <table>
            <thead>
                <tr>
                <th class='nome'>ID MARCA <br> NOME MARCA</th>
                <th class='nome'>ID FORNECEDOR <br> RAZAO SOCIAL</th>
                <th>CNPJ</th>
                <th>EMAIL<br>SITE</th>
                <th class='numero'>TELEFONE<br>CELULAR</th>
                <th>ID<br>CIDADE-UF</th>
                </tr>
            </thead>
            <tbody>";
            foreach ($grupo as $marca) {
                
                $html = $html ."    <tr>
                    <td>{$marca["mid"]}<br>{$marca["nome_marca"]}</td>
                    <td>{$marca["fid"]}<br>{$marca["razaoSocial"]}</td>
                    <td>".($marca["cnpj"])."</td>
                    <td>{$marca["email"]}<br>{$marca["siteFornecedor"]}</td>
                    <td>{$marca["telefone"]}<br>{$marca["celular"]}</td>
                    <td>{$marca["cidade_id"]}<br>{$marca["cidade"]}-{$marca["estado"]}</td>
                    
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