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
						<a href="cadastro/cidade" class="btn btn-primary mt-2">Cadastrar Novo</a>
					</div>
					<h4>LISTA</h4>
					<h6 style="color: green;">Cidades e Estados</h6>
				</div>
				<table class="table table-bordered table-hover table-striped" id="tabela">
					<thead>
						<tr>
							<th>Cidade</th>
							<th>Estado</th>
							<th>Ações</th>
						</tr>
					</thead>
					<tbody><br>
						<?php
							//buscar as cidades alfabeticamente
							$sql = "SELECT * FROM cidade ORDER BY cidade";
							$consulta = $pdo->prepare($sql);
							$consulta->execute();

							while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
								//separar os dados
								$id 		= $dados->id;
								$cidade 	= $dados->cidade;
								$estado 	= $dados->estado;
								//mostrar na tela
								echo '<tr>
										<td>'.$cidade.'</td>
										<td>'.$estado.'</td>
										<td class="table-action text-center" >
											<a href="cadastro/cidade/'.$id.'" alt="Editar" title="Editar">
												<i class="align-middle"  data-feather="edit-2"></i>
											</a>
											<a href="javascript:excluir('.$id.')"  alt="Excluir" title="Excluir">
												<i class="fas fa-trash"  data-feather="trash-2"></i>
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
	//funcao para perguntar se deseja excluir
	//se sim direcionar para o endereco de exclusão
	function excluir( id ) {
		//perguntar - função confirm
		if ( confirm ( "Deseja mesmo excluir?" ) ) {
			//direcionar para a exclusao
			location.href="excluir/cidade/"+id;
		}
	}

	//adicionar o dataTable 
	$(document).ready(function(){
		$('#tabela').DataTable({
			"language": {
				"lengthMenu": "Mostrando _MENU_ Registros por Pagina",
				"zeroRecords": "Nenhum Registro Encontrado",
				"info": "Mostrando Paginas de  _PAGE_ de _PAGES_",
				"infoEmpty": "No records available",
				"infoFiltered": "(filtered from _MAX_ total records)",
				"search": "Procurar:",
				"zeroRecords":  "Nenhum registro encontrado",
		"paginate": {
					"first":      "Primeiro",
					"last":       "Último",
					"next":       "Próximo",
					"previous":   "Anterior"
		}
			}
		} );
	})
</script>
