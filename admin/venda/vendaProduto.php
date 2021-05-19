<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["quanticshop"]["id"] ) ){
    exit;
  }

  $tabela = "vendas";

  //iniciar as variaveis 
  $cliente_id = $status = $data = 
  $cliente = NULL; 

  //se nao existe o id
  if ( !isset ( $id ) ) $id = "";

  //verificar se existe um id
  if ( !empty ( $id ) ) {
  	//selecionar os dados do banco
  	$sql = "SELECT * FROM venda
  		WHERE id = ? LIMIT 1";
  	$consulta = $pdo->prepare($sql);
  	$consulta->bindParam(1, $id); 
  	$consulta->execute();
  	$dados  = $consulta->fetch(PDO::FETCH_OBJ);

  	//separar os dados
  	$id 	      = $dados->id;
	$cliente_id   = $dados->cliente_id;
	$status       = $dados->status;
    $data         = $dados->data;

  } 
  
  if ( !empty ( $id ) ) {

    //sql para recuperar os dados daquele id
    $sql = "select v.*, date_format(v.data,'%Y-%m-%d') data,
        c.primeiro_nome, c.sobrenome, c.razaoSocial, c.celular 
        from venda v 
        inner join cliente c on (c.id = v.cliente_id)
        where v.id = :id limit 1";
    //pdo - preparar
    $consulta = $pdo->prepare($sql);
    //passar um parametro - id
    $consulta->bindParam(':id', $id);
    //executar o sql
    $consulta->execute();

    $dados = $consulta->fetch(PDO::FETCH_OBJ);

    //recuperar os dados
    $celular = $dados->celular;
    $primeiro_nome = $dados->primeiro_nome;
    $sobrenome = $dados->sobrenome;
    $razaoSocial= $dados->razaoSocial;
    $id = $dados->id;
    $status = $dados->status;
    $data = $dados->data;
    $cliente_id = $dados->cliente_id;
   

    //formatar o nome do cliente
    $primeiro_nome = "{$cliente_id} - {$primeiro_nome} - {$sobrenome} - {$razaoSocial} - {$celular}";
}
?>
<div class="container-fluid p-0">
	<div class="row">
		<div class="col-12 col-xl-12">
			<div class="card">
				<div class="card-header">
					<div class="float-end">	
            <a href="venda/<?=$tabela?>" class="btn btn-primary">Cadastrar Novo</a>
            <a href="venda/<?=$tabela?>" class="btn btn-primary">Listar</a>
        </div>
                <h4>Cadastro</h4>
				<h6 class="card-subtitle text-muted">Marca</h6>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="venda/<?=$tabela?>" data-parsley-validate="">
            <div class="row">
               
                <div class="col-12 col-md-4">
                    <label for="data">Data:</label>
                    <input type="date" name="data"
                    id="data" class="form-control"
                    required data-parsley-required-message="Preencha a data"
                    value="<?=$data?>">
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

                <div class="col-12 col-md-8">
                            <label for="cliente_id">Cliente</label>
                            <select name="cliente_id" id="cliente_id" class="form-control" required data-parsley-required-message="selecione uma opção">
                                <option value="<?=$cliente_id;?>"></option>
                                    <?php
                                        $sql = "SELECT id, primeiro_nome, sobrenome, razaoSocial, celular  FROM cliente ORDER BY primeiro_nome";
                                        $consulta = $pdo->prepare($sql);
                                        $consulta->execute();

                                        while ($d = $consulta->fetch(PDO::FETCH_OBJ) ) {
                                        //separar os dados
                                            $id   = $d->id;
                                            $primeiro_nome = $d->primeiro_nome;
                                            $sobrenome = $d->sobrenome;
                                            $razaoSocial = $d->razaoSocial;
                                            $celular = $d->celular;
                                            echo '<option value="'.$id.'">'.$primeiro_nome.' '.$sobrenome.' '.$razaoSocial.' '.$celular.' </option>';
                                        }                    
                                    ?>
                            </select>
                </div> <!-- col -->
            </div> <!-- row -->
            <br>
            <button type="submit" class="btn btn-success float-right">
                Salvar/Alterar Dados
            </button>
        </form> <!-- form -->
    </div> <!-- card body -->
</div> <!-- card -->


