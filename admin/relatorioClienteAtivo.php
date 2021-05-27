<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/funcaoBancoPDF.php';

$mpdf = new \Mpdf\Mpdf();

$grupo = selectAllPessoa();
$nome = nomePessoa();
$data = dataEmissao();

$mpdf->SetDisplayMode("fullpage");
$stylesheet = file_get_contents('stylepdf.css');

$html = "
<h1 class='h2'><img src='img/saturno.png' width='50' height='50'> Quantic Shop ☄</h1>
<h2>Relatório de Clientes Ativos</h2>
<p>Data de Emissão: ". $data."</p><hr/>

    <div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th class='nome'>NOME</th>
                    <th>CPF/CNPJ</th>
                    <th>EMAIL/SITE</th>
                    <th>TELEFONE/CELULAR</th>
                    <th>CIDADE-UF</th>
                </tr>
            </thead>
            <tbody>";
                foreach ($grupo as $pessoa) {
                    
                    $html = $html ."    <tr>

                    <td>{$pessoa["id"]}</td>
                    <td>".($pessoa["primeiro_nome"]).($pessoa["sobrenome"]).($pessoa["razaoSocial"])."</td>
                    <td>".($pessoa["cpf"]).($pessoa["cnpj"])."</td>
                    <td>".($pessoa["email"])."<br>".($pessoa["siteClienteJuridico"])."</td>
                    <td>".($pessoa["telefone"])."<br>".($pessoa["celular"])."</td>
                    <td>".($pessoa["cidade"])."-".($pessoa["estado"])."</td>
                    </tr>";
                }
            
            $html = $html ."
            </tbody>
        </table>
    </div><hr/>
    <p class='p2'>Gerado Por: ". $nome ."</p>
    ";

$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output();