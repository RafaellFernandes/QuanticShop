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

  $primeiro_nome = $sobrenome = $cpf = $data_nascimento = $email = $senha = $cep = $telefone = $celular = $foto = $sexo = 
  $pessoaFJ =  $estado = $cidade = $endereco = $bairro = $complemento = $numero_resid = $cidade_id = $ativo = "";

  if ( !empty ( $id ) ) {
	  //selecionar os dados do cliente
	  $sql =  "SELECT c.*, DATE_FORMAT(c.DataNascimento,'%d/%m/%Y') DataNascimento,
	  ci.cidade, ci.estado FROM cliente c 
	  INNER JOIN cidade ci ON ( ci.id = c.cidade_id ) WHERE c.id = :id LIMIT 1";
	  $consulta = $pdo->prepare( $sql);
	  $consulta->bindParam(":id", $id);
	  $consulta->execute();

	  $dados = $consulta->fetch(PDO::FETCH_OBJ);

	  if ( empty ( $dados->id ) ) {
		  echo "<p class='alert alert-danger'>Cliente Não Existente</p>";
	  }

	  $id                      = $dados->id;
	  $primeiro_nome           = $dados->primeiro_nome;
	  $sobrenome               = $dados->sobrenome;
	  $cpf                     = $dados->cpf;
	  $data_nascimento         = $dados->data_nascimento;
	  $email                   = $dados->email;
	  $senha                   = $dados->senha;
	  $telefone                = $dados->telefone;
	  $celular                 = $dados->celular;
	  $foto                    = $dados->foto;
	  $sexo                    = $dados->sexo;
	  $pessoaFJ                = $dados->pessoaFJ;
	  $cep                     = $dados->cep;
	  $estado                  = $dados->estado;
	  $cidade                  = $dados->cidade;
	  $endereco                = $dados->endereco;
	  $bairro                  = $dados->bairro;
	  $complemento             = $dados->complemento;
	  $numero_resid            = $dados->numero_resid;
	  $cidade_id               = $dados->cidade_id;
	  $ativo                   = $dados->ativo;
	  

  }
?>
<div class="container-fluid p-0">
<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<div class="float-right">
				<a href="cadastro/clienteJ" class="btn btn-primary">Cad. Pessoa Juridica</a> 
			</div>
			<h4>Cadastro</h5>
			<h6 class="card-subtitle text-muted">Cliente | Pessoa Fisica </h6>
		</div>
		<div class="card-body">
			<form name="formCadastro" method="post" action="salvar/clienteF" data-parsley-validate enctype="multipart/form-data"><!---->
				<p class="card-subtitle text-muted">Todos os Campos são Obrigatórios</p><br>
					<div class="row">
						<div class="mb-3 col-12 col-md-2">
							<label for="pessoaFJ">Pessoa F/J </label><br>
							<input type="radio" name="pessoaFJ" id="pessoaFJ" value="F" checked>
							<label class="form-check-label" for="pessoaFJ">
								 Fisica
							</label> 
							<input type="hidden" name="pessoaFJ" value="<?=$pessoaFJ?>">
							<input type="radio" name="pessoaFJ" id="pessoaFJ" value="J">
							<label class="form-check-label" for="pessoaFJ">
								 Jurudica
							</label>
							<input type="hidden" name="pessoaFJ" value="<?=$pessoaFJ?>">
						</div>	
						<div class="mb-3 col-12 col-md-2" style="display: none;">
							<label for="id">ID:</label>
							<input type="text" name="id" id="id" class="form-control" readonly value="<?=$id;?>" placeholder="Automatico">
						</div>
						<div class="mb-3 col-12 col-md-5">
							<label for="primeiro_nome">Primeiro Nome:</label>
							<input type="text" name="primeiro_nome" id="primeiro_nome" class="form-control" required data-parsley-required-message="Preencha o Primeiro Nome" 
							value="<?=$primeiro_nome;?>" placeholder="Digite o Primeiro Nome">
						</div>
						<div class="mb-3 col-12 col-md-5">
							<label for="sobrenome">Sobrenome:</label>
							<input type="text" name="sobrenome" id="sobrenome" class="form-control" required data-parsley-required-message="Preencha o Sobrenome" 
							value="<?=$sobrenome;?>" placeholder="Digite o Sobrenome">
						</div>
						<div class="mb-3 col-12 col-md-4 mt-2">
							<label for="cpf">CPF:</label>
							<input type="text" name="cpf" id="cpf" class="form-control" required data-parsley-required-message="Preencha o cpf" value="<?=$cpf;?>" onblur="verificarCpf(this.value)" placeholder="Digite seu CPF">
						</div>	
						<!-- <div class="col-12 col-md-4">
							<label for="sexo">Gênero:</label>
							<input type="text" name="sexo" id="sexo" class="form-control" value="<?//=$sexo;?>" placeholder="Gênero">
						</div>  -->
						<div class="mb-3 col-12 col-md-4">
							<label class="form-label" for="sexo">Gênero:</label>
							<select id="sexo[]" class="form-control">
								<option>...</option>
								<option name="sexo" id="sexo" class="form-control" value="<?=$sexo;?>">Mulher Cisgênero</option>
								<option name="sexo" id="sexo" class="form-control" value="<?=$sexo;?>">Homem Cisgênero</option>
								<option name="sexo" id="sexo" class="form-control" value="<?=$sexo;?>">Mulher transgênero</option>
								<option name="sexo" id="sexo" class="form-control" value="<?=$sexo;?>">Homem transgênero</option>
								<option name="sexo" id="sexo" class="form-control" value="<?=$sexo;?>">Travesti</option>
								<option name="sexo" id="sexo" class="form-control" value="<?=$sexo;?>">Gender Fluid</option>
								<option name="sexo" id="sexo" class="form-control" value="<?=$sexo;?>">Não-Binário</option>
								<option name="sexo" id="sexo" class="form-control" value="<?=$sexo;?>">Prefiro não dizer</option>
								<option name="sexo" id="sexo" class="form-control" value="<?=$sexo;?>">Outro</option>
              				</select>
						</div>
						<div class="mb-3 col-12 col-md-4 mt-2">
							<label for="data_nascimento">Data de Nascimento:</label>
							<input type="date" name="data_nascimento" id="data_nascimento" class="form-control" required data-parsley-required-message="Preencha a data de nascimento" 
							placeholder="Ex: 11/12/1990" value="<?=$data_nascimento;?>">
						</div>
						<div class="mb-3 col-12 col-md-4 mt-2">
							<label for="foto">Foto </label>
							<input type="file" name="foto" id="foto" class="form-control" >
							<input type="hidden" name="foto" value="<?=$foto?>" class="form-control">
								<?php  	
									if( !empty($foto)){
										$foto = "<img src='../fotos/".$foto."p.jpg' alt='".$primeiro_nome."' width='150px'>";
									} else{
										$foto = "";
									}
								?>
							<div><?php echo $foto;?></div>
						</div>
						<div class="mb-3 col-12 col-md-4 mt-2">
							<label for="telefone">Telefone:</label>
							<input type="text" name="telefone" id="telefone" class="form-control" placeholder="Telefone com DDD" value="<?=$telefone;?>">
						</div>
						<div class="mb-3 col-12 col-md-4 mt-2">
							<label for="celular">Celular:</label>
							<input type="text" name="celular" id="celular" class="form-control" placeholder="Celular com DDD"
							value="<?=$celular;?>" required data-parsley-required-message="Preencha o Celular">
						</div>
						<div class="mb-3 col-12 col-md-4 mt-2">
							<label for="email">E-mail:</label>
							<input type="email" name="email" id="email" class="form-control" required data-parsley-required-message="Preencha o e-mail" 
							data-parsley-type-message="Digite um E-mail válido" placeholder="exemple@hotmail.com" value="<?=$email;?>" onblur="confirmarEmail(this.value)">
						</div>
						<div class="mb-3 col-12 col-md-4 mt-2">
							<label for="senha">Senha:</label>
							<input type="password" name="senha" id="senha" class="form-control" value="<?=$senha?>" placeholder="Digite sua Senha">
						</div>
						<div class="mb-3 col-12 col-md-4 mt-2">
							<label for="senha2">Redigite a Senha:</label>
							<input type="password" name="senha2" id="senha2" class="form-control"  data-parsley-equalto="#senha" data-parsley-trigger="keyup" data-parsley-error-message="Senha não confere" value="<?=$senha?>"
							placeholder="Redigite sua Senha">
						</div>
						<div class="mb-3 col-12 col-md-3 mt-2">
							<label for="cep">CEP:</label>
							<input type="text" name="cep" id="cep" class="form-control" required data-parsley-required-message="Preencha o CEP" value="<?=$cep;?>" placeholder="Digite o CEP da Sua Cidade">
						</div>
						<div class="mb-3 col-12 col-md-2 mt-2"  style="display: none;" >
							<label for="cidade_id">ID Cidade</label>
							<input type="text" name="cidade_id" id="cidade_id" class="form-control" required data-parsley-required-message="Preencha a Cidade" readonly value="<?=$cidade_id;?>">
						</div>
						<div class="mb-3 col-12 col-md-3 mt-2">
							<label for="cidade">Cidade:</label>
							<input type="text" id="cidade" name="cidade" class="form-control"	value="<?=$cidade;?>" placeholder="Nome da Cidade">
						</div>
						<div class="mb-3 col-12 col-md-2 mt-2">
							<label for="estado">Estado:</label>
							<input type="text" id="estado" name="estado" class="form-control" value="<?=$estado;?>" placeholder="UF">
						</div>
						<div class="mb-3 col-12 col-md-4 mt-2">
							<label for="endereco">Endereço</label>
							<input type="text" name="endereco" id="endereco" class="form-control" value="<?=$endereco;?>" placeholder="Av. Gopouva, Alameda Yayá">
						</div>
						<div class="mb-3 col-12 col-md-5 mt-2">
							<label for="bairro">Bairro</label>
							<input type="text" name="bairro" id="bairro" class="form-control" value="<?=$bairro;?>" placeholder="Nome do bairro">
						</div>
						<div class="mb-3 col-12 col-md-2 mt-2">
							<label for="numero_resid">Numero Residência</label>
							<input type="text" name="numero_resid" id="numero_resid" class="form-control" value="<?=$numero_resid;?>" placeholder="Numero da Residencia">
						</div>
						<div class="mb-3 col-12 col-md-3 mt-2">
							<label for="complemento">Complemento</label>
							<input type="text" name="complemento" id="complemento" class="form-control" value="<?=$complemento;?>" placeholder="Casa ou Apto.">
						</div>
						<div class="mb-3 col-12 col-md-2 mt-2">
							<label for="ativo">Ativo</label>
							<input type="text" name="ativo" id="ativo" class="form-control" value="<?=$ativo;?>" placeholder="S ou N">
						</div>
						<br>
					</div><br>
					<button type="submit" class="btn btn-success margin">
						<!--<i class="fas fa-check"></i>--> Salvar Dados
					</button>
					<div class="float-right">
						<a href="listagem/cliente" class="btn btn-primary"><!--<i class="fas fa-bars"></i>-->Listar Registros</a> 
					</div>  
					<!-- <button type="button" id="teste" class="btn btn-info margin">
							<i class="fas fa-check"></i> teste
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
		$('#cpf').mask('000.000.000-00');
		$("#data_nascimento").mask("00/00/0000");
		$("#telefone").mask("(00) 0000-0000");
		$("#celular").mask("(00) 00000-0000");

		//mostra se o jquery esta funcionando ou nao
		/* $('#teste').click(function(){
			 console.log("Funcionando o Jquery");
		})*/
	});

	function verificarCpf(cpf) {
		$.get("validacao/verificarCpf.php", {cpf:cpf, id:<?=$id;?>}, function(dados){
			if(dados != ""){
				//mostrar erro retornado
				alert(dados);
				//zerar cpf
				$("#cpf").val("");
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
<!--  
<script>
	/**
	*  método para trocar a máscara do campo CPF/CNPJ quando o usuário alterar o tipo da pessoa. 
	* @param evt evento de alteração do valor do campo
	*/
	public void trocarMascara(ValueChangeEvent evt){
		itemSelecionado.setValue(evt.getNewValue());
		if(itemSelecionado.getValue() != null){
			mascaraCpfCnpj(itemSelecionado.getValue().toString());
		}
	}

	// método para setar a máscara
	/** * método para setar a máscara de CPF/CNPJ e o tpPessoa * @param tipoPessoa */
 	public void mascaraCpfCnpj(String tipoPessoa){ 
	 	if (tipoPessoa.equalsIgnoreCase("PJ")) {
			this.setMascaraCpfCnpj("99.999.999/9999-99"); 
			this.getPessoa().setTpPessoa("PJ"); 
		} else { 
			this.setMascaraCpfCnpj("999.999.999-99"); 
			this.getPessoa().setTpPessoa("PJ"); } 
		} 
</script>-->