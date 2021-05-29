<?php


	if ( ! isset ( $_SESSION['quanticshop']['id'] ) ) exit;
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
	

	<h1 class="text-center">Listagem Pedido</h1>

	<table class="table table-hover table-striped table-bordered">
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
				$sql = "select v.id, c.primeiro_nome, iv.status, 
				from item_venda iv 
				inner join cliente c on (c.id = v.cliente_id)
				where 
				order by ";
				$consulta = $pdo->prepare($sql);
				$consulta->bindParam(":id", $id);
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
						<td><?=$dados->primeiro_nome?></td>
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





<?php


	/***************************************
	* Pegar o total da venda
	************************************** */
	function getTotal($pdo, $venda_id) {

		$sql = "select sum(valor * quantidade) total 
		from venda_produto
		where venda_id = :venda_id limit 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(":venda_id", $venda_id);
		$consulta->execute();

		$total = $consulta->fetch(PDO::FETCH_OBJ)->total;

		//$dados = $consulta->fetch(PDO::FETCH_OBJ);
		//$total = $dados->total;

		return number_format($total,2,",",".");
	} 



?>