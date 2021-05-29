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
    $cliente_id = $venda_id = $status = $valorTotal = "";

    //verificar se existe um id
    if ( !empty ( $id ) ) {
        //selecionar os dados do banco para poder editar
        $sql="SELECT c.*,v.* FROM pedido p
        left join cliente c on (c.id = p.cliente_id)
        left join venda v on(v.id = p.venda_id)
        WHERE p.id = :id LIMIT 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->execute();
        
        $dados  = $consulta->fetch(PDO::FETCH_OBJ);

        $id = "";

        if ( !empty ( $dados->id ) ) {
  
            //separar os dados
            $id         	          = $dados->id;
            $venda_id	              = $dados->venda_id; 
            $cliente_id               = $dados->cliente_id;
            $primeiro_nome            = $dados->primeiro_nome;
            $status                   = $dados->status;
            $valorTotal               = $dados->valorTotal;
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
				<h6 class="card-subtitle text-muted">Pedido</h6>
			</div>
			<div class="card-body">
                <form method="post" name="formCadastro"  action="processoCompra/salvarProdutoCompra" data_parsley_validate enctype="multipart/form-data">
                    <p> Todos os campos são obrigatórios </p>
                    <div class="row">
                    
                    <div class="col-12 col-md-4 mt-2">
                            <label for="venda_id">Venda</label>
                            <select name="venda_id" id="venda_id" class="form-control" required data-parsley-required-message="Selecione um Produto">
                                <option value="<?=$venda_id;?>"></option>
                                    <?php
                                        $sql = "SELECT * FROM pedido WHERE 
                                        ORDER BY id ";
                                        $consulta = $pdo->prepare($sql);
                                        $consulta->execute();

                                        while ($d = $consulta->fetch(PDO::FETCH_OBJ) ) {
                                        //separar os dados
                                            $id = $d->id;
                                            echo '<option value="'.$id.'">'.$id.'</option>';
                                        }
                                    ?>
                            </select>
                        </div>

                <div class="col-10">
                    <label for="cliente">Selecione o Cliente</label>
                    <input type="text" name="cliente"
                    id="cliente" required
                    data-parsley-required-message="Selecione um cliente"
                    list="clientes"
                    class="form-control"
                    value="<?=$cliente?>">

                    <datalist id="clientes">
                        <?php
                            $sql = "select id, primeiro_nome, sobrenome, razaoSocial, celular from cliente
                                order by primeiro_nome";
                            $consulta = $pdo->prepare($sql);
                            $consulta->execute();
                            while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ){

                                echo "<option value='{$dados->id} - {$dados->primeiro_nome} {$dados->sobrenome}  {$dados->razaoSocial}'>";

                            }
                        ?>
                    </datalist>
                </div> <!-- col -->
                        <div type="text" class="col-12 col-md-4 mt-2">
                            <label for="data_cadastro">Data</label>
                            <input type="date" name="data_cadastro" id="data_cadastro" class="form-control"
                            required data-parsley-required-message="Preencha a data" value="<?=$data_cadastro?>">
                        </div>
                        <div class="col-12 col-md-6">
                    <label for="status">Status:</label>
                    <select name="status" id="status"
                    class="form-control" required
                    data-parsley-required-message="Selecione um Status">
                        <option value=""></option>
                        <option value="A">Aguardando Pagamento</option>
                        <option value="P">Pago</option>
                        <option value="C">Cancelado</option>
                        <option value="E">Extraviado</option>
                        <option value="D">Devolvido</option>
                        <option value="T">Troca</option>
                    </select>

                    <script>
                        $("#status").val("<?=$status?>");
                    </script>
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

