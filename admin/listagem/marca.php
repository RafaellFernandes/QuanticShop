<?php
	//verificar se não está logado
	if ( !isset ( $_SESSION["quanticshop"]["id"] ) ){
		exit;
	}
?>
<div class="container-fluid p-0">
	<div class="row">
		<div class="col-12 col-xl-12">
			<div class="card">
				<div class="card-header">
					<div class="float-end">
						<a href="cadastro/marca" class="btn btn-primary">Cadastrar Novo</a>
					</div>
					<h4>LISTA</h4>
					<h6 style="color: green;"><strong>Marcas Ativas</strong></h6>
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
							$sql = "SELECT * FROM marca ORDER BY nome_marca";
							$consulta = $pdo->prepare($sql);
							$consulta->execute();

							while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
								//separar os dados
								$id 	        = $dados->id;
								$nome_marca 	= $dados->nome_marca;
								$ativo  		= $dados->ativo;

									//mostrar na tela
								if ($ativo == "1"){
									echo '<tr>
											<td>'.$nome_marca.'</td>
											<td class="table-action text-center">
												<a href="cadastro/marca/'.$id.'" alt="Editar" title="Editar">
													<i class="align-middle"  data-feather="edit-2"></i>
												</a>
												<a href="javascript:excluir('.$id.')" alt="Excluir" title="Excluir">
													<i class="align-middle" data-feather="trash"></i>				
												</a>
											</td>
										</tr>';
								}
							}
						?>
					</tbody>
				</table>	
			</div>
		</div>
	</div>
</div>
<script>
	function excluir(id){

		if (confirm("Deseja mesmo excluir? ")) {
			//ir para exclusao
			location.href="excluir/inativarMarca/"+id;
		}
	}
	
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