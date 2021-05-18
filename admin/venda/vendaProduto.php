<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["quanticshop"]["id"] ) ){
    exit;
  }

  //iniciar as variaveis 
  $nome_marca = $ativo ="";

  //se nao existe o id
  if ( !isset ( $id ) ) $id = "";

  //verificar se existe um id
  if ( !empty ( $id ) ) {
  	//selecionar os dados do banco
  	$sql = "SELECT * FROM venda
  		WHERE id = ? LIMIT 1";
  	$consulta = $pdo->prepare($sql);
  	$consulta->bindParam(1, $id); 
  	$consulta->execute();
  	$dados  = $consulta->fetch(PDO::FETCH_OBJ);

  	//separar os dados
  	$id 	      = $dados->id;
	$cliente_id   = $dados->cliente_id;
	$status = $dados->status;
    $data = $dados->data;

  } 
?>
<div class="container-fluid p-0">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="float-end">
					<a href="cadastro/departamento" class="btn btn-primary"></a> 
					<a href="cadastro/produto" class="btn btn-primary"></a>
				</div>
				<h4>Cadastro</h4>
				<h6 class="card-subtitle text-muted">Venda</h6>
				
			</div>
			<div class="card-body">
				<form name="formCadastro" method="post" action="venda/vendaProduto" data-parsley-validate>
					<p>Todos os campos são obrigatórios</p>
					<div class="row">
						<div class="col-12 col-md-2" style="display: none;">
							<label for="id">ID</label>
							<input type="text" name="id" id="id" class="form-control" readonly value="<?=$id;?>">
						</div>
                        <div class="col-12 col-md-4 mt-2">
                            <label for="cliente_id">Cliente</label>
                            <select name="cliente_id" id="cliente_id" class="form-control" required data-parsley-required-message="Selecione um Cliente">
                                <option value="<?=$cliente_id;?>">Selecione o Cliente</option>
                                    <?php
                                        $sql = "SELECT id, primeiro_nome, sobrenome, razaoSocial FROM cliente ORDER BY primeiro_nome";
                                        $consulta = $pdo->prepare($sql);
                                        $consulta->execute();

                                        while ($d = $consulta->fetch(PDO::FETCH_OBJ) ) {
                                        //separar os dados
                                            $id           = $d->id;
                                            $primeiro_nome = $d->primeiro_nome;
                                            $sobrenome     = $d->sobrenome;
                                            $razaoSocial = $d->razaoSocial;
                                            
                                            echo '<option value="'.$id.'">'.$primeiro_nome.' '.$sobrenome.''.$razaoSocial.'</option>';
                                        }
                                    ?>
                            </select>
                        </div>
						<div class="col-12 col-md-2 mt-2">
                        <label for="ativo">Ativo</label>
                        <select name="ativo" id="ativo" class="form-control" 
                        required data-parsley-required-message="Selecione uma opção">
                            <option value="">...</option>
                            <option value="0">Inativo</option>
                            <option value="1">Ativo</option>
					    </select>
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