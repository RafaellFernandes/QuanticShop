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
						<a class="btn btn-danger mt-3" target="_blank" href="relatorioGerencialEstoque.php">Gerar PDF</a>
					</div>
					<h4>RELATÓRIO</h4>
					<h6 style="color: blue;"><strong>Gerencia de Estoque</strong></h6>
				</div>
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
                            <th>ID<br>PRDT</th>
							<th>CODIGO</th>
							<th>PRODUTO</th>
                            <th>ID<br>ETQ</th>
							<th>QTDE<br>ESTOQUE</th>
                            <th>LOTE</th>
                            <th>DATA CADASTRO</th>
							<th>QTDE<br>COMPRA</th>
                            <th>CUSTO<br>UNITARIO</th>
						</tr>
					</thead>
					<tbody>
						<?php
                            $sql = "SELECT e.id eid, e.*,p.id pid, p.*, date_format(c.data_cadastro, '%d/%m/%Y') dataCadastro,c.*
                                    FROM estoque e
                                    INNER JOIN produto p ON (p.id = e.produto_id)
                                    INNER JOIN item_compra c ON (c.produto_id = p.id)
                                    WHERE c.ativo = 1 AND p.ativo = 1
                                    ORDER BY e.id
                                    ";
                            $consulta = $pdo->prepare($sql);
							$consulta->execute();
              
							while ( $dados = $consulta->fetch(PDO::FETCH_OBJ)){ 
								//separar os dados
                                $custo_unitario     = number_format($dados->custo_unitario,2, '.' , ',');
                                
								echo "<tr>
                                        <td>$dados->pid</td>
                                        <td>$dados->codigo</td>
                                        <td>$dados->nome_produto</td>
                                        <td>$dados->eid</td>
                                        <td>$dados->qtd_estoque</td>
                                        <td>$dados->lote</td>
                                        <td>$dados->dataCadastro</td>
                                        <td>$dados->qtdProdutoComprado</td>
                                        <td>R$ $custo_unitario</td>
								    </tr>";
                            }
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>	