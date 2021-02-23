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

  $Nome = $cpf  = $DataNascimento = $Email = $Senha = $Cep = $Endereco = $Complemento = $Bairro = $cidade_id = 
  $Foto = $Telefone = $Celular = $nome_cidade = $estado = $numeroCasa = $numeroApto = $sexo = "";

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

	  $id             = $dados->id;
	  $Nome           = $dados->Nome;
	  $DataNascimento = $dados->DataNascimento;
	  $Endereco       = $dados->Endereco;
	  $Bairro         = $dados->Bairro;
	  $cidade_id      = $dados->cidade_id;
	  $estado         = $dados->estado;
	  $Senha          = $dados->Senha;
	  $cpf            = $dados->cpf;
	  $Email          = $dados->Email;
	  $Cep            = $dados->Cep;
	  $Complemento    = $dados->Complemento;
	  $Foto           = $dados->Foto;
	  $Telefone       = $dados->Telefone;
	  $Celular        = $dados->Celular;
	  $numeroCasa     = $dados->numeroCasa;
	  $numeroApto     = $dados->numeroApto;
	  $sexo           = $dados->sexo;
	  $estado         = $dados->estado;
	  $nome_cidade    = $dados->nome_cidade;


  }
?>
<div class="container-fluid p-0">
<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h4>Cadastro</h5>
			<h6 class="card-subtitle text-muted">Cliente | Pessoa Fisica ou Juridica</h6>
		</div>
		<fieldset class="mb-3">
			<div class="row">
				<label class="col-form-label col-sm-2 text-sm-right pt-sm-0">Cliente:</label>
				<div class="col-sm-10">
					<label class="form-check">
                  		<input name="optradio" type="radio" class="form-check-input" value="fisica" onclick="pessoa(this.value);">
                  		<span class="form-check-label">Pessoa Fisica</span>
                	</label>
					<label class="form-check">
						<input name="optradio" type="radio" class="form-check-input" value="juridica" onclick="pessoa(this.value);">
						<span class="form-check-label">Pessoa Juridica</span>
                	</label>
				</div>
			</div>
		</fieldset>
		<div class="card-body">
			<form name="formCadastro" method="post" action="salvar/cliente" data-parsley-validate enctype="multipart/form-data" id="fisica" style="display:none;"><br><!---->
				<p class="card-subtitle text-muted">* Campos Obrigatórios</p><br>
					<div class="row">	
						<div class="mb-3 col-12 col-md-2" style="display: none;">
							<label for="id">ID:</label>
							<input type="text" name="id" id="id" class="form-control" readonly value="<?=$id;?>" placeholder="Automatico">
						</div>
						<div class="mb-3 col-12 col-md-6">
							<label for="Nome">* Primeiro Nome:</label>
							<input type="text" name="Nome" id="Nome" class="form-control" required data-parsley-required-message="Preencha o Primeiro Nome" 
							value="<?=$Nome;?>" placeholder="Digite o Primeiro Nome">
						</div>
						<div class="mb-3 col-12 col-md-6">
							<label for="Nome">* Sobrenome:</label>
							<input type="text" name="Nome" id="Nome" class="form-control" required data-parsley-required-message="Preencha o Sobrenome" 
							value="<?=$Nome;?>" placeholder="Digite o Sobrenome">
						</div>
						<div class="mb-3 col-12 col-md-4">
							<label for="cpf">* CPF:</label>
							<input type="text" name="cpf" id="cpf" class="form-control" required data-parsley-required-message="Preencha o cpf" value="<?=$cpf;?>" onblur="verificarCpf(this.value)" placeholder="Digite seu CPF">
						</div>	
						<!-- <div class="col-12 col-md-4">
							<label for="sexo">Gênero:</label>
							<input type="text" name="sexo" id="sexo" class="form-control" value="<?//=$sexo;?>" placeholder="Gênero">
						</div>  -->
						<div class="mb-3 col-12 col-md-4">
							<label class="form-label" for="sexo">Gênero:</label>
							<select id="sexo" class="form-control">
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
						<div class="mb-3 col-12 col-md-4">
							<label for="DataNascimento">* Data de Nascimento:</label>
							<input type="text" name="DataNascimento" id="DataNascimento" class="form-control" required data-parsley-required-message="Preencha a data de nascimento" 
							placeholder="Ex: 11/12/1990" value="<?=$DataNascimento;?>">
						</div>
						<div class="mb-3 col-12 col-md-4">
							<label for="Foto">* Foto </label>
							<input type="file" name="Foto" id="Foto" class="form-control" >
							<input type="hidden" name="Foto" value="<?=$Foto?>" class="form-control">
								<?php  	
									if( !empty($Foto)){
										$Foto = "<img src='../fotos/".$Foto."p.jpg' alt='".$Nome."' width='150px'>";
									} else{
										$Foto = "";
									}
								?>
							<div><?php echo $Foto;?></div>
						</div>
						<div class="mb-3 col-12 col-md-4">
							<label for="Telefone">Telefone:</label>
							<input type="text" name="Telefone" id="Telefone" class="form-control" placeholder="Telefone com DDD" value="<?=$Telefone;?>">
						</div>
						<div class="mb-3 col-12 col-md-4">
							<label for="Celular">* Celular:</label>
							<input type="text" name="Celular" id="Celular" class="form-control" placeholder="Celular com DDD"
							value="<?=$Celular;?>" required data-parsley-required-message="Preencha o Celular">
						</div>
						<div class="mb-3 col-12 col-md-4">
							<label for="Email">* E-mail:</label>
							<input type="email" name="Email" id="Email" class="form-control" required data-parsley-required-message="Preencha o e-mail" 
							data-parsley-type-message="Digite um E-mail válido" placeholder="exemple@hotmail.com" value="<?=$Email;?>" onblur="confirmarEmail(this.value)">
						</div>
						<div class="mb-3 col-12 col-md-4">
							<label for="Senha">* Senha:</label>
							<input type="password" name="Senha" id="Senha" class="form-control" value="<?=$Senha?>" placeholder="Digite sua Senha">
						</div>
						<div class="mb-3 col-12 col-md-4">
							<label for="senha2">* Redigite a Senha:</label>
							<input type="password" name="senha2" id="senha2" class="form-control"  data-parsley-equalto="#Senha" data-parsley-trigger="keyup" data-parsley-error-message="Senha não confere" value="<?=$Senha?>"
							placeholder="Redigite sua Senha">
						</div>
						<div class="mb-3 col-12 col-md-3">
							<label for="Cep">* CEP:</label>
							<input type="text" name="Cep" id="Cep" class="form-control" required data-parsley-required-message="Preencha o CEP" value="<?=$Cep;?>" placeholder="Digite o CEP da Sua Cidade">
						</div>
						<div class="mb-3 col-12 col-md-2" style="display: none;">
							<label for="cidade_id">ID Cidade</label>
							<input type="text" name="cidade_id" id="cidade_id" class="form-control" required data-parsley-required-message="Preencha a Cidade" readonly value="<?=$cidade_id;?>">
						</div>
						<div class="mb-3 col-12 col-md-3">
							<label for="nome_cidade">* Cidade:</label>
							<input type="text" id="nome_cidade" name="nome_cidade" class="form-control"	value="<?=$nome_cidade;?>" placeholder="Nome da Cidade">
						</div>
						<div class="mb-3 col-12 col-md-2">
							<label for="estado">* Estado:</label>
							<input type="text" id="estado" name="estado" class="form-control" value="<?=$estado;?>" placeholder="UF" readonly>
						</div>
						<div class="mb-3 col-12 col-md-4">
							<label for="Endereco">* Endereço</label>
							<input type="text" name="Endereco" id="Endereco" class="form-control" value="<?=$Endereco;?>" placeholder="Av. Gopouva, Alameda Yayá">
						</div>
						<div class="mb-3 col-12 col-md-5">
							<label for="Bairro">* Bairro</label>
							<input type="text" name="Bairro" id="Bairro" class="form-control" value="<?=$Bairro;?>" placeholder="Nome do bairro">
						</div>
						<div class="mb-3 col-12 col-md-3">
							<label for="numeroCasa">* Numero Residência</label>
							<input type="text" name="numeroCasa" id="numeroCasa" class="form-control" value="<?=$numeroCasa;?>" placeholder="Numero da casa">
						</div>
						<div class="mb-3 col-12 col-md-4">
							<label for="numeroApto">Apartamento</label>
							<input type="text" name="numeroApto" id="numeroApto" class="form-control" value="<?=$numeroApto;?>" placeholder="Numero do Apto com andar e bloco">
						</div>
						<div class="mb-3 col-12 col-md-4">
							<label for="Complemento">Complemento</label>
							<input type="text" name="Complemento" id="Complemento" class="form-control" value="<?=$Complemento;?>">
						</div><br>
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

			<form name="formCadastro" method="post" action="salvar/cliente" data-parsley-validate enctype="multipart/form-data" id="juridica" style="display:none;"><br><!-- -->
				<p class="card-subtitle text-muted">* Campos Obrigatórios</p><br>
					<div class="row">	
						<div class="mb-3 col-12 col-md-12">
							<label for="Razaosocial">* Razão Social: </label>
							<input type="text" class="form-control" id="Razaosocial" name="Razaosocial" required>
						</div>
						<div class="mb-3 col-12 col-md-12">
							<label for="Nomefantasia">* Nome Fantasia: </label>
							<input type="text" class="form-control" id="Nomefantasia" required name="Nomefantasia">
						</div>
						<div class="mb-3 col-12 col-md-6">
							<label for="cnpj">* Cnpj:</label>
							<input type="text" name="cnpj" id="cnpj" class="form-control" value="<?=$cnpj;?>" onblur="validaCnpj(this.value)">
						</div> 
						<div class="mb-3 col-12 col-md-6">
							<label for="ie">* Inscrição Estadual (IE): </label>
							<input type="text" name="ie" id="ie" class="form-control" value="<?=$ie;?>">
						</div> 
						<div class="mb-3 col-12 col-md-6">
							<label for="Telefone">* Telefone:</label>
							<input type="text" name="Telefone" id="Telefone" class="form-control" placeholder="Telefone com DDD" value="<?=$Telefone;?>" require>
						</div>
						<div class="mb-3 col-12 col-md-6">
							<label for="Celular">Celular:</label>
							<input type="text" name="Celular" id="Celular" class="form-control" placeholder="Celular com DDD" value="<?=$Celular;?>">
						</div>
						<div class="mb-3 col-12 col-md-4">
							<label for="Email">* E-mail:</label>
							<input type="email" name="Email" id="Email" class="form-control" required data-parsley-required-message="Preencha o e-mail" 
							data-parsley-type-message="Digite um E-mail válido" placeholder="exemple@hotmail.com" value="<?=$Email;?>" onblur="confirmarEmail(this.value)">
						</div>
						<div class="mb-3 col-12 col-md-4">
							<label for="Senha">* Senha:</label>
							<input type="password" name="Senha" id="Senha" class="form-control" value="<?=$Senha?>" placeholder="Digite sua Senha">
						</div>
						<div class="mb-3 col-12 col-md-4">
							<label for="senha2">* Redigite a Senha:</label>
							<input type="password" name="senha2" id="senha2" class="form-control"  data-parsley-equalto="#Senha" data-parsley-trigger="keyup" data-parsley-error-message="Senha não confere" value="<?=$Senha?>"
							placeholder="Redigite sua Senha">
						</div>
						<div class="mb-3 col-12 col-md-4">
							<label for="Cep">* CEP:</label>
							<input type="text" name="Cep" id="Cep" class="form-control" required data-parsley-required-message="Preencha o CEP" value="<?=$Cep;?>" placeholder="Digite o CEP da Sua Cidade">
						</div>
						<div class="mb-3 col-12 col-md-2" style="display: none;">
							<label for="cidade_id">ID Cidade</label>
							<input type="text" name="cidade_id" id="cidade_id" class="form-control" required data-parsley-required-message="Preencha a Cidade" readonly value="<?=$cidade_id;?>">
						</div>
						<div class="mb-3 col-12 col-md-4">
							<label for="nome_cidade">* Cidade:</label>
							<input type="text" id="nome_cidade" name="nome_cidade" class="form-control"	value="<?=$nome_cidade;?>" placeholder="Nome da Cidade">
						</div>
						<div class="mb-3 col-12 col-md-2">
							<label for="estado">* Estado:</label>
							<input type="text" id="estado" name="estado" class="form-control" value="<?=$estado;?>" placeholder="UF" readonly>
						</div>
						<div class="mb-3 col-12 col-md-6">
							<label for="Endereco">* Endereço</label>
							<input type="text" name="Endereco" id="Endereco" class="form-control" value="<?=$Endereco;?>" placeholder="Av. Gopouva, Alameda Yayá">
						</div>
						<div class="mb-3 col-12 col-md-6">
							<label for="Bairro">* Bairro</label>
							<input type="text" name="Bairro" id="Bairro" class="form-control" value="<?=$Bairro;?>" placeholder="Nome do bairro">
						</div><br>
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
<script>
    function pessoa(tipo){
      	if(tipo=="fisica"){
      		document.getElementById("fisica").style.display = "inline";
      		document.getElementById("juridica").style.display = "none";
      	}else if(tipo=="juridica"){
      		document.getElementById("fisica").style.display = "none";
      		document.getElementById("juridica").style.display = "inline";
      	}
    }
</script>
<script type="text/javascript">

	$(document).ready(function(){ 
		$('#Cep').mask('00000-000');
		$('#cpf').mask('000.000.000-00');
		$("#DataNascimento").mask("00/00/0000");
		$("#Telefone").mask("(00) 0000-0000");
		$("#Celular").mask("(00) 00000-0000");
		$("#cnpj").mask("00.000.000/0000-00");

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

	function validaCnpj(cnpj) {
		$.get("validacao/validaCnpj.php", {cnpj:cnpj, id:<?=$id;?>}, function(dados){
			if(dados != ""){
				//mostrar erro retornado
				alert(dados);
				//zerar Cnpj
				$("#cnpj").val("");
			}
		})
	}

	function confirmarEmail(Email){
		   $.get("validacao/verificaEmail.php", {Email:Email,id:<?=$id;?>}, function(dados){
			   if(dados != ""){
				   alert(dados);
				   $("#Email").val("");
			   }
		   }) 
	}

	$("#Cep").blur(function(){
		//pegar o cep
        cep = $("#Cep").val();
        cep = cep.replace(/\D/g, '');
        //alert(cep);
		//verificar se esta em branco
        if(cep == ""){
            alert("Preencha o cep");
        } else {
            //consultar o cep no viacep.com.br
            $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados){
				$("#nome_cidade").val(dados.localidade);
                $("#Endereco").val(dados.logradouro);
                $("#estado").val(dados.uf);
				$("#Bairro").val(dados.bairro);   
                //buscar id da cidade  
                    $.get("buscarCidade.php", {cidade: dados.localidade, estado: dados.uf}, function(dados){
                        if(dados != "Erro")
                            $("#cidade_id").val(dados);
						else 
                            alert(dados);	 
                    })
                    //focar no complemento
                    $("#Bairro").focus();
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