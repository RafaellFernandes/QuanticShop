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
							<th>Valor unitario</th>
							<th>Ações</th>
						</tr>
					</thead>
					<tbody>
						<?php
							//buscar as marcas alfabeticamente
                            // $sql = "SELECT c.id, c.fornecedor_id, p.nome_produto, c.produto_id, c.lote, c.valor_unitario,
						    // c.data_cadastro FROM item_compra c, produto p LEFT JOIN produto p ON (c.produto_id = p.id)";
  							
							$sql = "SELECT c.*, f.razaoSocial, p.nome_produto  FROM item_compra c
							 	LEFT JOIN fornecedor f on (f.id = c.fornecedor_id)
                				LEFT JOIN produto p on(p.id = c.produto_id) ORDER BY c.id";
  
							// $sql = "SELECT p.*,d.*,m.* FROM produto p
							// left join departamento d on (d.id = p.departamento_id)
							// left join marca m on(m.id = p.marca_id)
							// WHERE p.id = :id LIMIT 1";

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
                                $valor_unitario      = $dados->valor_unitario;
                                $valor_unitario      = number_format($valor_unitario,2, '.' , ',');
                                $lote                = $dados->lote;
						
                         
								//mostrar na tela
								echo '<tr>
								<td>'.$fornecedor_id.'</td>
								<td>'.$produto_id.'</td>
								<td>'.$data_cadastro.'</td>
								<td>'.$valor_unitario.'</td>
								<td class="table-action text-center">
								<a href="processoCompra/produtoCompra/'.$id.'" alt="Editar" title="Editar">
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
