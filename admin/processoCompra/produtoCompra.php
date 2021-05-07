<?php
    //verificar se não está logado
    if ( !isset ( $_SESSION["quanticshop"]["id"] ) ){
        exit;
    }
     //mostrar erros
    ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
    error_reporting(E_ALL);
    

    //se nao existe o id
    if ( !isset ( $id ) ) $id = "";

    //iniciar as variaveis
    $produto_id = $fornecedor_id = $lote = $valor_unitario = $data_cadastro = $nome_produto = "";

    //verificar se existe um id
    if ( !empty ( $id ) ) {

    include "../admin/validacao/functions.php";
   
    //selecionar os dados do banco para poder editar
    $sql="SELECT c.*,p.* FROM item_compra c, produto p WHERE p.id = c.produto_id";

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
<script src="assets/mask/jquery.mask.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
                        
<div class="container-fluid p-0">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h4>Cadastro</h4>
				<h6 class="card-subtitle text-muted">Produto</h6>
			</div>
			<div class="card-body">
                <form method="post" name="formCadastro"  action="processoCompra/listaProduto" data_parsley_validate enctype="multipart/form-data">
                    <p> Todos os campos são obrigatórios </p>
                    <div class="row">
                        <div class="col-12 col-md-2"  style="display: none;">
                            <label for="id">ID</label>
                            <input type="text" name="id" id="id" readonly class="form-control" value="<?=$id;?>">
                        </div>
                        <div class="col-12 col-md-4 mt-2">
                            <label for="nome_produto">Nome do Produto</label>
                            <input type="text" name="nome_produto" id="nome_produto" class="form-control" value="<?=$nome_produto;?>" placeholder="Nome do produto">
                        </div>
                        <div class="col-12 col-md-4 mt-2">
                            <label for="lote">Lote</label>
                            <input type="text" name="lote" id="lote" class="form-control" value="<?=$lote;?>" placeholder="Nº Lote">
                        </div>
                        <div class="col-12 col-md-4 mt-2">
                            <label for="forncedor_id">Fornecedor</label>
                            <select name="fornecedor_id" id="fornecedor_id" class="form-control" required data-parsley-required-message="Selecione um Fornecedor">
                                <option value="<?=$fornecedor_id;?>">Selecione o Fornecedor</option>
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
                        <div class="mb-3 col-12 col-md-4 mt-2">
							<label for="data_cadastro">Data de Nascimento:</label>
							<input type="text" name="data_cadastro" id="data_cadastro" class="form-control" required data-parsley-required-message="Preencha a data de Cadastro" 
							placeholder="Ex: 11/12/1990" value="<?=$data_cadastro;?>">
						</div> 
                        <div class="row g-2">
                            <div class="col-sm-4 mt-4">
                                <button type="submit" class="btn btn-success margin mt-3">
                                    Salvar Dados
                                </button>
                            </div>
                        </div> 
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>$("#valor_unitario").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});</script>
<script type="text/javascript">
$(document).ready(function(){ 
	$("#data_cadastro").mask("00/00/0000");
	});
</script>


