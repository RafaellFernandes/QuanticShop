<?php
  if (!isset($_SESSION["quanticshop"]["id"])) {
    $titulo = "Erro";
    $mensagem = "Usuário Não Logado";
    $icone = "error";
    mensagem($titulo, $mensagem, $icone);
exit;
}

if ($_SESSION["quanticshop"]["nivelAcesso"] != "admin") {
    $titulo = "Erro";
    $mensagem = "Erro na Requisição da Página";
    $icone = "error";
    mensagem($titulo, $mensagem, $icone);
exit;
}
include "validacao/functions.php";
    //mostrar erros
    ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
    error_reporting(E_ALL);

    //se nao existe o id
    if ( !isset ( $id ) ) $id = "";

    //iniciar as variaveis
    $produto_id = $nome_produto = $lote = $fornecedor_id = $razaoSocial = $data_cadastro = $ativo = $qtdprodutoComprado = $venda_unitaria = $custo_unitario = $porcentagem_lucro = "";

    //verificar se existe um id
    if ( !empty ( $id ) ) {
        //selecionar os dados do banco para poder editar
        $sql="SELECT ic.id id, ic.*, f.id fid, f.ativo fativo , f.*, p.id pid, p.ativo pativo, p.* 
                FROM item_compra ic 
                INNER JOIN fornecedor f ON (ic.fornecedor_id = f.id ) 
                INNER JOIN produto p ON (ic.produto_id = p.id ) 
                WHERE ic.id = :id LIMIT 1";

        $sql="SELECT ic.id id, ic.*,  p.id pid, p.valor_unitario, p.* 
        FROM item_compra ic 
        INNER JOIN produto p on (p.id = item_compra.produto.id)
        UPDATE id p.venda_unitaria = : valor_unitario WHERE ic.id = :id LIMIT 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->execute();
        
        $dados  = $consulta->fetch(PDO::FETCH_OBJ);

        $id = "";

        if ( !empty ( $dados->id ) ) {
  
            //separar os dados
            $id         	          = $dados->id;
            $nome_produto 	          = $dados->nome_produto; 
            $produto_id               = $dados->produto_id;
            $fornecedor_id            = $dados->fornecedor_id;
            $razaoSocial              = $dados->razaoSocial;
            $data_cadastro            = $dados->data_cadastro;
            $lote                     = $dados->lote;
            $ativo                    = $dados->ativo;
            $qtdprodutoComprado       = $dados->qtdprodutoComprado;
            $venda_unitaria           = $dados->venda_unitaria;
            $custo_unitario           = $dados->custo_unitario;
            $porcentagem_lucro        = $dados->porcentagem_lucro;
            // $pativo                   = $dados->pativo;
        }
    }

?>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>                       -->
<div class="container-fluid p-0">
	<div class="col-md-12">
		<div class="card"> 
		   <div class="card-header">
           <!-- <div class="float-end">
				<a href="processoCompra/listaProduto" class="btn btn-primary">Listagem</a> 
		   </div> -->
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
                                <option value="<?=$produto_id;?>"></option>
                                    <?php
                                        $sql = "SELECT * FROM produto WHERE ativo = 0 
                                        ORDER BY nome_produto  ";
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
                            <input type="number" id="venda_unitaria" name="venda_unitaria" class="form-control" required data-parsley-required-message="Preencha este campo" 
                            class="form-control" readonly value="<?=$venda_unitaria;?>" placeholder="R$ 0,00">         
                        </div>
                        <div type="text" class="col-12 col-md-4 mt-2">
                            <label for="data_cadastro">Data</label>
                            <input type="date" name="data_cadastro" id="data_cadastro" class="form-control"
                            required data-parsley-required-message="Preencha a data" value="<?=$data_cadastro?>">
                        </div>
                        <div class="col-12 col-md-2 mt-2">
							<label for="ativo">Ativo</label>
							<select name="ativo" id="ativo" class="form-control" 
								required data-parsley-required-message="Selecione uma opção">
								<option value="">...</option>
								<option value="1" <?= $ativo == '1' ? "selected" : "" ?>>Ativo</option>
								<option value="0"  <?= $ativo == '0' ? "selected" : "" ?>>Inativo</option>
							</select>
                        </div>
                            <div type="text" class="col-12 col-md-4 mt-2 ">
                            <label >Quantidade comprada</label>
                            <input type="number" id="qtdprodutoComprado" name="qtdprodutoComprado" class="form-control number_format" required data-parsley-required-message="Preencha este campo" 
                                class="form-control" value="<?=$qtdprodutoComprado;?>">
                        </div>       
                        <div class="row g-2">
                            <div class="col-sm-4 mt-4">
                                <button type="submit" class="btn btn-success margin">
                                    Salvar Dados
                                </button>
                            </div>
                            <div class="col-sm-4 mt-4">
                            <div class="float-center text-center">
                                <a href="controleEstoque/estoque" class="btn btn-danger">Estoque</a> 
                            </div> 
                        </div>
                        <div class="col-sm-4 mt-4">
                            <div class="float-end">
                                <a href="processoCompra/listaProduto" class="btn btn-primary">Listar Registros</a> 
                            </div> 
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
 var venda = parseInt(custo) * parseInt(porcentagem/100);
 document.getElementById("venda_unitario").value = venda;
 console.log(porcentagem);
 console.log(custo);
 console.log(venda);

    }
</script>
<script>
    function valorVenda(){
        var custo = document.getElementById('custo_unitario').value;
        var porcentagem = document.getElementById('porcentagem_lucro').value;

        var maior = (parseFloat(custo) > parseFloat(porcentagem)? custo : porcentagem);
        var menor = (parseFloat(custo) < parseFloat(porcentagem)? custo : porcentagem);
        // var porcentagem = porcentagem/100;
        var venda = (menor/maior)*100;
 
        // var venda = custo * (porcentagem / 0.01);
        
        document.getElementById('venda_unitaria').value = venda;
        
        console.log(porcentagem);
        
        console.log(venda);
    }
</script>

