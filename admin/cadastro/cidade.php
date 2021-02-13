<?php

//verificar se nao esta logado
if ( !isset ( $_SESSION["bancotcc"]["id"] ) ) {
    exit;
}

//iniciar as variaveis
$cidade = $estado = "";

//se nao existe o id
if ( !isset ( $id ) ) $id = "";

//verificar se existe um id
if ( !empty ( $id ) ) {
    //selecionar os dados do banco para poder editar

    $sql = "SELECT * FROM cidade WHERE id = :id LIMIT 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":id", $id);
    $consulta->execute();

    $dados = $consulta->fetch(PDO::FETCH_OBJ);

    //separar os dados
    //$id 	    = $dados->id;
    $cidade 	= $dados->cidade;
    $estado 	= $dados->estado;
  
}
//***********************************************
?>
<div class="container-fluid p-0">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Cadastro</h4>
                <h6 class="card-subtitle text-muted">Cidade e Estado</h6>
            </div>
            <div class="card-body">
                <form name="formCadastro" method="post" action="salvar/cidade" data-parsley-validate>
                    <p>Todos os Campos são Obrigatórios</p>
                    <div class="row">
                        <div class="mb-2 col-md-2" style="display: none;">
                            <label for="id">ID</label>
                            <input type="text" name="id" id="id" class="form-control" readonly value="<?=$id;?>" placeholder="Automatico">
                        </div>
                        <div class="mb-2 col-12 col-md-7">
                            <label for="cidade">Cidade</label>
                            <input type="text" name="cidade" id="cidade" class="form-control" required data-parsley-required-message="Preencha este campo, por favor"
                            value="<?=$cidade;?>" placeholder="Nome da Cidade">
                        </div>
                        <div class="mb-2 col-12 col-md-2">
                            <label for="estado">Estado</label>
                            <input type="text" name="estado" id="estado" class="form-control" required data-parsley-required-message="Preencha este campo, por favor"
                            value="<?=$estado;?>" placeholder="UF">
                        </div>
                    </div><br>
                    <button type="submit" class="btn btn-success margin">
                        <!--<i class="fas fa-check"></i>--> Salvar Dados
                    </button>   
                    <div class="float-right">
                        <a href="listagem/cidade" class="btn btn-primary"><!--<i class="fas fa-bars"></i>-->Listar Registros</a> 
                    </div>  
                </form>
            </div>
        </div>
    </div>
</div>