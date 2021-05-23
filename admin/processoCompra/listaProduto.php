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
					<h4>Lista de Produtos</h4>
					<h6 class="card-subtitle text-muted">Produto em Estoque</h6>
				</div>
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th>ID Fornecedor</th>
							<th>ID produto</th>
							<th>data cadastro</th>
							<th>Ações</th>
						</tr>
					</thead>
					<tbody>
						<?php
  							
							$sql = "SELECT c.*, f.razaoSocial, p.nome_produto  FROM item_compra c
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
                                $data_cadastro       = $dados->data_cadastro;
                                $lote                = $dados->lote;
						
                         
								//mostrar na tela
								echo '<tr>
								<td>'.$fornecedor_id.'</td>
								<td>'.$produto_id.'</td>
								<td>'.$data_cadastro.'</td>
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
	//funcao para perguntar se deseja excluir
	//se sim direcionar para o endereco de exclusão
	function excluir( id ) {
		//perguntar - função confirm
		if ( confirm ( "Deseja mesmo excluir?" ) ) {
			//direcionar para a exclusao
			location.href="processoCompra/produtoCompra/"+id;
		}
	}
</script>
