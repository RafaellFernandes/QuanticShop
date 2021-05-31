<?php
if (!isset($_SESSION["quanticshop"]["id"])) {
    $titulo = "Erro";
    $mensagem = "Usuário Não Logado";
    $icone = "error";
    mensagem($titulo, $mensagem, $icone);
exit;
}

if ($_SESSION["quanticshop"]["nivelAcesso"] != "admin") {
    $titulo = "Erro";
    $mensagem = "Erro na Requisição da Página";
    $icone = "error";
    mensagem($titulo, $mensagem, $icone);
exit;
}
?>						
<!DOCTYPE html>
<html>
<head>
	<title>Relatório de Vendas</title>
	<meta charset="utf-8">

	<!-- Custom fonts for this template-->
    <link href="static/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

	<script src="assets/mask/jquery.mask.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
  	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
  
	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
	<script src="https://kit.fontawesome.com/862f0da969.js" crossorigin="anonymous"></script>

	<link href="login/styleLogin.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">

	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
	<?php 

		//incluir conexao com o banco
		include "validacao/functions.php";
        include "config/conexao.php";

		//recuperar os dados digitados
		$dataInicial = trim ( $_POST["dataInicial"] ?? NULL);
		$dataFinal = trim ( $_POST["dataFinal"] ?? NULL );
		$filtro = trim ( $_POST["filtro"] ?? NULL );

		//verificar se as datas foram preenchidas
		if ( ( empty ( $dataInicial ) ) or ( empty ( $dataFinal ) ) ) {

			mensagem("Erro", "Digite as datas", "error");
			exit;

		}
		else if ( strtotime( $dataInicial ) > strtotime( $dataFinal ) ) {

			mensagem("Erro","Data final menor que a data inicial","error");
			exit;

		}
		
		

	?>

   <h4>RELATÓRIO</h4>
   <h6 style="color: blue;"><strong>Vendas</strong></h6>

   <table class="table table-bordered table-hover table-striped">
		<thead>
			<th width="5%">ID</th>
			<th width="45%">Nome do Cliente</th>
			<th width="20%">Data</th>
			<th width="15%">Status</th>
			<th width="15%">Total</th>
		</thead>
		<tbody>
			<?php

				//sql para selecionar as vendas
				//data maior que a dataInicial
				//dataFinal seja menor que a data
				$sql = "select v.id, c.primeiro_nome, v.status, 
				date_format(v.data, '%d/%m/%Y') data 
				from venda v 
				inner join cliente c on (c.id = v.cliente_id)
				where v.data >= :dataInicial AND v.data <= :dataFinal 
				order by v.data";
				$consulta = $pdo->prepare($sql);
				$consulta->bindParam(":dataInicial", $dataInicial);
				$consulta->bindParam(":dataFinal", $dataFinal);
				$consulta->execute();

				while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {

					//status
					if ( $dados->status == "P" ) {
						$status = '<span class="badge badge-success">Pago</span>';

					} else if ( $dados->status == "C" ) {
						$status = '<span class="badge badge-warning">Cancelado</span>';

					} else if ( $dados->status == "D" ) {
						$status = '<span class="badge badge-danger">Devolvido</span>';

					} else if ( $dados->status == "E" ) {
						$status = '<span class="badge badge-info">Extraviado</span>';

					} else if ( $dados->status == "A" ) {
						$status = '<span class="badge badge-primary">Aguardando Pagamento</span>';

					} else if ( $dados->status == "T" ) {
						$status = '<span class="badge badge-andrey">Troca</span>';
					} 


					?>
					<tr>
						<td><?=$dados->id?></td>
						<td><?=$dados->nome?></td>
						<td><?=$dados->data?></td>
						<td><?=$status?></td>
						<td class="text-center">R$ <?=getTotal($pdo,$dados->id)?></td>
					</tr>
					<?php

				}

			?>
		</tbody>
	</table>
</body>
</html>
