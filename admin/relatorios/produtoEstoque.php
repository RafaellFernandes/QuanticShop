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
					<div class="float-right">
						<a href="javascript:window.print()" class="btn btn-danger">Imprimir</a>
					</div>
					<h4>Relatório</h4>
					<h6 class="card-subtitle text-muted">Produto Estoque</h6>
				</div>
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Código</th>
							<th>Produto</th>
							<th>Valor</th>
                            <th>Quantidade Estoque</th>
							<th>ID Marca</th>
							<th>ID Dept.</th>
							<th>ID Estoque</th>
						</tr>
					</thead>
					<tbody><br>
						<?php
							//buscar as marcas alfabeticamente
							// $sql = "SELECT p.*, e.idestoque, e.qtd_produto, e.produto_id, m.nome_marca, d.nome_dept  FROM produto p 
                            // INNER JOIN estoque e INNER JOIN marca m INNER JOIN departamento d ON ( p.id = e.produto_id ) WHERE p.id = :id LIMIT 1";
							
                            $sql = "SELECT * FROM produto";
                            $consulta = $pdo->prepare($sql);
                            $consulta->bindParam(":id", $id);
							$consulta->execute();

							while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
								//separar os dados
								$id 		         = $dados->id;
                                //$id 		         = $dados->idestoque;
                                $codigo              = $dados->codigo;
                                $nome_produto        = $dados->nome_produto;
                                $valor_unitario      = $dados->valor_unitario;
                                $valor_unitario      = number_format($valor_unitario,2, '.' , ',');
                                // $qtd_produto      = $dados->qtd_produto;
                                //$produto_id        = $dados->produto_id;
							 	$marca_id 	         = $dados->marca_id;
                                // $nome_marca       = $dados->nome_marca;
                                $departamento_id     = $dados->departamento_id;
                                //$nome_dept         = $dados->nome_dept;
                               
							
								//mostrar na tela
								echo '<tr>
										<td>'.$id.'</td>
                                        <td>'.$codigo.'</td>
										<td>'.$nome_produto.'</td>
										<td>R$ '.$valor_unitario.'</td>
                                        <td> Null </td>
                                        <td>'.$marca_id.' - nomeMarca </td>
                                        <td>'.$departamento_id.' - nomeDept </td>
                                        <td> Null </td>
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
	// $(document).ready(function(){
	// 	$('#tabela').DataTable({
	// 		"language": {
	// 			"lengthMenu": "Mostrando _MENU_ Registros por Pagina",
	// 			"zeroRecords": "Nenhum Registro Encontrado",
	// 			"info": "Mostrando Paginas de  _PAGE_ de _PAGES_",
	// 			"infoEmpty": "No records available",
	// 			"infoFiltered": "(filtered from _MAX_ total records)",
	// 			"search": "Procurar:",
	// 			"zeroRecords":  "Nenhum registro encontrado",
	// 	"paginate": {
	// 				"first":      "Primeiro",
	// 				"last":       "Último",
	// 				"next":       "Próximo",
	// 				"previous":   "Anterior"
	// 	}
	// 		}
	// 	} );
	// })
</script>
