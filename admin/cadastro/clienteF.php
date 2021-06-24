<?php
if (!isset($_SESSION["quanticshop"]["id"])) {
	$titulo = "Erro";
	$mensagem = "Usuário Não Logado";
	$icone = "error";
	mensagem($titulo, $mensagem, $icone);
	exit;
}

if ($_SESSION["quanticshop"]["nivelAcesso"] != "admin") {
	echo "<script>location.href='http://localhost//QuanticShop/erros/401.php'</script>";
	exit;
}

include "validacao/functions.php";

//mostrar erros
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

if (!isset($id)) $id = "";

$primeiro_nome = $sobrenome = $cpf = $data_nascimento = $email = $senha = $cep = $telefone = $celular = $foto =
	$pessoaFJ =  $estado = $cidade = $endereco = $bairro = $complemento = $numero_resid = $cidade_id = $ativo = $genero_id = "";

if (!empty($id)) {
	//selecionar os dados do cliente
	$sql =  "SELECT c.*, date_format(c.data_nascimento, '%d/%m/%Y') data_nascimento,
			ci.cidade, ci.estado FROM cliente c 
	  INNER JOIN cidade ci ON ( ci.id = c.cidade_id ) WHERE c.id = :id LIMIT 1";
	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(":id", $id);
	$consulta->execute();

	$dados = $consulta->fetch(PDO::FETCH_OBJ);

	if (!empty($dados->id)) {
		$id                      = $dados->id;
		$primeiro_nome           = $dados->primeiro_nome;
		$sobrenome               = $dados->sobrenome;
		$senha                   = $dados->senha;
		$cpf                     = $dados->cpf;
		$data_nascimento         = $dados->data_nascimento;
		$email                   = $dados->email;
		$telefone                = $dados->telefone;
		$celular                 = $dados->celular;
		$foto                    = $dados->foto;
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
}
?>
<script src="vendor/jqueryMask/src/jquery.mask.js"></script>
<div class="container-fluid p-0">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="mb-2 float-end">
					<a href="cadastro/clienteJ" class="btn btn-primary mt-2">Cad. Pessoa Juridica</a>
				</div>
				<h4>CADASTRO</h4>
				<h6 style="color: blue;"><b>Cliente | Pessoa Fisica </b></h6>
			</div>
			<div class="card-body">
				<form name="formCadastro" method="post" action="salvar/clienteF" data-parsley-validate enctype="multipart/form-data">
					<p class="card-subtitle text-muted">Todos os Campos são Obrigatórios</p><br>
					<div class="row">
						<div class="mb-3 col-12 col-md-2 mt-2" style="display: none;">
							<label for="pessoaFJ">Pessoa F/J:</label>
							<select name="pessoaFJ" id="pessoaFJ" class="form-control" required data-parsley-required-message="Selecione uma opção">
								<option value="F" <?= $pessoaFJ == 'F' ? "selected" : "" ?>>Fisica</option>
							</select>
						</div>
						<div class="mb-3 col-12 col-md-2" style="display: none;">
							<label for="id">ID:</label>
							<input type="text" name="id" id="id" class="form-control" readonly value="<?= $id; ?>">
						</div>
						<div class="mb-3 col-12 col-md-6 mt-2">
							<label for="primeiro_nome">Primeiro Nome:</label>
							<input type="text" name="primeiro_nome" id="primeiro_nome" class="form-control" required data-parsley-required-message="Preencha o Primeiro Nome" placeholder="Digite o Primeiro Nome" value="<?= $primeiro_nome; ?>">
						</div>
						<div class="mb-3 col-12 col-md-6 mt-2">
							<label for="sobrenome">Sobrenome:</label>
							<input type="text" name="sobrenome" id="sobrenome" class="form-control" required data-parsley-required-message="Preencha o Sobrenome" value="<?= $sobrenome; ?>" placeholder="Digite o Sobrenome">
						</div>
						<div class="mb-3 col-12 col-md-4 mt-2">
							<label for="cpf">CPF:</label>
							<input type="text" name="cpf" id="cpf" class="form-control" required data-parsley-required-message="Digite o CPF" inputmode="numeric" value="<?= $cpf ?>" placeholder="123.456.789-00" data-inputmask="'mask':'999.999.999-99'">
						</div>
						<div class="mb-3 col-12 col-md-4">
							<label class="form-label" for="genero_id">Gênero:</label>
							<select name="genero_id" id="genero_id" class="form-control" required data-parsley-required-message="selecione uma opção">
                                <option>Selecione o Gênero</option>
                                    <?php
                                        $sql = "SELECT * FROM genero ORDER BY id";
                                        $consulta = $pdo->prepare($sql);
                                        $consulta->execute();

                                        while ($d = $consulta->fetch(PDO::FETCH_OBJ) ) {
                                        	//separar os dados
                                            $id   = $d->id;
                                            $genero = $d->genero;
											?>
                                            <option value="<?=$id?>"<?= $id == $genero_id ? "selected" : "" ?>><?=$genero?></option>
											<?php
                                        }                    
                                    ?>
                            </select>
						</div>
						<div class="mb-3 col-12 col-md-4 mt-2">
							<label for="data_nascimento">Data de Nascimento:</label>
							<input type="text" name="data_nascimento" id="data_nascimento" class="form-control" required data-parsley-required-message="Preencha a data de nascimento" placeholder="Ex: 11/12/1990" value="<?= $data_nascimento; ?>">
						</div>
						<div class="col-12 col-md-4 mt-2">
							<?php
								$required = ' required data-parsley-required-message="Selecione um arquivo" ';
								$link = NULL;
								//verificar se a imagem não esta em branco
								if (!empty($foto)) {
									//caminho para a imagem
									$img = "../fotos/{$foto}m.jpg";
									//criar um link para abrir a imagem
									$link = "<a href='{$img}' data-lightbox='foto' class='badge badge-success' style='Color: blue;'>Abrir imagem</a>";
									$required = NULL;
								}
							?>
							<label for="foto">Imagem (JPG)* <?= $link ?></label>
							<input type="file" name="foto" id="foto" class="form-control" <?= $required ?> accept="image/jpeg">
						</div>
						<div class="mb-3 col-12 col-md-4 mt-2">
							<label for="telefone">Telefone:</label>
							<input type="text" name="telefone" id="telefone" class="form-control" placeholder="Telefone com DDD" value="<?= $telefone; ?>">
						</div>
						<div class="mb-3 col-12 col-md-4 mt-2">
							<label for="celular">Celular:</label>
							<input type="text" name="celular" id="celular" class="form-control" placeholder="Celular com DDD" value="<?= $celular; ?>" required data-parsley-required-message="Preencha o Celular">
						</div>
						<div class="mb-3 col-12 col-md-4 mt-2">
							<label for="email">E-mail:</label>
							<input type="email" name="email" id="email" class="form-control" required data-parsley-required-message="Preencha o e-mail" placeholder="exemple@hotmail.com" value="<?= $email; ?>" onblur="confirmarEmail(this.value)">
						</div>
						<div class="mb-3 col-12 col-md-4 mt-2">
							<label for="senha">Senha:</label>
							<input type="password" name="senha" id="senha" class="form-control" value="<?= $senha ?>" placeholder="Digite sua Senha">
						</div>
						<div class="mb-3 col-12 col-md-4 mt-2">
							<label for="senha2">Redigite a Senha:</label>
							<input type="password" name="senha2" id="senha2" class="form-control" data-parsley-equalto="#senha" data-parsley-trigger="keyup" data-parsley-error-message="Senha não confere" value="<?= $senha ?>" placeholder="Redigite sua Senha">
						</div>
						<div class="mb-3 col-12 col-md-3 mt-2">
							<label for="cep">CEP:</label>
							<input type="text" name="cep" id="cep" class="form-control" required data-parsley-required-message="Preencha o CEP" value="<?= $cep; ?>" placeholder="Digite o CEP da Sua Cidade">
						</div>
						<div class="mb-3 col-12 col-md-2 mt-2" style="display: none;">
							<label for="cidade_id">ID Cidade:</label>
							<input type="text" name="cidade_id" id="cidade_id" class="form-control" required data-parsley-required-message="Preencha a Cidade" readonly value="<?= $cidade_id; ?>">
						</div>
						<div class="mb-3 col-12 col-md-3 mt-2">
							<label for="cidade">Cidade:</label>
							<input type="text" id="cidade" name="cidade" class="form-control" value="<?= $cidade; ?>" placeholder="Nome da Cidade">
						</div>
						<div class="mb-3 col-12 col-md-2 mt-2">
							<label for="estado">Estado:</label>
							<input type="text" id="estado" name="estado" class="form-control" value="<?= $estado; ?>" placeholder="UF">
						</div>
						<div class="mb-3 col-12 col-md-4 mt-2">
							<label for="endereco">Endereço</label>
							<input type="text" name="endereco" id="endereco" class="form-control" value="<?= $endereco; ?>" placeholder="Av. Gopouva, Alameda Yayá">
						</div>
						<div class="mb-3 col-12 col-md-5 mt-2">
							<label for="bairro">Bairro</label>
							<input type="text" name="bairro" id="bairro" class="form-control" value="<?= $bairro; ?>" placeholder="Nome do bairro">
						</div>
						<div class="mb-3 col-12 col-md-2 mt-2">
							<label for="numero_resid">Numero Residência</label>
							<input type="text" name="numero_resid" id="numero_resid" class="form-control" value="<?= $numero_resid; ?>" placeholder="Numero da Residencia">
						</div>
						<div class="mb-3 col-12 col-md-3 mt-2">
							<label for="complemento">Complemento</label>
							<input type="text" name="complemento" id="complemento" class="form-control" value="<?= $complemento; ?>" placeholder="Casa ou Apto.">
						</div>
						<div class="col-12 col-md-2 mt-2">
							<label for="ativo">Ativo</label>
							<select name="ativo" id="ativo" class="form-control" required data-parsley-required-message="Selecione uma opção">
								<option value="">Selecione</option>
								<option value="1" <?= $ativo == '1' ? "selected" : "" ?>>Ativo</option>
								<option value="0" <?= $ativo == '0' ? "selected" : "" ?>>Inativo</option>
							</select>
						</div>
						<br>
					</div><br>
					<div class="row g-2">
						<div class="col-sm-4 mt-4">
							<button type="submit" class="btn btn-success margin">
								Salvar/Alterar Dados
							</button>
						</div>
						<div class="col-sm-2 mt-4">
							<div class="float-end ">
								<button type="reset" class="btn btn-danger margin">
									Apagar tudo
								</button>
							</div>
						</div>
						<div class="col-sm">
							<div class="float-end mt-3 ">
								<a href="listagem/cliente" class="btn btn-primary">Listar Registros</a>
							</div>
						</div>
					</div>
				</form>
				<br>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<?php
	//verificar se o id é vazio
	if (empty($id)) $id = 0;
	?>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#cep').mask('00000-000');
			$('#cpf').mask('000.000.000-00');
			$("#data_nascimento").mask("00/00/0000");
			$("#telefone").mask("(00) 0000-0000");
			$("#celular").mask("(00) 00000-0000");
		});

		function confirmarEmail(email) {
			$.get("validacao/verificaEmailCliente.php", {
				email: email,
				id: <?= $id; ?>
			}, function(dados) {
				if (dados != "") {
					alert(dados);
					$("#email").val("");
				}
			})
		}

		//executar somente depois de carregar
		$(document).ready(function() {
			//funcao para buscar o mesmo cpf
			$("#cpf").blur(function() {
				//recuperar o id e o cpf
				var id = $("#id").val();
				var cpf = $("#cpf").val();

				if (cpf != "") {
					//console.log(cpf);
					$.post("buscaCpf.php", {
							cpf: cpf,
							id: id
						},
						function(dados) {
							//console.log(dados);
							if (dados != "") {
								Swal.fire(
									'Erro', //titulo
									dados, //mensagem
									'error' //icone
								)
								$("#cpf").val("");
							}
						})
				}
			})
		});

		$("#cep").blur(function() {
			//pegar o cep
			cep = $("#cep").val();
			cep = cep.replace(/\D/g, '');
			//alert(cep);
			//verificar se esta em branco
			if (cep == "") {
				alert("Preencha o cep");
			} else {
				//consultar o cep no viacep.com.br
				$.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {
					$("#cidade").val(dados.localidade);
					$("#endereco").val(dados.logradouro);
					$("#estado").val(dados.uf);
					$("#bairro").val(dados.bairro);
					//buscar id da cidade  
					$.get("buscarCidade.php", {
						cidade: dados.localidade,
						estado: dados.uf
					}, function(dados) {
						if (dados != "Erro")
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