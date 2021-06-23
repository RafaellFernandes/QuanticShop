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
					<div class="float-end">
						<a href="cadastro/produto" class="btn btn-primary">Cadastrar Novo</a>
					</div>
					<h4>LISTA</h4>
					<h6 style="color: green;"><strong>Produtos Ativos</strong></h6>
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
							$sql = "SELECT p.ativo pativo, p.* , m.*, d.*, p.id idProduto  
									FROM produto p 
									LEFT JOIN departamento d ON (d.id = p.departamento_id)
									LEFT JOIN marca m ON (m.id = p.marca_id) 
									WHERE p.ativo = 1
									ORDER BY p.id";
							$consulta = $pdo->prepare($sql);
							$consulta->execute();

							while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
								//separar os dados
								$id         	                = $dados->idProduto;
								$foto                           = $dados->foto;
								$nome_produto 	                = $dados->nome_produto;                
								$marca_id                       = $dados->marca_id;
								$nome_marca                     = $dados->nome_marca;
								$departamento_id                = $dados->departamento_id;
								$nome_dept                      = $dados->nome_dept;
								$valorUnitario                  = $dados->valorUnitario;
								$valorUnitario                  = number_format($valorUnitario,2, '.' , ',');	
								$foto                           = $dados->foto;
								$imagem                    		 = explode(",", $foto);
								//mostrar na tela
								?>
								<tr>	
									<td><img src="../fotos/produtos/<?=$imagem[0]?>" alt="<?=$nome_produto;?>"  width="70" height="70" class="mr-2"></td>
							
									<td><?=$nome_produto;?></td>
									<td>R$ <?=$valorUnitario;?></td>
									<td><?=$nome_marca;?></td>
									<td><?=$nome_dept;?></td>
									<td class="table-action text-center">
										<a href="cadastro/produto/<?=$id;?>" alt="Editar" title="Editar">
											<i class="align-middle"  data-feather="edit-2"></i>				
										</a>
										
									</td>
								</tr>
								<?php
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