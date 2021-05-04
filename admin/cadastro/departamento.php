<?php

    //verificar se nao esta logado
    if ( !isset ( $_SESSION["quanticshop"]["id"] ) ) {
        exit;
    }

    //iniciar as variaveis
    $nome_dept = "";

    //se nao existe o id
    if ( !isset ( $id ) ) $id = "";
    
    //verificar se existe um id
    if ( !empty ( $id ) ) {
        //selecionar os dados do banco para poder editar

        $sql = "SELECT * FROM departamento WHERE id = :id LIMIT 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        //separar os dados
        //$id 	    = $dados->id;
        $nome_dept  	= $dados->nome_dept ;
	  
  }
  
?>
<div class="container-fluid p-0">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
                <div class="float-end">
					<a href="cadastro/marca" class="btn btn-primary">Cadastrar Marca</a> 
					<a href="cadastro/produto" class="btn btn-primary">Cadastrar Produto</a>
				</div>
				<h4>Cadastro</h4>
				<h6 class="card-subtitle text-muted">Departamento</h6>
				
			</div>
			<div class="card-body">
				<form name="formCadastro" method="post" action="salvar/departamento" data-parsley-validate enctype="multipart/form-data">
					<p class="card-subtitle text-muted">Todos os campos são Obrigatórios</p><br>
					<div class="row">
						<div class="col-12 col-md-2"  style="display: none;">
							<label for="id">ID</label>
							<input type="text" name="id" id="id" class="form-control" readonly value="<?=$id;?>">
						</div>
						<div class="col-12 col-md-12">
							<label for="nome_dept">Departamento:</label>
							<input type="text" name="nome_dept" id="nome_dept" class="form-control" required data-parsley-required-message="Preencha este campo, por favor"
							value="<?=$nome_dept;?>">
						</div> 
					</div><br>
					<div class="row g-2">
                        <div class="col-sm-4 mt-4">
							<button type="submit" class="btn btn-success margin">
								Salvar Dados
							</button>
                        </div>
                        <div class="col-sm">
                            <div class="float-end mt-3 ">
                                <a href="listagem/departamento" class="btn btn-primary">Listar Registros</a> 
                            </div> 
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>