<?php
	//verificar se não está logado
	if ( !isset ( $_SESSION["quanticshop"]["id"] ) ){
		exit;
	}

	//mostrar erros
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
	error_reporting(E_ALL);
	
?>
<div class="container-fluid p-0">
	<div class="row">
		<div class="col-12 col-xl-12">
			<div class="card">
				<div class="card-header">
					<div class="float-right">
						<a href="cadastro/produto" class="btn btn-info">Cadastrar Novo</a>
					</div>
					<h4>Lista</h4>
					<h6 class="card-subtitle text-muted">Produtos</h6>
				</div>
				<table class="table table-bordered table-hover table-striped" id="tabela">
					<thead>
						<tr>
							<th>Foto</th>
							<th>Nome</th>
							<th style="width:13%">Valor</th>
							<th>Marca</th>
							<th>Departamento</th>
							<th>Ações</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$sql = "SELECT p.*, m.nome_marca, d.nome_dept  FROM produto p 
							 	LEFT JOIN departamento d on (d.id = p.departamento_id)
                				LEFT JOIN marca m on(m.id = p.marca_id) ORDER BY p.id";
							$consulta = $pdo->prepare($sql);
							$consulta->execute();

							while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
								//separar os dados
								$id         	                = $dados->id;
								$foto                           = $dados->foto;
								$nome_produto 	                = $dados->nome_produto;                
								$marca_id                       = $dados->marca_id;
								$nome_marca                     = $dados->nome_marca;
								$departamento_id                = $dados->departamento_id;
								$nome_dept                      = $dados->nome_dept;
								$valor_unitario                 = $dados->valor_unitario;
								$valor_unitario                 = number_format($valor_unitario,2, '.' , ',');	
								$imagem                         = "../fotos/".$foto."p.jpg";
												
								//mostrar na tela
								echo '<tr>	
										<td><img src="'.$imagem.'" alt="'.$nome_produto.'"  width="48" height="48" class="rounded-circle mr-2"></td>
										<td>'.$nome_produto.'</td>
										<td>R$ '.$valor_unitario.'</td>
										<td>'.$nome_marca.'</td>
										<td>'.$nome_dept.'</td>
										<td>
											<a href="cadastro/produto/'.$id.'" alt="Editar" title="Editar">
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
			location.href="excluir/produto/"+id;
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