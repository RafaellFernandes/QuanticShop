<?php
 if (!isset($_SESSION["quanticshop"]["id"])) {
	$titulo = "Erro";
	$mensagem = "Usuário Não Logado";
	$icone = "error";
	mensagem($titulo, $mensagem, $icone);
exit;
}

if ($_SESSION["quanticshop"]["nivelAcesso"] != "admin") {
	echo "<script>location.href='http://localhost//QuanticShop/erros/401.php'</script>";
exit;
}
?>
<style>
	.span{
		color: black;
		
	}
</style>
<div class="container-fluid p-0">
	<div class="row">
		<div class="col-12 col-xl-12">
			<div class="card">
				<div class="card-header">
					<div class="float-end mt-2">
						<a href="venda/vendaProduto" class="btn btn-primary">Nova Venda</a>
					</div>
					<h4>LISTA</h4>
					<h6 style="color: green;"><strong>Vendas</strong></h6>
				</div>

				<table class="table table-hover table-bordered table-striped">
    		<thead>
    			<tr>
    				<td>ID</td>
    				<td>Cliente</td>
    				<td>Data</td>
    				<td>Status</td>
    				<td>Total</td>
    				<td>Opções</td>
    			</tr>
    		</thead>
    		<tbody>
    			<?php
    				$sql = "SELECT v.id, c.primeiro_nome, c.sobrenome, c.celular, c.telefone, c.razaoSocial,
    				date_format(v.data, '%d/%m/%Y') data, v.status
    				from venda v 
    				inner join cliente c on (c.id = v.cliente_id)
    				order by v.data desc";
    			    $consulta = $pdo->prepare($sql);
    			    $consulta->execute();

    			    while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {

    			    	$status = "<span class='span badge badge-success'>Pago</span>";

    			    	if ( $dados->status == "C" )
    			    		$status = "<span class='span badge badge-danger'>Cancelado</span>";
    			    	else if ($dados->status == "A")
    			    		$status = "<span class='span badge badge-info'>Aguardando<br> Pagamento</span>";
    			    	else if ($dados->status == "T")
    			    		$status = "<span class='span badge badge-warning'>Troca</span>";
    			    	else if ($dados->status == "E")
    			    		$status = "<span class='span badge badge-warning'>Extraviado</span>";
    			    	else if ($dados->status == "D")
    			    		$status = "<span class='span badge badge-danger'>Devolvido</span>";

    			    	?>
    			    	<tr>
    			    		<td><?=$dados->id?></td>
    			    		<td><?=$dados->razaoSocial?><?=$dados->primeiro_nome?> <?=$dados->sobrenome?> - <?=$dados->celular?> / <?=$dados->telefone?></td>
    			    		<td><?=$dados->data?></td>
    			    		<td><?=$status?></td>
    			    		<td>Total</td>
    			    		<td>
    			    			<a href="venda/vendaProduto/<?=$dados->id?>" alt="Editar" title="Editar">
                                <i class="align-middle"  data-feather="edit-2"></i>
                                </a>
    			    		</td>
    			    	</tr>
    			    	<?php
    			    }
    			?>
    		</tbody>
    	</table>


    </div> <!-- card-body -->
</div> <!-- card -->