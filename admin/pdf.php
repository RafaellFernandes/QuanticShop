<?php 
use Mpdf\Mpdf;

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new Mpdf();


$css = file_get_contents('static/css/style.css');
$html = file_get_contents('relatorios/produtoEstoque.php');

$mpdf->WriteHTML($css, 1);
$mpdf->WriteHTML($html);

$mpdf->Output();