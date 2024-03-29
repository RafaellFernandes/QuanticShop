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
						<a href="cadastro/departamento" class="btn btn-primary">Cadastrar Novo</a>
					</div>
					<h4>LISTA</h4>
					<h6 style="color: green;"><strong>Departamentos Ativos</strong></h6>
				</div>
				<table class="table table-bordered table-hover table-striped " id="tabela">
					<thead>
						<tr>
							<th>Departamento</th>
							<th>Ações</th>
						</tr>
					</thead>
					<tbody>
						<?php
							//buscar id de Departamento alfabeticamente
							$sql = "SELECT * 
									FROM departamento 
									WHERE ativo = 1
									ORDER BY nome_dept";
							$consulta = $pdo->prepare($sql);
							$consulta->execute();

							while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
								//separar os dados
								$id 	    = $dados->id;
								$nome_dept 	= $dados->nome_dept;
								$ativo      = $dados->ativo;		

								//mostrar na tela
								echo '<tr>
										<td>'.$nome_dept.'</td>
										<td class="table-action text-center">
											<a href="cadastro/departamento/'.$id.'" alt="Editar" title="Editar">
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
				"zeroRecords":   "Nenhum registro encontrado",
				
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