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
$qtd_produto = $valor_bruto = $data_atualizacao = $estoque_minimo = $produto_id = $nome_produto = "";

  //verificar se existe um id
  if ( !empty ( $id ) ) {

    include "../admin/validacao/functions.php";
   
  	//selecionar os dados do banco para poder editar
      $sql = "SELECT * FROM estoque WHERE id = :id LIMIT 1";
      $consulta = $pdo->prepare($sql);
      $consulta->bindParam(":id", $id);
      $consulta->execute();
      
  	$dados  = $consulta->fetch(PDO::FETCH_OBJ);

  	//separar os dados
    $id         	  = $dados->id;
    $qtd_produto 	  = $dados->qtd_produto; 
    $valor_bruto      = $dados->valor_bruto;
    $valor_bruto      = number_format($valor_bruto,2,",",".");
    $data_atualizacao = $dados->data_atualizacao;
    $estoque_minimo   = $dados->estoque_minimo;
    $produto_id       = $dados->produto_id;
    $nome_produto     = $dados->nome_produto;
  }

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>                      
<div class="container-fluid p-0">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h4>Estoque</h4>
				<h6 class="card-subtitle text-muted">Controle de Estoque</h6>
			</div>
			<div class="card-body">
                <form method="post" name="formCadastro"  action="salvar/estoque" data_parsley_validate enctype="multipart </form-data">
                    <p> Todos os campos são obrigatórios </p>
                    <div class="row">
                        <div class="col-12 col-md-2"  style="display: none;">
                            <label for="id">ID</label>
                            <input type="text" name="id" id="id" readonly class="form-control" value="<?=$id;?>">
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="produto_id">ID Produto</label>
                            <select name="produto_id" id="produto_id" class="form-control" required data-parsley-required-message="selecione uma opção">
                                <option value="<?=$produto_id;?>"></option>
                                    <?php
                                        $sql = "SELECT * FROM produto ORDER BY nome_produto";
                                        $consulta = $pdo->prepare($sql);
                                        $consulta->execute();

                                        while ($d = $consulta->fetch(PDO::FETCH_OBJ) ) {
                                        //separar os dados
                                            $id   = $d->id;
                                            $nome_produto = $d->nome_produto;
                                            echo '<option value="'.$id.'">'.$nome_produto.'</option>';
                                        }                    
                                    ?>
                            </select>
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="qtd_produto">Quantidade em Estoque</label>
                            <input type="text" name="qtd_produto" id="qtd_produto" required data-parsley-required-message="Preencha este campo" class="form-control" value="<?=$qtd_produto;?>">
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="valor_bruto">Valor</label>
                            <input type="text" name="valor_bruto" id="valor_bruto" required data-parsley-required-message="Preencha este campo" class="form-control" value="<?=$valor_bruto;?>" placeholder="R$ 0,00">
                        </div>

                        <!-- <div class="col-12 col-md-4 mt-3">
                            <label for="data_atualizacao">Data de Atualização</label>
                            <input type="text" name="data_atualizacao" id="data_atualizacao" class="form-control" require data-parsley-required-message="Por favor, preencha este campo" 
                            value="<?//=$data_atualizacao;?>">
                        </div> -->
                       
                        <div class="col-12 col-md-4 mt-3">
                            <div class="form-group">
                                <label for="data_atualizacao">Data de Atualização</label>
                                <!-- Datepicker as text field -->         
                                <div class="input-group date" data-date-format="dd/mm/yyyy">
                                <input  type="text" class="form-control" name="data_atualizacao" id="data_atualizacao" require data-parsley-required-message="Por favor, preencha este campo" placeholder="dd/mm/yyyy" value="<?=$data_atualizacao;?>">
                                <div class="input-group-addon" >
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4 mt-3">
                            <label for="estoque_minimo">Estoque Minimo</label>
                            <input type="text" name="estoque_minimo" id="estoque_minimo" required data-parsley-required-message="Preencha este campo" class="form-control border border-danger" value="<?=$estoque_minimo;?>">
                        </div>
                        
                    </div>
                    <button type="submit" class="btn btn-success margin mt-3">
                        Salvar Dados
                    </button>
                    <div class="float-right">
                        <a href="listagem/produto" class="btn btn-primary mt-3">Listar Registro</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>$("#valor_bruto").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#qtd_estoque").mask("999999");
    });
</script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js'></script>
<script>
 $('.input-group.date').datepicker({format: "dd/mm/yyyy"});
</script>




