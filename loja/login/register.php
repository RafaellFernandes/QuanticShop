<?php

  //verificar se não está logado
  if ( isset ( $_SESSION["quanticshop"]["id"] ) ){
    exit;
  }

    //mostrar erros
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
    error_reporting(E_ALL);
  
  if ( !isset ( $id ) ) $id = "";

  $primeiro_nome = $sobrenome = $cpf = $data_nascimento = $email = $senha = $cep = $telefone = $celular =
  $pessoaFJ =  $estado = $cidade = $endereco = $bairro = $complemento = $numero_resid = $cidade_id = $ativo = $genero_id = "";

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
	  $genero_id               = $dados->genero_id;

  }
?>
<!-- ==================================== -->
<!--    LINKS DE MASCARAS E VALIDAÇOES    -->
<!-- ==================================== -->
<script src="assets/mask/jquery.mask.js"></script>

<div class="main">
      <div class="shop_top">
	     <div class="container">
			<form name="formCadastro" method="post" action="salvarCliente" data-parsley-validate enctype="multipart/form-data" > 
				<div class="register-top-grid">
					<h3>INFORMAÇÕES PESSOAIS</h3>

                    <div style="display: none;">
                      <label for="id">ID:</label>
                      <input type="text" name="id" id="id" class="form-control" readonly value="<?=$id;?>" placeholder="Automatico">
                    </div>

					<div>
						<span>
                        PRIMEIRO NOME
                        <label for="primeiro_nome"></label>
                        </span>
						<input name="primeiro_nome" id="primeiro_nome" class="form-control" required data-parsley-required-message="Preencha o Primeiro Nome" 
							value="<?=$primeiro_nome;?>" placeholder="Digite o Primeiro Nome"> 
					</div>

					<div>
						<span>
                        SOBRENOME
                        <label for="sobrenome"></label>
                        </span>
						<input type="text" name="sobrenome" id="sobrenome" class="form-control" required data-parsley-required-message="Preencha o Sobrenome" 
						value="<?=$sobrenome;?>" placeholder="Digite o Sobrenome"> 
					</div>

					<div>
						<span>
                        CPF
                        <label for="cpf"></label>
                        </span>
						<input type="text" name="cpf" inputmode="numeric"  id="cpf" class="form-control" required data-parsley-required-message="Preencha o cpf"  
						onblur="verificarCpf(this.value)" value="<?=$cpf;?>" placeholder="Digite seu CPF" data-inputmask="'mask':'999.999.999-99'"> 
					</div>

                    <div>
						<span>
                        GENERO
                        <label class="form-label" for="genero_id"></label>
                      	</span>
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

                    <div>
						<span>DATA DE NASCIMENTO<label for="data_nascimento"></label></span>
						<input type="text" name="data_nascimento" id="data_nascimento" class="form-control" required data-parsley-required-message="Preencha a data de nascimento" 
						placeholder="Ex: 11/12/1990" value="<?=$data_nascimento;?>"> 
					</div>

                    <div>
                      <span>TELEFONE<label for="telefone"></label></span>
                      <input type="text" name="telefone" id="telefone" class="form-control" placeholder="Telefone com DDD" value="<?=$telefone;?>">
                    </div>

                    <div>
                      <span>CELULAR<label for="celular"></label></span>
                      <input type="text" name="celular" id="celular" class="form-control" placeholder="Celular com DDD"
                      value="<?=$celular;?>" required data-parsley-required-message="Preencha o Celular">
                    </div>

                    <div class="clear"> </div>

                    <div class="register-center-grid" style="text-justify: left;">
                      	<h3>INFORMAÇÕES DE SOBRE CIDADE</h3>
                    </div>
						<div>
							<span>CEP<label for="cep"></label></span>
							<input type="text" name="cep" id="cep" class="form-control" required data-parsley-required-message="Preencha o CEP" value="<?=$cep;?>" placeholder="Digite o CEP da Sua Cidade">
						</div>

						<div>
							<label for="cidade_id">ID Cidade</label>
							<input type="text" name="cidade_id" id="cidade_id" class="form-control" required data-parsley-required-message="Preencha a Cidade" readonly value="<?=$cidade_id;?>">
						</div>

						<div>
							<span>CIDADE<label for="cidade"></label></span>
							<input type="text" id="cidade" name="cidade" class="form-control"	value="<?=$cidade;?>" placeholder="Nome da Cidade">
						</div>

						<div>
							<span>ESTADO<label for="estado"></label></span>
							<input type="text" id="estado" name="estado" class="form-control" value="<?=$estado;?>" placeholder="UF">
						</div>

						<div>
							<span>ENDEREÇO<label for="endereco"></label></span>
							<input type="text" name="endereco" id="endereco" class="form-control" value="<?=$endereco;?>" placeholder="Av. Gopouva, Alameda Yayá">
						</div>

						<div>
							<span>BAIRRO<label for="bairro"></label></span>
							<input type="text" name="bairro" id="bairro" class="form-control" value="<?=$bairro;?>" placeholder="Nome do bairro">
						</div>

						<div>
							<span>NUMERO RESIDENCIA<label for="numero_resid"></label></span>
							<input type="text" name="numero_resid" id="numero_resid" class="form-control" value="<?=$numero_resid;?>" placeholder="Numero da Residencia">
						</div>

						<div>
							<span>COMPLEMENTO<label for="complemento"></label></span>
							<input type="text" name="complemento" id="complemento" class="form-control" value="<?=$complemento;?>" placeholder="Apartamento, Andar, Sala, Conjunto, etc">
						</div>		
					</div>
					<div class="clear"> </div>
					<div class="register-bottom-grid">
						<h3 class="mt-4 mb-4">INFORMAÇÕES DE LOGIN</h3>
                    		<div>
								<span>ENDEREÇO DE E-MAIL<label for="email"></label></span>
								<input type="email" name="email" id="email" class="form-control" required data-parsley-required-message="Preencha o e-mail" 
							      data-parsley-type-message="Digite um E-mail válido" placeholder="exemple@hotmail.com" value="<?=$email;?>" onblur="confirmarEmail(this.value)">
							</div>
							<div>
								<span>SENHA<label for="senha"></label></span>
								<input type="password" name="senha" id="senha" class="form-control" value="<?=$senha?>" placeholder="Digite sua Senha">
							</div>
							<div>
								<span>CONFIRME A SENHA<label for="senha2"></label></span>
								<input type="password" name="senha2" id="senha2" class="form-control"  data-parsley-equalto="#senha" data-parsley-trigger="keyup" data-parsley-error-message="Senha não confere" value="<?=$senha?>"
								placeholder="Redigite sua Senha">
							</div>
						<div class="clear"> </div>
					</div>
					<div class="clear"> </div>		
                </div>
                <button type="submit" class="btn btn-success margin">
					Enviar
				</button>
			</form>
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

	
	});

	// $("#cpf").blur(function(){
    //     //recuperar o id e o cpf
    //     var id = $("#id").val();
    //     var cpf = $("#cpf").val();

    //     if ( cpf != "" ){
    //         //console.log(cpf);
    //         $.post("verificarCpf.php",
    //             {cpf:cpf,id:id},
    //             function(dados){
    //                 //console.log(dados);
    //                 if (dados != "") {
    //                     // Swal.fire(
    //                     //   'Erro', //titulo
    //                     //   dados, //mensagem
	// 					// )
	// 					alert(dados);
	// 				}
	// 			}
	// 		)}
	// });
	// function verificarCpf(cpf) {
	// 	$.get("verificarCpf.php", {cpf:cpf, id:<?//=$id;?>}, function(dados){
	// 		if(dados != ""){
	// 			//mostrar erro retornado
	// 		//echo ($dados);
	// 			alert(dados);
	// 			//zerar cpf
	// 			$("#cpf").val("");
	// 		}
	// 	})
	// }

	// function confirmarEmail(email){
	// 	   $.get("validacao/verificaEmail.php", {email:email,id:<?//=$id;?>}, function(dados){
	// 		   if(dados != ""){
	// 			   alert(dados);
	// 			   $("#email").val("");
	// 		   }
	// 	   }) 
	// }


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