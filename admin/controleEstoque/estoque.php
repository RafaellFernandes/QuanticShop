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
$produto_id = $qtd_estoque = "";

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
    $qtd_estoque 	  = $dados->qtd_estoque; 
    $produto_id       = $dados->produto_id;
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
                <form method="post" name="formCadastro"  action="controleEstoque/salvarEstoque" data_parsley_validate enctype="multipart </form-data">
                    <p> Todos os campos são obrigatórios </p>
                    <div class="row">
                        <div class="col-12 col-md-2"  style="display: none;">
                            <label for="id">ID</label>
                            <input type="text" name="id" id="id" readonly class="form-control" value="<?=$id;?>">
                        </div>
                        <div class="col-12 col-md-8">
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
                            <label for="qtd_estoque">Quantidade em Estoque</label>
                            <input type="number" name="qtd_estoque" id="qtd_estoque" required data-parsley-required-message="Preencha este campo" class="form-control" value="<?=$qtd_estoque;?>">
                        </div>

                        <div class="row g-2">
                            <div class="col-sm-4 mt-4">
                                <button type="submit" class="btn btn-success margin mt-3">
                                    Salvar Dados
                                </button>
                            </div>
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




