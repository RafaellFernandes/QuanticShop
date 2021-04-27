<?php
//inclusão da biblioteca
require('../pdf/fpdf.css');
//criamos então um objeto FPDF com os valores padrões, já que não foi especificado
//nenhum parâmetro como tamanho da página, a unidade de media entre outros que veremos posteriormente
$pdf = new FPDF();
//Inserimos uma página
$pdf->AddPage();
#aplicamos então a formatação informando o tipo de fonte, o estilo e o tamanho dela
$pdf->SetFont('Arial','B',16);
#é aqui que criamos o conteúdo da página, esse método só deve ser inserido 
#após formatar a página
#são informadas as distâncias da margem (superior e esquerda) e em seguida colocamos 
#o texto a ser impresso
$pdf->Cell(40,10,'Minha primeira página pdf com FPDF!');
//aqui encerramos o arquivo e enviamos o mesmo para o navegador
//esta linha não deve estar antes de terminar de escrever o conteúdo da página,
//pois ela é responsável por gerar a  saída do arquivo PDF
$pdf->Output();

?>