<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["quanticshop"]["id"] ) ){
    exit;
  }
  //mostrar erros
	// ini_set('display_errors',1);
	// ini_set('display_startup_erros',1);
    // error_reporting(E_ALL);
    

//se nao existe o id
if ( !isset ( $id ) ) $id = "";

//iniciar as variaveis
$produto_id = $fornecedor_id = $lote = $valor_unitario = $data_cadastro = $qtd_produto = "";

  //verificar se existe um id
  if ( !empty ( $id ) ) {

    include "../admin/validacao/functions.php";
   
  	//selecionar os dados do banco para poder editar
      $sql = "SELECT * FROM item_compra WHERE id = :id LIMIT 1";
      $consulta = $pdo->prepare($sql);
      $consulta->bindParam(":id", $id);
      $consulta->execute();
      
  	$dados  = $consulta->fetch(PDO::FETCH_OBJ);

  	//separar os dados
    $id         	          = $dados->id;
    $nome_produto 	          = $dados->nome_produto; 
    $produto_id               = $dados->produto_id;
    $valor_unitario           = $dados->valor_unitario;
    $valor_unitario           = number_format($valor_unitario,2,",",".");
    $data_cadastro            = $dados->data_cadastro;
    $fornecedor_id            = $dados->fornecedor_id;
    $razaoSocial              = $dados->razaoSocial;
    $lote                     = $dados->lote;
  }

?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
                        
<div class="container-fluid p-0">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
                <div class="float-end">
					<a href="cadastro/marca" class="btn btn-primary">Cadastrar Marca</a> 
					<a href="cadastro/departamento" class="btn btn-primary">Cadastrar Departamento</a>
				</div>
				<h4>Cadastro</h4>
				<h6 class="card-subtitle text-muted">Produto</h6>
				
			</div>
			<div class="card-body">
                <form method="post" name="formCadastro"  action="processoCompra/salvarProdutoCompra" data_parsley_validate enctype="multipart/form-data">
                    <p> Todos os campos são obrigatórios </p>
                    <div class="row">
                        <div class="col-12 col-md-2"  style="display: none;">
                            <label for="id">ID</label>
                            <input type="text" name="id" id="id" readonly class="form-control" value="<?=$id;?>">
                        </div>
                        <div class="col-12 col-md-9">
                            <label for="produto_id">Nome do Produto</label>
                            <input type="text" name="produto_id" id="produto_id" class="form-control" require data-parsley-required-message="Por favor, preencha este campo" 
                            value="<?=$produto_id;?>" placeholder="Nome do Produto">
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="lote">Lote</label>
                            <input type="text" name="lote" id="codigo" class="form-control" value="<?=$lote;?>" placeholder="Nº Lote">
                        </div>
                        <div class="col-12 col-md-4 mt-2">
                            <label for="forncedor_id">Departamento</label>
                            <select name="fornecedor_id" id="fornecedor_id" class="form-control" required data-parsley-required-message="Selecione um Departamento">
                                <option value="<?=$fornecedor_id;?>">Selecione o Departamento</option>
                                    <?php
                                        $sql = "SELECT id, razaoSocial FROM fornecedor ORDER BY razaoSocial";
                                        $consulta = $pdo->prepare($sql);
                                        $consulta->execute();

                                        while ($d = $consulta->fetch(PDO::FETCH_OBJ) ) {
                                        //separar os dados
                                            $id        = $d->id;
                                            $razaoSocial  = $d->razaoSocial;
                                            echo '<option value="'.$id.'">'.$razaoSocial.'</option>';
                                        }
                                    ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-4 mt-2">
                            <label for="valor_unitario">Valor Unitário</label>
                            <input type="text" name="valor_unitario" id="valor_unitario" required data-parsley-required-message="Preencha este campo" 
                            class="form-control" value="<?=$valor_unitario;?>" placeholder="R$ 0,00">
                        </div> 
                        <div class="col-12 col-md-4 mt-2">
                            <div class="form-group">
                                <label for="data_cadastro">Data Cadastro</label>
                                <!-- Datepicker as text field -->         
                                <div class="input-group date" data-date-format="dd/mm/yyyy">
                                <input  type="text" class="form-control" name="data_cadastro" id="data_cadastro" require data-parsley-required-message="Por favor, preencha este campo" placeholder="dd/mm/yyyy" value="<?=$data_cadastro;?>">
                                <div class="input-group-addon" >
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-2">
                        <div class="col-sm-4 mt-4">
                            <button type="submit" class="btn btn-success margin mt-3">
                                Salvar Dados
                            </button>
                        </div>
                            </div> 
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>$("#valor_unitario").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});</script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js'></script>
<script>
 $('.input-group.date').datepicker({format: "dd/mm/yyyy"});
</script>

