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
							<th>Nome Produto</th>
							<th>Marca</th>
							<th>DT Cadastro</th>
                            <th>Quantidade Estoque</th>
							<th>Valor Bruto</th>
							<th>Cod Produto</th>
						</tr>
					</thead>
					<tbody><br>
						<?php
							//buscar as marcas alfabeticamente
                            // $sql = "SELECT p.*, f.razaoSocial FROM produto p INNER JOIN fornecedor f ON (f.id = p.fornecedor_id) WHERE p.id = :id ";
                            $sql = "SELECT p.*, m.*, e.*, f.* 
                                    FROM produto p, marca m, estoque e, fornecedor f
                                    WHERE p.marca_id = m.id AND p.estoque_id = e.id AND p.fornecedor_id = f.id";

// $sql = "SELECT p.*,d.*,m.* FROM produto p
// left join departamento d on (d.id = p.departamento_id)
// left join marca m on(m.id = p.marca_id)
// WHERE p.id = :id LIMIT 1";

                            $consulta = $pdo->prepare($sql);
                            $consulta->bindParam(":id", $id);
							$consulta->execute();

							while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
								//separar os dados
								$id 		         = $dados->id;
                                $fornecedor_id 		 = $dados->fornecedor_id;
                                $razaoSocial 		 = $dados->razaoSocial;
                                $nome_produto        = $dados->nome_produto;
                                $marca_id 	         = $dados->marca_id;
                                $nome_marca          = $dados->nome_marca;
                                $data_cadastro       = $dados->data_cadastro;
                                $qtd_produto         = $dados->qtd_produto;
                                $valor_bruto         = $dados->valor_bruto;
                                $valor_bruto         = number_format($valor_bruto,2, '.' , ',');
                                $codigo              = $dados->codigo;
                         
								//mostrar na tela
								echo '<tr>
                                        <td>'.$fornecedor_id.' - '.$razaoSocial.'</td>
										<td>'.$nome_produto.'</td>
                                        <td>'.$marca_id.' - '.$nome_marca.' </td>
										<td>'.$data_cadastro.'</td>
										<td>'.$qtd_produto.'</td>
                                        <td>R$ '.$valor_bruto.'</td>
                                        <td>'.$codigo.'</td>
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
</script>
