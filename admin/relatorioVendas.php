<?php
// if (!isset($_SESSION["quanticshop"]["id"])) {
//     $titulo = "Erro";
//     $mensagem = "Usuário Não Logado";
//     $icone = "error";
//     mensagem($titulo, $mensagem, $icone);
// exit;
// }

// if ($_SESSION["quanticshop"]["nivelAcesso"] != "admin") {
//     $titulo = "Erro";
//     $mensagem = "Erro na Requisição da Página";
//     $icone = "error";
//     mensagem($titulo, $mensagem, $icone);
// exit;
// }

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
<!doctype html>
<html lang="pt-br">
  	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>QuanticShop - Relatórios de Venda</title>
		<link rel="shortcut icon" href="img/saturno1.png" />

		<script src="assets/mask/jquery.mask.js"></script>
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" >
		<style>
			.span{
				color: black;
				
			}
		</style>
  	</head>
<body class="mb-5 ml-5 mr-5">
	<div class="container-fluid p-0 mt-5">
		<div class="row">
			<div class="col-12 col-xl-12">
				<div class="card">
					<div class="card-header">
						<h4>RELATÓRIO</h4>
						<h6 style="color: blue;"><strong>Vendas</strong></h6>
						<div class="float-end">
					    <a href="javascript:window.print()" class="btn btn-success">
		                  <i class="fas fa-print"></i>
		                    Imprimir
	                </a> 
					</div> 
					</div>
					
					
					
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
								$sql = "SELECT v.id, v.status, date_format(v.data, '%d/%m/%Y') datav, c.primeiro_nome, c.sobrenome, c.celular  
								FROM venda v 
								INNER JOIN cliente c ON (c.id = v.cliente_id)
								where v.data >= :dataInicial AND v.data <= :dataFinal 
								ORDER BY datav";
								$consulta = $pdo->prepare($sql);
								$consulta->bindParam(":dataInicial", $dataInicial);
								$consulta->bindParam(":dataFinal", $dataFinal);
								$consulta->execute();

								while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {

									//status
									if ( $dados->status == "P" ) {
										$status = '<span class="span badge badge-success">Pago</span>';

									} else if ( $dados->status == "C" ) {
										$status = '<span class="span badge badge-warning">Cancelado</span>';

									} else if ( $dados->status == "D" ) {
										$status = '<span class="span badge badge-danger">Devolvido</span>';

									} else if ( $dados->status == "E" ) {
										$status = '<span class="span badge badge-info">Extraviado</span>';

									} else if ( $dados->status == "A" ) {
										$status = '<span class="span badge badge-primary">Aguardando Pagamento</span>';

									} else if ( $dados->status == "T" ) {
										$status = '<span class="span badge badge-andrey">Troca</span>';
									} 

								
							?>
								<tr>
									<td><?=$dados->id?></td>
									<td><?=$dados->primeiro_nome?> <?=$dados->sobrenome?> - <?=$dados->celular?></td>
									<td><?=$dados->datav?></td>
									<td><?=$status?></td>
									<td class="text-center">R$ <?=getTotal($pdo,$dados->id)?></td>
								</tr>
								<?php

								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>	
</body>
<?php

function getTotal($pdo, $venda_id) {

	$sql = "SELECT sum(valor*quantidade) total 
	FROM item_venda
	WHERE venda_id = :venda_id LIMIT 1";
	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(":venda_id", $venda_id);
	$consulta->execute();

	$total = $consulta->fetch(PDO::FETCH_OBJ)->total;

	//$dados = $consulta->fetch(PDO::FETCH_OBJ);
	//$total = $dados->total;

	return number_format($total,2,",",".");
} 












?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>



</html>