<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["quanticshop"]["id"] ) ){
    exit;
  }

  //iniciar as variaveis 
  $nome_marca = "";

  //se nao existe o id
  if ( !isset ( $id ) ) $id = "";

  //verificar se existe um id
  if ( !empty ( $id ) ) {
  	//selecionar os dados do banco
  	$sql = "SELECT * FROM marca 
  		WHERE id = ? LIMIT 1";
  	$consulta = $pdo->prepare($sql);
  	$consulta->bindParam(1, $id); 
  	$consulta->execute();
  	$dados  = $consulta->fetch(PDO::FETCH_OBJ);

  	//separar os dados
  	$id 	  = $dados->id;
	$nome_marca    = $dados->nome_marca;

  } 
?>
<div class="container-fluid p-0">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="float-end">
					<a href="cadastro/departamento" class="btn btn-primary">Cadastrar Departamento</a> 
					<a href="cadastro/produto" class="btn btn-primary">Cadastrar Produto</a>
				</div>
				<h4>Cadastro</h4>
				<h6 class="card-subtitle text-muted">Marca</h6>
				
			</div>
			<div class="card-body">
				<form name="formCadastro" method="post" action="salvar/marca" data-parsley-validate>
					<p>Todos os campos são obrigatórios</p>
					<div class="row">
						<div class="col-12 col-md-2" style="display: none;">
							<label for="id">ID</label>
							<input type="text" name="id" id="id" class="form-control" readonly value="<?=$id;?>">
						</div>
						<div class="col-12 col-md-12">
							<label for="nome_marca">Nome</label>
							<input type="text" name="nome_marca" id="nome_marca" class="form-control" required data-parsley-required-message="Preencha este campo, por favor"
							value="<?=$nome_marca;?>">
						</div>
					</div><br>

					<div class="row g-2">
                        <div class="col-sm-4 mt-4">
							<button type="submit" class="btn btn-success margin" alt="Salvar" title="Salvar">
								Salvar Dados
							</button>
                        </div>
                        <div class="col-sm">
                            <div class="float-end mt-3 ">
                                <a href="listagem/marca" class="btn btn-primary">Listar Registros</a> 
                            </div> 
                        </div>
                    </div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
	//verificar se o id é vazio
	if ( empty ( $id ) ) $id = 0;
?>