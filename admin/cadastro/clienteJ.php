<?php

  //verificar se não está logado
  if ( !isset ( $_SESSION["quanticshop"]["id"] ) ){
    exit;
  }

    //mostrar erros
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
    error_reporting(E_ALL);
  
  if ( !isset ( $id ) ) $id = "";

   $email = $senha = $cep = $telefone = $celular = $pessoaFJ = $nomeFantasia = $razaoSocial = $cnpj = $inscricao_estadual =  $estado = $cidade = $endereco = $bairro = 
   $numero_resid = $cidade_id = $ativo = $siteJ = $complemento =  $genero_id = "";

  if ( !empty ( $id ) ) {
	  //selecionar os dados do cliente
	  $sql =  "SELECT c.*, ci.cidade, ci.estado FROM cliente c 
	  INNER JOIN cidade ci ON ( ci.id = c.cidade_id ) WHERE c.id = :id LIMIT 1";
	  $consulta = $pdo->prepare( $sql);
	  $consulta->bindParam(":id", $id);
	  $consulta->execute();

	  $dados = $consulta->fetch(PDO::FETCH_OBJ);

	  if ( empty ( $dados->id ) ) {
		  echo "<p class='alert alert-danger'>Cliente Não Existente</p>";
	  }

	  $id                      = $dados->id;
	  $email                   = $dados->email;
	  $senha                   = $dados->senha;
	  $telefone                = $dados->telefone;
	  $celular                 = $dados->celular;
	  $pessoaFJ                = $dados->pessoaFJ;
	  $nomeFantasia            = $dados->nomeFantasia;
	  $razaoSocial             = $dados->razaoSocial;
	  $cnpj                    = $dados->cnpj;
	  $inscricao_estadual      = $dados->inscricao_estadual;
	  $cep                     = $dados->cep;
	  $estado                  = $dados->estado;
	  $cidade                  = $dados->cidade;
	  $endereco                = $dados->endereco;
	  $bairro                  = $dados->bairro;
	  $complemento             = $dados->complemento;
	  $numero_resid            = $dados->numero_resid;
	  $cidade_id               = $dados->cidade_id;
      $siteJ                   = $dados->siteJ;
	  $ativo                   = $dados->ativo;
	  $genero_id               = $dados->genero_id;
	  

  }
?>
<div class="container-fluid p-0">
<div class="col-md-12">
	<div class="card">
		<div class="card-header">
            <div class="float-right">
				<a href="cadastro/clienteF" class="btn btn-primary">Cad. Pessoa Fisica</a> 
			</div>
			<h4>Cadastro</h5>
			<h6 class="card-subtitle text-muted">Cliente | Pessoa Juridica</h6>
		</div>
		<div class="card-body">
			<form name="formCadastro" method="post" action="salvar/clienteJ" data-parsley-validate enctype="multipart/form-data">
				<p class="card-subtitle text-muted">Todos os Campos são Obrigatórios</p><br>
					<div class="row">	
						<div class="mb-3 col-12 col-md-2" style="display: none;">
							<label for="id">ID:</label>
							<input type="text" name="id" id="id" class="form-control" readonly value="<?=$id;?>" placeholder="Automatico">
						</div>
                        <div class="mb-3 col-12 col-md-2">
							<label for="pessoaFJ">pessoaF/J:</label>
							<input type="text" name="pessoaFJ" id="pessoaFJ" class="form-control"  value="<?=$pessoaFJ;?>" placeholder="F ou J">
						</div>
                        <div class="mb-3 col-12 col-md-10">
							<label for="razaoSocial">Razão Social: </label>
							<input type="text" class="form-control" id="razaoSocial" name="razaoSocial" required>
						</div>
						<div class="mb-3 col-12 col-md-12">
							<label for="nomeFantasia">Nome Fantasia: </label>
							<input type="text" class="form-control" id="nomeFantasia" required name="nomeFantasia">
						</div>
                        
						<div class="mb-3 col-12 col-md-4">
							<label class="form-label" for="genero_id">Gênero:</label>
							<select name="genero_id" id="genero_id" class="form-control" required data-parsley-required-message="selecione uma opção">
                                <option value="<?=$genero_id;?>">Selecione o Gênero</option>
                                    <?php
                                        $sql = "SELECT * FROM genero ORDER BY id";
                                        $consulta = $pdo->prepare($sql);
                                        $consulta->execute();

                                        while ($d = $consulta->fetch(PDO::FETCH_OBJ) ) {
                                        //separar os dados
                                            $id   = $d->id;
                                            $genero = $d->genero;
                                            echo '<option value="'.$id.'">'.$genero.'</option>';
                                        }                    
                                    ?>
                            </select>
						</div>

						<div class="mb-3 col-12 col-md-4 mt-2">
							<label for="cnpj">CNPJ:</label>
							<input type="text" name="cnpj" id="cnpj" class="form-control" value="<?=$cnpj;?>" onblur="validaCNPJ(this.value)">
						</div> 
						<div class="mb-3 col-12 col-md-4 mt-2">
							<label for="inscricao_estadual"> Inscrição Estadual (IE): </label>
							<input type="text" name="inscricao_estadual" id="inscricao_estadual" class="form-control" value="<?=$inscricao_estadual;?>">
						</div> 
						<div class="mb-3 col-12 col-md-4 mt-2">
							<label for="telefone">Telefone:</label>
							<input type="text" name="telefone" id="telefone" class="form-control" placeholder="Telefone com DDD" value="<?=$telefone;?>" require>
						</div>
						<div class="mb-3 col-12 col-md-4 mt-2">
							<label for="celular">Celular:</label>
							<input type="text" name="celular" id="celular" class="form-control" placeholder="Celular com DDD" value="<?=$celular;?>">
						</div>
						<div class="mb-3 col-12 col-md-4 mt-2">
							<label for="email">E-mail:</label>
							<input type="email" name="email" id="email" class="form-control" required data-parsley-required-message="Preencha o e-mail" 
							data-parsley-type-message="Digite um E-mail válido" placeholder="exemple@hotmail.com" value="<?=$email;?>" onblur="confirmarEmail(this.value)">
						</div>
                        <div class="mb-3 col-12 col-md-4 mt-2">
							<label for="siteJ">Site:</label>
							<input type="text" name="siteJ" id="siteJ" class="form-control" required data-parsley-required-message="Preencha o site" 
							 placeholder="www.exemplo.com" value="<?=$siteJ;?>">
						</div>
						<div class="mb-3 col-12 col-md-4 mt-2">
							<label for="senha">Senha:</label>
							<input type="password" name="senha" id="senha" class="form-control" value="<?=$senha?>" placeholder="Digite sua Senha">
						</div>
						<div class="mb-3 col-12 col-md-4 mt-2">
							<label for="senha2">Redigite a Senha:</label>
							<input type="password" name="senha2" id="senha2" class="form-control"  data-parsley-equalto="#senha" data-parsley-trigger="keyup" 
                            data-parsley-error-message="Senha não confere" value="<?=$senha?>" placeholder="Redigite sua Senha">
						</div>
						<div class="mb-3 col-12 col-md-4 mt-2">
							<label for="cep">CEP:</label>
							<input type="text" name="cep" id="cep" class="form-control" required data-parsley-required-message="Preencha o CEP" value="<?=$cep;?>" placeholder="Digite o CEP da Sua Cidade">
						</div>
						<div class="mb-3 col-12 col-md-2">
							<label for="cidade_id">ID Cidade</label>
							<input type="text" name="cidade_id" id="cidade_id" class="form-control" required data-parsley-required-message="Preencha a Cidade" readonly value="<?=$cidade_id;?>">
						</div>
						<div class="mb-3 col-12 col-md-4 mt-2">
							<label for="cidade">Cidade:</label>
							<input type="text" id="cidade" name="cidade" class="form-control"	value="<?=$cidade;?>" placeholder="Nome da Cidade">
						</div>
						<div class="mb-3 col-12 col-md-4 mt-2">
							<label for="estado">Estado:</label>
							<input type="text" id="estado" name="estado" class="form-control" value="<?=$estado;?>" placeholder="UF">
						</div>
						<div class="mb-3 col-12 col-md-6 mt-2">
							<label for="endereco">Endereço:</label>
							<input type="text" name="endereco" id="endereco" class="form-control" value="<?=$endereco;?>" placeholder="Avenida ou Rua ">
						</div>
						<div class="mb-3 col-12 col-md-6 mt-2">
							<label for="bairro">Bairro:</label>
							<input type="text" name="bairro" id="bairro" class="form-control" value="<?=$bairro;?>" placeholder="Nome do bairro">
						</div>
						<div class="mb-3 col-12 col-md-3 mt-2">
							<label for="numero_resid">Numero:</label>
							<input type="text" name="numero_resid" id="numero_resid" class="form-control" value="<?=$numero_resid;?>" placeholder="Numero da Residencia">
						</div>
						 <div class="mb-3 col-12 col-md-3 mt-2">
							<label for="complemento">Complemento:</label>
							<input type="text" name="complemento" id="complemento" class="form-control" value="<?=$complemento;?>">
						</div> 
						<div class="mb-3 col-12 col-md-2 mt-2">
							<label for="ativo">Ativo</label>
							<input type="text" name="ativo" id="ativo" class="form-control" value="<?=$ativo;?>" placeholder="S ou N">
						</div><br>
					</div><br>
					<button type="submit" class="btn btn-success margin">
						Salvar Dados
					</button>
					<div class="float-right">
						<a href="listagem/cliente" class="btn btn-primary">Listar Registros</a> 
					</div>  
					<!-- <button type="button" id="teste" class="btn btn-info margin">
							<i class="fas fa-check"></i> teste style="display: none;"
					</button>  -->						
			</form>
			<br><div class="clearfix"></div>
		</div>
	</div>
</div>		
<?php
	//verificar se o id é vazio
	if ( empty ( $id ) ) $id = 0;
?>
<script type="text/javascript">

	$(document).ready(function(){ 
		$('#cep').mask('00000-000');
		$("#telefone").mask("(00) 0000-0000");
		$("#celular").mask("(00) 00000-0000");
		$("#cnpj").mask("00.000.000/0000-00");

		//mostra se o jquery esta funcionando ou nao
		/* $('#teste').click(function(){
			 console.log("Funcionando o Jquery");
		})*/
	});

	function validaCNPJ(cnpj) {
		$.get("validacao/validaCnpj.php", {cnpj:cnpj, id:<?=$id;?>}, function(dados){
			if(dados != ""){
				//mostrar erro retornado
				alert(dados);
				//zerar Cnpj
				$("#cnpj").val("");
			}
		})
	}

	function confirmarEmail(email){
		   $.get("validacao/verificaEmail.php", {email:email,id:<?=$id;?>}, function(dados){
			   if(dados != ""){
				   alert(dados);
				   $("#email").val("");
			   }
		   }) 
	}

	$("#cep").blur(function(){
		//pegar o cep
        cep = $("#cep").val();
        cep = cep.replace(/\D/g, '');
        //alert(cep);
		//verificar se esta em branco
        if(cep == ""){
            alert("Preencha o cep");
        } else {
            //consultar o cep no viacep.com.br
            $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados){
				$("#cidade").val(dados.localidade);
                $("#endereco").val(dados.logradouro);
                $("#estado").val(dados.uf);
				$("#bairro").val(dados.bairro);   
                //buscar id da cidade  
                    $.get("buscarCidade.php", {cidade: dados.localidade, estado: dados.uf}, function(dados){
                        if(dados != "Erro")
                            $("#cidade_id").val(dados);
						else 
                            alert(dados);	 
                    })
                    //focar no complemento
                    $("#bairro").focus();
            })
        }
    });	
</script>
</div>