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
    $produto_id = $fornecedor_id = $lote = $data_cadastro = $qtd_produto = $venda_unitaria = $custo_unitario = $status = $porcentagem_lucro = "";

    //verificar se existe um id
    if ( !empty ( $id ) ) {

    include "validacao/functions.php";
   
    //selecionar os dados do banco para poder editar
    $sql="SELECT c.*, date_format(c.data_cadastro, '%d/%m/%Y') data_cadastro, f.razaoSocial, p.nome_produto
	FROM item_compra c 
    INNER JOIN fornecedor f on (f.id = c.fornecedor_id)
    INNER JOIN produto p on(p.id = c.produto_id) WHERE c.id = :id LIMIT 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":id", $id);
    $consulta->execute();
      
  	$dados  = $consulta->fetch(PDO::FETCH_OBJ);

  	//separar os dados
    $id         	          = $dados->id;
    $nome_produto 	          = $dados->nome_produto; 
    $produto_id               = $dados->produto_id;
    $custo_unitario           = $dados->custo_unitario;
    $custo_unitario           = number_format($custo_unitario,2,",",".");
    $venda_unitaria           = $dados->venda_unitaria;
    $venda_unitaria           = number_format($venda_unitaria,2,",",".");
    $porcentagem_lucro        = $dados->porcentagem_lucro;
    $data_cadastro            = $dados->data_cadastro;
    $qtd_produto              = $dados->qtd_produto;
    $fornecedor_id            = $dados->fornecedor_id;
    $razaoSocial              = $dados->razaoSocial;
    $lote                     = $dados->lote;
    $status                   = $dados->status;
    
   
        
  }

?>
<script src="assets/mask/jquery.mask.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
                        
<div class="container-fluid p-0">
	<div class="col-md-12">
		<div class="card"> 
		   <div class="card-header">
           <div class="float-end">
				<a href="processoCompra/listaProduto" class="btn btn-primary">Listagem</a> 
		   </div>
				<h4>Cadastro</h4>
				<h6 class="card-subtitle text-muted">Produto Entrada</h6>
			</div>
			<div class="card-body">
                <form method="post" name="formCadastro"  action="processoCompra/salvarProdutoCompra" data_parsley_validate enctype="multipart/form-data">
                    <p> Todos os campos são obrigatórios </p>
                    <div class="row">
                    
                    <div class="col-12 col-md-4 mt-2">
                            <label for="produto_id">Produto</label>
                            <select name="produto_id" id="produto_id" class="form-control" required data-parsley-required-message="Selecione um Produto">
                                <option value="<?=$produto_id;?>">Selecione o produto</option>
                                    <?php
                                        $sql = "SELECT id, nome_produto FROM produto
                                        ORDER BY nome_produto  WHERE ativo = 0";
                                        $consulta = $pdo->prepare($sql);
                                        $consulta->execute();

                                        while ($d = $consulta->fetch(PDO::FETCH_OBJ) ) {
                                        //separar os dados
                                            $id            = $d->id;
                                            $nome_produto  = $d->nome_produto;
                                            echo '<option value="'.$id.'">'.$nome_produto.'</option>';
                                        }
                                    ?>
                            </select>
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

                        <div type="text" class="col-12 col-md-4 mt-2 ">
                        <label >Valor de Custo</label>
                        <input type="number" id="custo_unitario" name="custo_unitario" class="form-control number_format" required data-parsley-required-message="Preencha este campo" 
                            class="form-control" value="<?=$custo_unitario;?>" placeholder="R$ 0,00">
                        </div>         
                      
                        <div type="text" class="col-12 col-md-4 mt-2">
                            <label >Margem(%)</label>
                            <input type="number" id="porcentagem_lucro" name="porcentagem_lucro" class="form-control"  required data-parsley-required-message="Preencha este campo" 
                            class="form-control" onblur="valorVenda()" value="<?=$porcentagem_lucro;?>" placeholder="%">
                        </div>
                        <div type="text" class="col-12 col-md-4 mt-2">
                            <label >Valor de Venda</label>
                            <input type="number" id="venda_unitario" name="venda_unitaria" class="form-control" required data-parsley-required-message="Preencha este campo" 
                            class="form-control" readonly value="<?=$venda_unitaria;?>" placeholder="R$ 0,00">         
                        </div>
                        <div type="text" class="col-12 col-md-4 mt-2">
                            <label for="data_cadastro">Data</label>
                            <input type="date" name="data_cadastro" id="data_cadastro" class="form-control"
                            required data-parsley-required-message="Preencha a data" value="<?=$data_cadastro?>">
                        </div>
                        <div type="text" class="col-12 col-md-4 mt-2">
							<label for="status">Status</label>
							<select name="status" id="status" class="form-control" 
								required data-parsley-required-message="Selecione uma opção">
								<!-- <option value="">...</option> -->
								<option value="1" <?= $status == '1' ? "selected" : "" ?>>Ativo</option>
								<!-- <option value="N"  <?//= $status == 'N' ? "selected" : "" ?>>Inativo</option> -->
							</select>
                        </div>
                        <div type="text" class="col-12 col-md-4 mt-2 ">
                        <label >Quantidade comprada</label>
                        <input type="number" id="qtd_produto" name="qtd_produto" class="form-control number_format" required data-parsley-required-message="Preencha este campo" 
                            class="form-control" value="<?=$qtd_produto;?>">
                        </div>       
                        <div class="row g-2">
                        <div class="col-sm-4 mt-4">
							<button type="submit" class="btn btn-success margin">
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
<script type="text/javascript">
    $("#produto").blur(function(){

        var produto = $("#produto").val();

        if ( produto != "" ) {
            //separar a string pelo -
            produto = produto.split(" - ");
           
            //jogar o id para o produto_id
            $("#produto_id").val(produto[0]);
        }
    })
</script>

<!-- <script>$("#valor_unitario").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});</script> -->
<script type="text/javascript">
$(document).ready(function(){ 
	$("#data_cadastro").mask("00/00/0000");
	});
</script>

<script type="text/javascript">
$(document).ready(function(){ 
	$("#status").val("<?=$status?>");
	});
</script>

<script>
    function valorVenda(){

        var custo = document.getElementById("custo_unitario").value;
        var porcentagem = document.getElementById("porcentagem_lucro").value;
        var venda = parseInt(custo) * parseInt(porcentagem)/100;
        document.getElementById("venda_unitario").value = venda;
        console.log(porcentagem);
        console.log(custo);
        console.log(venda);

    }
</script>

