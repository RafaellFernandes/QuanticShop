<?php
	session_start();

	if ( ! isset ( $_SESSION['quanticshop']['id'] ) ) exit;


    //mostrar erros
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
    error_reporting(E_ALL);
    
?>

<!DOCTYPE html>
<html>
<head>
	<title>Itens</title>
	<meta charset="utf-8">
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
	<!-- <link rel="stylesheet" type="text/css" href="css/sb-admin-2.min.css"> -->
	<!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

	<!-- <script src="vendor/jquery/jquery.min.js"></script> -->
	<!-- <script src="js/sweetalert2.js"></script> -->

    <!-- Custom fonts for this template-->
    <!-- <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
</head>
<body>

<?php

	include "validacao/functions.php";
    include "config/conexao.php";

	if ( $_POST ) {
		
		//recuperar os dados digitados
		foreach ($_POST as $key => $value) {
			$$key = trim ( $value );
		}

		//recuperar o status da venda
		$sql = "select status from venda where id = :venda_id limit 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(":venda_id", $venda_id);
		$consulta->execute();

		//recuperar os dados - status
		$dados = $consulta->fetch(PDO::FETCH_OBJ);
		//$status = $dados->status;

		if ( ( $dados->status == "P") or ( $dados->status == "C" ) ) {
			mensagem("Erro","Esta venda está paga ou cancelada não sendo possível adicionar mais produtos!","error");
			exit;
		}

		if ( empty ( $produto_id ) ) {
			mensagem("Erro","Selecione um produto","error");
			exit;
		} else if ( $quantidade <= 0 ) {
			mensagem("Erro","A quantidade deve ser maior que 0","error");
			exit;
		}

		//print_r ( $_POST );

		//verificar se já existe no banco
		$sql = "select produto_id from item_venda
		where produto_id = :produto_id AND 
		venda_id = :venda_id limit 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(':venda_id', $venda_id);
		$consulta->bindParam(':produto_id', $produto_id);
		$consulta->execute();

		$dados = $consulta->fetch(PDO::FETCH_OBJ);

		//formatar o valor - funcao no docs.php
		$valor= formatarValor($valor);

		if ( empty ( $dados->produto_id ) ){
			//se não existir - inserir
			$sql = "insert into item_venda (valor, quantidade, venda_id, produto_id) values (:valor, :quantidade, :venda_id, :produto_id)";

		} else {
			//se existir - atualizar
			
			$sql = "update item_venda set valor = :valor, quantidade = :quantidade where venda_id = :venda_id AND produto_id = :produto_id limit 1";

		}

		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(':valor', $valor);
		$consulta->bindParam(':quantidade', $quantidade);
		$consulta->bindParam(':venda_id', $venda_id);
		$consulta->bindParam(':produto_id', $produto_id);
		
		//verificar se executou certo - resetar o form
		if ( $consulta->execute() ) {
			echo "<script>top.$('#formItens')[0].reset();</script>";
		}
		

	}

	//recuperar o venda_id
	$venda_id = $_GET["venda_id"] ?? $_POST["venda_id"] ?? NULL;

	//validar a venda_id
	if ( empty ( $venda_id ) ) {
		?>
		<p class="alert alert-danger">Venda inválida</p>
		<?php
		exit;
	}

	//sql para mostrar os produtos
	$sql = "select p.id, p.nome_produto, iv.valor, 
	iv.quantidade, ( iv.valor * iv.quantidade ) total, v.status 
	from item_venda iv
	inner join produto p on ( p.id = iv.produto_id )
	inner join venda v on ( v.id = iv.venda_id )
	where iv.venda_id = :venda_id ";
	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(':venda_id', $venda_id);
	$consulta->execute();
?>

	<table class="table table-hover table-bordered table-striped">
	<thead>
		<th width="5%">ID</th>
		<th width="45%">Produto</th>
		<th width="15%">Valor</th>
		<th width="10%">Qtde</th>
		<th width="15%">Total</th>
		<th width="10%">Excluir</th>
	</thead>
	
	<tbody>
		<?php
			$geral = 0;

			while ( $d = $consulta->fetch(PDO::FETCH_OBJ) ) {

				$disabled = NULL;
				if ( ( $d->status == "C") or ( $d->status == "P" ) ) {
					$disabled = "disabled";
				}
				

				//seprar a variaveis
				$valor = number_format($d->valor,2,
					",",
					".");
				$total = number_format($d->total,2,
					",",
					".");

				//soma do total geral
				$geral = $d->total + $geral;
				
				?>
				<tr>
					<td><?=$d->id?></td>
					<td><?=$d->nome_produto?></td>
					<td class="text-right">R$ <?=$valor?></td>
					<td><?=$d->quantidade?></td>
					<td class="text-right">R$ <?=$total?></td>
					<td>
						<button class="btn btn-danger"onclick="excluir(<?=$venda_id?>,<?=$d->id?>)"
						<?=$disabled?> >
						 	<i class="fas fa-trash"></i>
						 </button>
					</td>
				</tr>
				<?php

			}

			$geral = number_format($geral,2,
				",",
				".");
		?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="4">TOTAL:</td>
			<td colspan="2">R$ <?=$geral?></td>
		</tr>
	</tfoot>
</table>
<script type="text/javascript">
	//passar o venda_id e o id do produto
    function excluir(venda_id, produto_id) {

        Swal.fire({
          title: 'Deseja realmente excluir este registro?',
          showCancelButton: true,
          confirmButtonText: `Sim`,
          cancelButtonText: `Não`,
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            //enviar para excluir
            location.href='excluirItem.php?venda_id='+venda_id+'&produto_id='+produto_id;
            //excluirItem.php?venda_id=1&produto_id=2
          } 
        })
    }
</script>