<?php

  if ( isset ( $id ) ) $id = "";

  $Nome = $Cpf = $DataNascimento = $Email = $Senha = $Cep = $Endereco = $Complemento = $Bairro = $cidade_id = 
  $Foto = $Telefone = $Celular = $nome_cidade = $estado = $numeroCasa = "";

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
	  $nome_cidade    = $dados->nome_cidade;
	  $estado         = $dados->estado;
	  $Cpf            = $dados->Cpf;
	  $Email          = $dados->Email;
	  $Cep            = $dados->Cep;
	  $Complemento    = $dados->Complemento;
	  $Foto           = $dados->Foto;
	  $Telefone       = $dados->Telefone;
	  $Celular        = $dados->Celular;
	  $numeroCasa     = $dados->numeroCasa;


  }
  
?>



<div class="main">
      <div class="shop_top">
	     <div class="container">
						<form> 
								<div class="register-top-grid">
										<h3>PERSONAL INFORMATION</h3>
										<div>
											<span>First Name<label>*</label></span>
											<input type="text"> 
										</div>
										<div>
											<span>Last Name<label>*</label></span>
											<input type="text"> 
										</div>
										<div>
											<span>Email Address<label>*</label></span>
											<input type="text"> 
										</div>
										<div class="clear"> </div>
											<a class="news-letter" href="#">
												<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i>Sign Up for Newsletter</label>
											</a>
										<div class="clear"> </div>
								</div>
								<div class="clear"> </div>
								<div class="register-bottom-grid">
										<h3>LOGIN INFORMATION</h3>
										<div>
											<span>Password<label>*</label></span>
											<input type="text">
										</div>
										<div>
											<span>Confirm Password<label>*</label></span>
											<input type="text">
										</div>
										<div class="clear"> </div>
								</div>
								<div class="clear"> </div>
								<input type="submit" value="submit">
						</form>
					</div>
		   </div>
    </div>
    --------------------------------------------------------------------
<br><br><br><br>
<div class="row justify-content-center mt-5">
<div class="register-box ">
  <div class="register-logo">
  <b>Cadastre-se</b>
  </div>
<!-- ------------------------------------------------------------------- -->
 <div class="justify-content-center"> 
   <!-- <div class="content-wrapper">  -->
      <div class="content-header"> 
         <div > 
          <form name="formCadastro" method="post" action="../admin/salvar/cliente" data-parsley-validate enctype="multipart/form-data">
            <div class="justify-content-center"> 
              <!-- <div class="col-12 col-md-2">
                <label for="id">ID:</label>
                <input type="text" name="id" id="id" class="form-control" readonly value="<?//=$id;?>">
              </div> -->
              <div class="col-12 col-md-12">
                <label for="Nome">Nome:</label>
                <input type="text" name="Nome" id="Nome" class="form-control" required data-parsley-required-message="Preencha o Nome" 
                value="<?=$Nome;?>" placeholder="Digite seu nome completo">
              </div>

              <div class="col-12 col-md-12">
                <label for="Cpf">CPF:</label>
                <input type="text" name="Cpf" id="Cpf" class="form-control" required data-parsley-required-message="Preencha o cpf" 
                value="<?=$Cpf;?>" onblur="validaCpf(this.value)">
              </div>
              <div class="col-12 col-md-12">
                <label for="DataNascimento">Data de Nascimento:</label>
                <input type="text" name="DataNascimento" id="DataNascimento" class="form-control" required data-parsley-required-message="Preencha a data de nascimento" 
                placeholder="Ex: 11/12/1990" value="<?=$DataNascimento;?>">
              </div>
              <div class="col-12 col-md-12">
                <label for="Foto">Foto (JPG)</label>
                <input type="file" name="Foto" id="Foto" class="form-control">
                <input type="hidden" name="Foto" value="<?=$Foto?>" class="form-control">
                <?php  
                  
                if( !empty($Foto)){
                  $Foto = "<img src='../fotos/".$Foto."p.jpg' alt='".$Nome."' width='150px'>";
                } else{
                  $Foto = "";
                }?>
                <div><?php echo $Foto;?></div>
              </div>

              <div class="col-12 col-md-12">
                <label for="Telefone">Telefone:</label>
                <input type="text" name="Telefone" id="Telefone" class="form-control" placeholder="Telefone com DDD"
                value="<?=$Telefone;?>">
              </div>
              <div class="col-12 col-md-12">
                <label for="Celular">Celular:</label>
                <input type="text" name="Celular" id="Celular" class="form-control" placeholder="Celular com DDD"
                value="<?=$Celular;?>" required data-parsley-required-message="Preencha o Celular">
              </div>

              <div class="col-12 col-md-12">
                <label for="Email">E-mail:</label>
                <input type="email" name="Email" id="Email" class="form-control" required data-parsley-required-message="Preencha o e-mail" 
                data-parsley-type-message="Digite um E-mail válido" placeholder="exemple@hotmail.com"
                value="<?=$Email;?>"" onblur="confirmarEmail(this.value)">
              </div>

              <div class="col-12 col-md-12">
                <label for="Senha">Senha:</label>
                <input type="password" name="Senha" id="Senha" class="form-control" value="<?=$Senha?>">
              </div>
              <div class="col12 col-md-12">
                <label for="senha2">Redigite a Senha:</label>
                <input type="password" name="senha2" id="senha2" class="form-control"  data-parsley-equalto="#Senha" data-parsley-trigger="keyup" data-parsley-error-message="Senha não confere" value="<?=$Senha?>">
              </div>

              <div class="col-12 col-md-12">
                <label for="Cep">CEP:</label>
                <input type="text" name="Cep" id="Cep" class="form-control" required data-parsley-required-message="Preencha o CEP"
                value="<?=$Cep;?>">
              </div>
              <!-- <div class="col-12 col-md-12">
                <label for="cidade_id">ID Cidade</label>
                <input type="text" name="cidade_id" id="cidade_id" class="form-control" required data-parsley-required-message="Preencha a Cidade" readonly value="<?=$cidade_id;?>">
              </div> -->
              <div class="col-12 col-md-12">
                <label for="nome_cidade">Nome da Cidade:</label>
                <input type="text" id="nome_cidade" name="nome_cidade" class="form-control"
                value="<?=$nome_cidade;?>">
              </div>
              <div class="col-12 col-md-12">
                <label for="estado">Estado:</label>
                <input type="text" id="estado" name="estado" class="form-control"
                value="<?=$estado;?>">
              </div>
              <div class="col-12 col-md-12">
                <label for="Endereco">Endereço</label>
                <input type="text" name="Endereco" id="Endereco" class="form-control"
                value="<?=$Endereco;?>">
              </div>
              <div class="col-12 col-md-12">
                <label for="Bairro">Bairro</label>
                <input type="text" name="Bairro" id="Bairro" class="form-control"
                value="<?=$Bairro;?>">
              </div>
              <div class="col-12 col-md-12">
                <label for="numeroCasa">Numero Residência</label>
                <input type="text" name="numeroCasa" id="numeroCasa" class="form-control"
                value="<?=$numeroCasa;?>">
              </div>
              <div class="col-12 col-md-12">
                <label for="Complemento">Complemento</label>
                <input type="text" name="Complemento" id="Complemento" class="form-control"
                value="<?=$Complemento;?>">
              </div>
            </div>
            <br>
            <button type="submit" class="btn btn-success margin">
              <i class="fas fa-check"></i> Salvar Dados
            </button>
          </form>
			</div>
		</div>
	</div>
</div>
<?php
		//verificar se o id é vazio
		if ( empty ( $id ) ) $id = 0;
	?>

	<script>
		$(document).ready(function(){
			$('#Cep').mask('00000-000');
			$('#Cpf').mask('000.000.000-00');
			$("#DataNascimento").mask("00/00/0000");
			$("#Telefone").mask("(00) 0000-0000");
			$("#Celular").mask("(00) 00000-0000");
	
		});
	</script>
	<script type="text/javascript">
		function validaCpf(Cpf) {
			//funcao ajax para verificar o cpf
			$.get("admin/validacao/validaCpf.php",{Cpf:Cpf,id:<?=$id;?>}, function(dados){
					if ( dados != "" ) {
						//mostrar o erro retornado
						alert(dados);
						//zerar o cpf
						$("#Cpf").val("");
					}
			})
		}

		function confirmarEmail(Email){
               $.get("admin/validacao/verificaEmail.php", {Email:Email,id:<?=$id;?>}, function(dados){
                   if(dados != ""){
                       alert(dados);
                       $("#Email").val("");
                   }
               }) 
        }
			
		$("#Cep").blur(function(){
                cep = $("#Cep").val();
                cep = cep.replace(/\D/g, '');
                //alert(cep);
                if(cep == ""){
                    alert("Preencha o cep");
                } else{
                    //consultar o cep no viacep.com.br
                     $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados){
                        $("#nome_cidade").val(dados.localidade);
                		$("#Endereco").val(dados.logradouro);
                		$("#estado").val(dados.uf);
						$("#Bairro").val(dados.bairro);
                         //buscar id da cidade
                         
                         $.get("admin/buscarCidade.php", {cidade: dados.localidade, estado: dados.uf}, function(dados){
                             if(dados != "Erro")
                                 $("#cidade_id").val(dados);
                             else
                                alert(dados);
                         })
                         //focar no complemento
                         $("#Endereco").focus();
                     })
                }
            })
		
	</script>
</div>
</body>
