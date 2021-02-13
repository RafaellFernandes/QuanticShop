<?php

    //verificar se nao esta logado
    if ( !isset ( $_SESSION["bancotcc"]["id"] ) ) {
        exit;
    }

    //iniciar as variaveis
    $NomeDept = "";

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
        $NomeDept  	= $dados->NomeDept ;
	  
  }
  
?>
<div class="container-fluid p-0">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h4>Cadastro</h4>
				<h6 class="card-subtitle text-muted">Departamento</h6>
				<div class="float-right">
					<a href="cadastro/marca" class="btn btn-info">Cadastrar Marca</a> 
					<a href="cadastro/produto" class="btn btn-info">Cadastrar Produto</a>
				</div>
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
							<label for="NomeDept">Departamento:</label>
							<input type="text" name="NomeDept" id="NomeDept" class="form-control" required data-parsley-required-message="Preencha este campo, por favor"
							value="<?=$NomeDept;?>">
						</div> 
					</div><br>
					<button type="submit" class="btn btn-success margin">
					<!--<i class="fas fa-check"></i>--> Salvar Dados
					</button>
					<div class="float-right">
						<a href="listagem/departamento" class="btn btn-primary"><!--<i class="fas fa-bars"></i>-->Listar Registros</a> 
					</div>
                </form>
            </div>
        </div>
    </div>
</div>