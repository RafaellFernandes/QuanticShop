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
    $sql = "SELECT * FROM cliente WHERE ativo = 1 ORDER BY id";
    $resultado = $banco->query($sql);
    $banco->close();
    while ($row = mysqli_fetch_array($resultado)) {
        $grupo[] = $row;
    }
    return $grupo;
}

$grupo = selectAllPessoa();

$mpdf->SetDisplayMode("fullpage");

$stylesheet = file_get_contents('stylepdf.css');
date_default_timezone_set('America/Sao_Paulo');

$nome = $_SESSION['quanticshop']['primeiro_nome'];
// $nome =  $_SERVER['HTTP_USER_AGENT'];

$html = "
<h2>Relatório de Clientes Ativos</h2>
<p>Data de Emissão: ". date('d/m/Y H:i:s')."</p>
<p>Nome: ". $nome ."</p><hr/>
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
               
          $html = $html ."  </tbody>
        </table></div>";


$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output();