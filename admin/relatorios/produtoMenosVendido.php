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
<div class="container-fluid p-0">
	<div class="row">
		<div class="col-12 col-xl-12">
			<div class="card">
				<div class="card-header">
					<div class="float-end">
						<a class="btn btn-danger mt-3" target="_blank" href="relatorioProdutoMenosVendido.php">Gerar PDF</a>
					</div>
					<h4>RELATÓRIO</h4>
					<h6 style="color: blue;"><strong>Produto Menos Vendido</strong></h6>
				</div>
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>NOME PRODUTO</th>
							<th>CODIGO</th>
							<th>VALOR UNITARIO</th>
                            <th>VEZES VENDIDA</th>
							<th>ID - MARCA</th>
                            <th>ID - DEPARTAMENTO</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$sql = "SELECT p.id pid, p.ativo pativo, p.*, m.id mid, m.*, d.id did, d.*,v.id vid, v.vezesVendido, c.venda_unitaria  
							FROM produto p 
							INNER JOIN departamento d ON (d.id = p.departamento_id)
							INNER JOIN marca m ON (m.id = p.marca_id) 
							INNER JOIN item_venda v ON (v.produto_id = p.id) 
							INNER JOIN item_compra c ON (c.produto_id = p.id)
							WHERE p.ativo = 1
							ORDER BY v.vezesVendido ASC";

							$consulta = $pdo->prepare($sql);
							$consulta->execute();                            

							while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
							
								$venda_unitaria              = $dados->venda_unitaria;
								$venda_unitaria              = number_format($venda_unitaria,2, '.' , ',');

								echo "<tr>
									<td>$dados->pid</td>
									<td>$dados->nome_produto</td>
									<td>$dados->codigo</td>
									<td>R$ $venda_unitaria</td>
									<td>$dados->vezesVendido</td>
									<td>$dados->marca_id - $dados->nome_marca</td>
									<td>$dados->departamento_id - $dados->nome_dept</td>
								</tr>";
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>	