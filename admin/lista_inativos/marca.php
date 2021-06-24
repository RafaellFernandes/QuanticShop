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
						<a href="listagem/marca" class="btn btn-primary">Marcas Ativas</a>
					</div>
					<h4>LISTA</h4>
					<h6 style="color: red;"><strong>Marcas Inativas</strong></h6>
				</div>
				<table class="table table-bordered table-hover table-striped" id="tabela">
					<thead>
						<tr>
							<th>Marca</th>
							<th>Ações</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$sql = "SELECT * 
									FROM marca 
									WHERE ativo = 0
									ORDER BY nome_marca";

							$consulta = $pdo->prepare($sql);
							$consulta->execute();

							while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
								//separar os dados
								$id 	        = $dados->id;
								$nome_marca 	= $dados->nome_marca;
                                $ativo          = $dados->ativo;

								//mostrar na tela
								echo '<tr>
										<td>'.$nome_marca.'</td>
										<td class="table-action text-center">
											<a href="cadastro/marca/'.$id.'" alt="Editar" title="Editar">
												<i class="align-middle"  data-feather="edit-2"></i>
											</a>
										</td>
									</tr>';
                        	}
						?>
					</tbody>
				</table>	
			</div>
		</div>
	</div>
</div>
<script>
	
	$(document).ready( function () {
		$('#tabela').DataTable({
			language: {
				"emptyTable":     "Nenhum registro",
				"info":           "Mostrando de _START_ a _END_ de _TOTAL_ registros",
				"lengthMenu":     "Mostrar _MENU_ registros",
				"loadingRecords": "Carregando...",
				"processing":     "Processando...",
				"search":         "Procurar:",
				"zeroRecords":    "Nenhum registro encontrado",
				"paginate": {
					"first":      "Primeiro",
					"last":       "Último",
					"next":       "Próximo",
					"previous":   "Anterior"
				},
			}
    	});
	} );
</script>
