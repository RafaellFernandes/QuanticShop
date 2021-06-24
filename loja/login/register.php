<?php
	if ( isset ( $_SESSION["quanticshop"]["id"] ) )exit;

	//mostrar erros
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
	error_reporting(E_ALL);
	
	if ( !isset ( $id ) ) $id = "";

	$primeiro_nome = $sobrenome = $cpf = $data_nascimento = $email = $senha = $cep = $telefone = $celular =
	$pessoaFJ =  $estado = $cidade = $endereco = $bairro = $complemento = $numero_resid = $cidade_id = $ativo = $genero_id = "";

	if ( !empty ( $id ) ) {
		//selecionar os dados do cliente
		$sql =  "SELECT c.*, DATE_FORMAT(c.data_nascimento,'%d/%m/%Y') data_nascimento,
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
<script src="assets/mask/jquery.mask.js"></script>
<div class="container-fluid p-0 mt-3">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header">
                <h4 class="text-center">Cadastre-se</h4>
            </div>
            <div class="card-body">
				<form name="formCadastro" method="post" action="login/salvarCliente" data-parsley-validate enctype="multipart/form-data" > 
					<div class="row">
						<div style="display: none;">
							<label for="id">ID:</label>
							<input type="text" name="id" id="id" class="form-control" readonly value="<?=$id;?>" placeholder="id">
						</div>
						<div class="col-12 col-md-4">
							<span>Primeiro Nome<label for="primeiro_nome"></label></span>
							<input name="primeiro_nome" 
								id="primeiro_nome"
								class="form-control" 
								required data-parsley-required-message="Preencha o Primeiro Nome" 
								value="<?=$primeiro_nome;?>" 
								placeholder="Digite o Primeiro Nome"> 
						</div>
						<div class="col-12 col-md-4">
							<span> Sobrenome<label for="sobrenome"></label></span>
							<input type="text" 
								name="sobrenome" 
								id="sobrenome"
								class="form-control" 
								required data-parsley-required-message="Preencha o Sobrenome" 
								value="<?=$sobrenome;?>" 
								placeholder="Digite o Sobrenome"> 
						</div>
						<div class="col-12 col-md-4">
							<span>CPF<label for="cpf"></label></span>
							<input type="text" 
								name="cpf" 
								inputmode="numeric" 
								id="cpf"
								class="form-control" 
								required data-parsley-required-message="Preencha o cpf"  
								onblur="verificarCpf(this.value)" 
								value="<?=$cpf;?>" 
								placeholder="Digite seu CPF" 
								data-inputmask="'mask':'999.999.999-99'"> 
						</div>
						<div class="col-12 col-md-2 mt-2">
							<span>Gênero<label class="form-label" for="genero_id"></label></span>
							<select name="genero_id" id="genero_id" class="form-control" required data-parsley-required-message="selecione uma opção">
								<option value="<?=$genero_id;?>">Selecione seu Gênero</option>
								<?php
									$sql = "SELECT * FROM genero ORDER BY id";
									$consulta = $pdo->prepare($sql);
									$consulta->execute();
									while ($d = $consulta->fetch(PDO::FETCH_OBJ) ) {
										echo "<option value={$d->id}>{$d->genero}</option>";
									}                    
								?>
							</select>
						</div>
						<div class="col-12 col-md-2 mt-2">
							<span>Data de Nascimento<label for="data_nascimento"></label></span>
							<input type="text"
								name="data_nascimento" 
								id="data_nascimento"
								class="form-control" 
								required data-parsley-required-message="Preencha a data de nascimento" 
								placeholder="Ex: 11/12/1990" 
								value="<?=$data_nascimento;?>"> 
						</div>
						<div class="col-12 col-md-2 mt-2">
							<span>Celular<label for="celular"></label></span>
							<input type="text" 
								name="celular" 
								id="celular" 
								class="form-control" 
								placeholder="Celular com DDD"
								value="<?=$celular;?>" 
								required data-parsley-required-message="Preencha o Celular">
						</div>
						<div class="col-12 col-md-2 mt-2">
							<span>Cep<label for="cep"></label></span>
							<input type="text"
								name="cep" 
								id="cep" 
								class="form-control" 
								required data-parsley-required-message="Preencha o CEP" 
								value="<?=$cep;?>" 
								placeholder="Digite o CEP da Sua Cidade">
						</div>
						<div class="col-12 col-md-2 mt-2" style="display: none;">
							<label for="cidade_id">ID Cidade</label>
							<input type="text" 
								name="cidade_id" 
								id="cidade_id" 
								class="form-control"
								required data-parsley-required-message="Preencha a Cidade" 
								readonly 
								value="<?=$cidade_id;?>">
						</div>
						<div class="col-12 col-md-2 mt-2">
							<span>Cidade<label for="cidade"></label></span>
							<input type="text"
								id="cidade" 
								name="cidade" 
								class="form-control"	
								value="<?=$cidade;?>" 
								placeholder="Nome da Cidade">
						</div>
						<div class="col-12 col-md-2 mt-2">
							<span>Estado<label for="estado"></label></span>
							<input type="text" 
								id="estado" 
								name="estado"
								class="form-control" 
								value="<?=$estado;?>" 
								placeholder="UF">
						</div>
						<div class="col-12 col-md-4 mt-2">
							<span>Endereço<label for="endereco"></label></span>
							<input type="text" 
								name="endereco"
								id="endereco"
								class="form-control" 
								value="<?=$endereco;?>" 
								placeholder="Avenida, Rua, Viela, ...">
						</div>
						<div class="col-12 col-md-4 mt-2">
							<span>Bairro<label for="bairro"></label></span>
							<input type="text"
								name="bairro"
								id="bairro"
								class="form-control"
								value="<?=$bairro;?>" 
								placeholder="Nome do bairro">
						</div>
						<div class="col-12 col-md-2 mt-2">
							<span>N° Residencia<label for="numero_resid"></label></span>
							<input type="text" 
								name="numero_resid" 
								id="numero_resid" 
								class="form-control" 
								value="<?=$numero_resid;?>" 
								placeholder="Numero da Residencia">
						</div>
						<div class="col-12 col-md-2 mt-2">
							<span>Complemento<label for="complemento"></label></span>
							<input type="text"
								name="complemento" 
								id="complemento" 
								class="form-control" 
								value="<?=$complemento;?>" 
								placeholder="Apartamento, Andar, Sala, Conjunto, etc">
						</div>		
						<div class="col-12 col-md-3 mt-2">
							<span>E-mail<label for="email"></label></span>
							<input type="email" 
								name="email" 
								id="email"
								class="form-control" 
								required data-parsley-required-message="Preencha o e-mail" 
								data-parsley-type-message="Digite um E-mail válido" 
								placeholder="exemple@hotmail.com" 
								value="<?=$email;?>" 
								onblur="confirmarEmail(this.value)">
						</div>
						<div class="col-12 col-md-3 mt-2">
							<span>Senha<label for="senha"></label></span>
							<input type="password" 
								name="senha" 
								id="senha"
								class="form-control" 
								value="<?=$senha?>" 
								placeholder="Digite sua Senha Min:5 Max: 20"
								minlength="5"
								maxlength="20">
						</div>
						<div class="col-12 col-md-3 mt-2">
							<span>Redigite sua Senha<label for="senha2"></label></span>
							<input type="password" 
								name="redigite" 
								id="redigite" 
								class="form-control"  
								data-parsley-equalto="#senha" 
								value="<?=$senha?>"
								placeholder="Redigite sua Senha"
								data-parsley-equalto="#senha"
        						data-parsley-equalto-message="As senhas devem ser iguais">
						</div>
						<div class="col-12 col-md-3 mt-2">
                            <?php
                                $required = ' required data-parsley-required-message="Selecione um arquivo" ';
                                $link = NULL;
                                //verificar se a imagem não esta em branco
                                if ( !empty ( $foto ) ) {
                                    //caminho para a imagem
                                    $img = "../fotos/{$foto}m.jpg";
                                    //criar um link para abrir a imagem
                                    $link = "<a href='{$img}' data-lightbox='foto' class='badge badge-success'>Abrir imagem</a>";
                                    $required = NULL;
                                }
                            ?>
                            <label for="foto">Imagem (JPG)* <?=$link?>:</label>
                            <input type="file" 
								name="foto" 
								id="foto" 
								class="form-control"
								<?=$required?>
								accept="image/jpeg">
                        </div>
						<div class="col-12 col-md-2 mt-2" style="display: none;">
							<label for="ativo">Ativo</label>
							<select name="ativo" id="ativo" class="form-control" 
								required data-parsley-required-message="Selecione uma opção">
								<option value="1" <?= $ativo == '1' ? "selected" : "" ?>>Ativo</option>
							</select>
                        </div>
						<div class="col-12 col-md-2 mt-2" style="display: none;">
							<label for="pessoaFJ">Pessoa Fisica Juridica</label>
							<select name="pessoaFJ" id="pessoaFJ" class="form-control" 
								required data-parsley-required-message="Selecione uma opção">
								<option value="F" <?= $pessoaFJ == 'F' ? "selected" : "" ?>>Pessoa Fisica</option>
							</select>
                        </div>
					</div>
					<div class="container">
						<div class="float-left mt-5">
							<button type="reset" class="btn btn-danger margin">
								Apagar Tudo
							</button>
							<div class="float-end mt-4">
								<button type="submit" class="btn btn-success margin">
									Salvar
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
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
		$("#celular").mask("(00) 00000-0000");
	});
	function confirmarEmail(email){
		   $.get("validacao/verificaEmailCliente.php", {email:email,id:<?=$id;?>}, function(dados){
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
