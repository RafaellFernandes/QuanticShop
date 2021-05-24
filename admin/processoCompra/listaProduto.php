<?php
if (!isset($_SESSION["quanticshop"]["id"])) {
    $titulo = "Erro";
    $mensagem = "Usuário Não Logado";
    $icone = "error";
    mensagem($titulo, $mensagem, $icone);
exit;
}

if ($_SESSION["quanticshop"]["nivelAcesso"] != "admin") {
    $titulo = "Erro";
    $mensagem = "Erro na Requisição da Página";
    $icone = "error";
    mensagem($titulo, $mensagem, $icone);
exit;
}
?>						
<div class="container-fluid p-0">
	<div class="row">
		<div class="col-12 col-xl-12">
			<div class="card">
				<div class="card-header">
					<div class="float-end">
                        <a href="processoCompra/produtoCompra" class="btn btn-primary">Cadastrar Novo</a>
					</div>
					<h4>Lista de Produtos  </h4>
					<h6 class="card-subtitle text-muted">Produto em Estoque</h6>
				</div>
				<table class="table table-bordered table-hover table-striped" id="tabela">
					<thead>
						<tr>
							<th>ID Fornecedor</th>
							<th>ID produto</th>
							<th>Data cadastro</th>
							<th>Ativo</th>
							<th>Ações</th>
						</tr>
					</thead>
					<tbody>
						<?php
  							
							$sql = "SELECT c.ativo icativo, date_format(c.data_cadastro, '%d/%m/%Y') datacadastro, c.*, f.razaoSocial, p.nome_produto FROM item_compra c
							 	LEFT JOIN fornecedor f on (f.id = c.fornecedor_id)
                				LEFT JOIN produto p on(p.id = c.produto_id) ORDER BY c.id";

                            $consulta = $pdo->prepare($sql);
							$consulta->execute();

							while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
								//separar os dados
								$id 		         = $dados->id;
                                $fornecedor_id 		 = $dados->fornecedor_id;
                                $razaoSocial 		 = $dados->razaoSocial;
								$produto_id			 = $dados->produto_id;
                                $nome_produto        = $dados->nome_produto;
                                $datacadastro        = $dados->datacadastro;
                                $lote                = $dados->lote;
								$icativo             = $dados->icativo;
                         
								//mostrar na tela
								echo 	'<tr>
											<td>'.$fornecedor_id.'<br>'.$razaoSocial.'</td>
											<td>'.$produto_id.'<br>'.$nome_produto.'</td>
											<td>'.$datacadastro.'</td>
											<td>'.$icativo.'</td>
											<td class="table-action text-center">
												<a href="processoCompra/produtoCompra/'.$id.'" alt="Editar" title="Editar">
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

