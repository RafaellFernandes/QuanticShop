<?php
	//verificar se não está logado
	if ( !isset ( $_SESSION["bancotcc"]["id"] ) ){
		exit;
	}
?>
<div class="container-fluid p-0">
	<div class="row">
		<div class="col-12 col-xl-12">
			<div class="card">
				<div class="card-header">
					<div class="float-right">
						<a href="cadastro/transportadora" class="btn btn-info">Cadastrar Novo</a>
					</div>
					<h4>Lista</h4>
					<h6 class="card-subtitle text-muted">Transportadoras</h6>
				</div>
				<table class="table table-bordered table-hover table-striped " id="tabela">
					<thead>
						<tr>
							<th>Transportadora</th>
							<th>CNPJ</th>
							<th>Telefone</th>
							<th>Email</th>
							<th>Cidade</th>
							<th>Ações</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$sql = "SELECT * FROM transportadora ORDER BY Nome";
							$consulta = $pdo->prepare($sql);
							$consulta->execute();

							while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
								//separar os dados
								$id 	        = $dados->id;
								$Nome 	        = $dados->Nome;
								$cnpj 	        = $dados->cnpj;
								$Telefone 	    = $dados->Telefone;
								$email          = $dados->email;
								$nome_cidade 	= $dados->nome_cidade;
								$estado         = $dados->estado;

								//mostrar na tela
								echo '<tr>
										<td>'.$Nome.'</td>
										<td>'.$cnpj.'</td>
										<td>'.$Telefone.'</td>
										<td>'.$email.'</td>
										<td>'.$nome_cidade.' - '.$estado.'</td>
										<td class="table-action text-center">
											<a href="cadastro/transportadora/'.$id.'" alt="Editar" title="Editar">
												<i class="align-middle"  data-feather="edit-2"></i>		
											</a>
											<a href="javascript:excluir('.$id.')" alt="Excluir" title="Excluir">
												<i class="align-middle" data-feather="trash"></i>			
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
	function excluir(id){
		if (confirm("Deseja mesmo excluir? ")) {
			//ir para exclusao
			location.href="excluir/transportadora/"+id;
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