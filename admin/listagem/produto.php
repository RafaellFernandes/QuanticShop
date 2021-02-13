<?php
	//verificar se não está logado
	if ( !isset ( $_SESSION["bancotcc"]["id"] ) ){
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
							$sql = "SELECT p.id, p.FotoProduto, p.Nome, p.ValorProduto, p.Marca_id, p.departamento_id, m.Marca marca from produto p 
							INNER JOIN marca m ON (m.id = p.Marca_id) ORDER BY p.Nome";
							$consulta = $pdo->prepare($sql);
							$consulta->execute();

							while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
								//separar os dados
								$id         	  = $dados->id;
								$FotoProduto      = $dados->FotoProduto;
								$Nome 	          = $dados->Nome;                
								$Marca_id         = $dados->Marca_id;
								$marca            = $dados->marca;
								$departamento_id  = $dados->departamento_id;
								$ValorProduto     = $dados->ValorProduto;
								$ValorProduto     = number_format($ValorProduto,2, '.' , ',');	
								$imagem = "../fotos/".$FotoProduto."p.jpg";
												
								//mostrar na tela
								echo '<tr>	
										<td><img src="'.$imagem.'" alt="'.$Nome.'"  width="48" height="48" class="rounded-circle mr-2"></td>
										<td>'.$Nome.'</td>
										<td>R$ '.$ValorProduto.'</td>
										<td>'.$marca.'</td>
										<td>'.$departamento_id.'</td>
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