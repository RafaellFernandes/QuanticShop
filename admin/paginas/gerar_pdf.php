<?php	

	include_once("config/conexao.php");

	$html = '<table border=1';	
	$html .= '<thead>';
	$html .= '<tr>';
	$html .= '<th>ID</th>';
	$html .= '<th>codigo</th>';
	$html .= '<th>nome_produto</th>';
	$html .= '<th>valor_unitario</th>';
	$html .= '<th>ativo</th>';
	$html .= '<th>marca_id</th>';
	$html .= '<th>departamento_id</th>';
	$html .= '</tr>';
	$html .= '</thead>';
	$html .= '<tbody>';
	
	$result_transacoes = "SELECT * FROM produto";
	$resultado_trasacoes = mysqli_query($conn, $result_transacoes);
	while($row_transacoes = mysqli_fetch_assoc($resultado_trasacoes)){
		$html .= '<tr><td>'.$row_transacoes['id'] . "</td>";
		$html .= '<td>'.$row_transacoes['codigo'] . "</td>";
		$html .= '<td>'.$row_transacoes['nome_produto'] . "</td>";
		$html .= '<td>'.$row_transacoes['valor_unitario'] . "</td>";
		$html .= '<td>'.$row_transacoes['ativo'] . "</td>";
		$html .= '<td>'.$row_transacoes['marca_id'] . "</td>";
		$html .= '<td>'.$row_transacoes['departamento_id'] . "</td></tr>";		
	}
	
	$html .= '</tbody>';
	$html .= '</table';

	
	//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;

	// include autoloader
	require_once("../pdf/autoload.inc.php");

	//Criando a Instancia
	$dompdf = new DOMPDF();
	
	// Carrega seu HTML
	$dompdf->load_html('
			<h1 style="text-align: center;">Celke - Relatório de Transações</h1>
			'. $html .'
		');

	//Renderizar o html
	$dompdf->render();

	//Exibibir a página
	$dompdf->stream(
		"relatorio_celke.pdf", 
		array(
			"Attachment" => false //Para realizar o download somente alterar para true
		)
	);
?>