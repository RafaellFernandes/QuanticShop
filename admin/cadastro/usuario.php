<?php
  //verificar se não está logado
  
  if ( !isset ( $_SESSION["quanticshop"]["id"] ) ){
    exit;
  }

  include "validacao/functions.php";

  //mostrar erros
  ini_set('display_errors',1);
  ini_set('display_startup_erros',1);
  error_reporting(E_ALL);
	
  if ( !isset ( $id ) ) $id = "";

  $primeiro_nome = $sobrenome = $email = $login = $senha = $cidade_id = $foto = $cep = $cidade = 
  $estado = $bairro = $complemento = $numero_resid = $endereco = $ativo = $genero_id = $dataNascimento = $cpf = $celular ="";

if(!empty($id)){
    //selecionar dados
    $sql = "SELECT u.id as idusuario, u.*, c.* FROM usuario u INNER JOIN cidade c ON (c.id = u.cidade_id)
            WHERE u.id = :id limit 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":id",$id);
    $consulta->execute();
    
    $dados = $consulta->fetch(PDO::FETCH_OBJ);
    
    if(empty($dados->id)){
		$titulo = "Erro";
		$mensagem = "Usuário Não Existente";
		$icone = "error";
		mensagem($titulo, $mensagem, $icone);
        // echo "<p class='alert alert-danger'>Usuario não existe! </p>";
        exit;
    }
    
    $id                     = $dados->idusuario;
	$primeiro_nome          = $dados->primeiro_nome;
    $sobrenome              = $dados->sobrenome;
    $email                  = $dados->email;
    $login                  = $dados->login;
    $senha                  = $dados->senha;
    $foto                   = $dados->foto;
	$cidade_id              = $dados->cidade_id;
	$cidade                 = $dados->cidade;
	$estado                 = $dados->estado;
	$cep                    = $dados->cep;
	$complemento            = $dados->complemento;
	$bairro                 = $dados->bairro;
	$numero_resid           = $dados->numero_resid;
	$endereco               = $dados->endereco;
	$ativo 		            = $dados->ativo;
	$dataNascimento         = $dados->dataNascimento;
	$genero_id              = $dados->genero_id;
	$cpf                    = $dados->cpf;
	$celular                = $dados->celular;

}
?>
<div class="container-fluid p-0">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
				<h4>CADASTRO</h4>
				<h6 style="color: blue;"><b>Usuário</b></h6>
            </div>
            <div class="card-body">
				<form name="formCadastro" method="post" action="salvar/usuario" data-parsley-validate enctype="multipart/form-data">
					<p>Todos os Campos são Obrigatórios.</p>
					<div class="row">
						<div class="col-12 col-md-1" style="display: none;">
							<label for="id">ID</label>
							<input type="text" name="id" id="id" class="form-control" readonly value="<?=$id;?>">
						</div>
						<div class="col-12 col-md-6">
							<label for="primeiro_nome">Primeiro Nome:</label>
							<input type="text" name="primeiro_nome" id="primeiro_nome" class="form-control" required data-parsley-required-message="Preencha o nome" 
							value="<?=$primeiro_nome;?>" placeholder="Digite seu Primeiro nome">
						</div>
						<div class="col-12 col-md-6">
							<label for="sobrenome">Sobrenome:</label>
							<input type="text" name="sobrenome" id="sobrenome" class="form-control" required data-parsley-required-message="Preencha o nome" 
							value="<?=$sobrenome;?>" placeholder="Digite seu sobrenome completo">
						</div>
						<div class="col-12 col-md-4 mt-2">
							<label for="email">E-mail:</label>
							<input type="email" name="email" id="email" class="form-control" required data-parsley-required-message="Preencha o e-mail"  placeholder="email@exemplo.com.br"
							data-parsley-type-message="Digite um e-mail válido" onblur="confirmarEmail(this.value)" value="<?=$email;?>">
						</div>
						<div class="mb-3 col-12 col-md-4 mt-2">
							<label for="cpf">CPF:</label>
							<input type="text" name="cpf" id="cpf" class="form-control" required data-parsley-required-message="Preencha o cpf" value="<?=$cpf;?>" onblur="verificarCpf(this.value)" placeholder="Digite seu CPF">
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
							<label for="dataNascimento">Data de Nascimento:</label>
							<input type="text" name="dataNascimento" id="dataNascimento" class="form-control" required data-parsley-required-message="Preencha a data de nascimento" 
							placeholder="Ex: 11/12/1990" value="<?=$dataNascimento;?>">
						</div>
						<div class="mb-3 col-12 col-md-4 mt-2">
							<label for="celular">Celular:</label>
							<input type="text" name="celular" id="celular" class="form-control" placeholder="Celular com DDD"
							value="<?=$celular;?>" required data-parsley-required-message="Preencha o Celular">
						</div>
						<div class="col-12 col-md-4 mt-2">
							<label for="login">Login:</label>
							<input type="text" name="login" id="login" class="form-control" required data-parsley-required-message="Preencha o Login" placeholder="Digite o Login de Acesso ao sistema" value="<?=$login;?>">
						</div>
						<div class="col-12 col-md-4 mt-2">
							<label for="senha">Senha:</label>
							<input type="password" name="senha" id="senha" class="form-control" value="<?=$senha?>">
						</div>
						<div class="col-12 col-md-4 mt-2">
							<label for="senha2">Redigite a Senha:</label>
							<input type="password" name="senha2" id="senha2" class="form-control" data-parsley-equalto="#senha" data-parsley-trigger="keyup" data-parsley-error-message="Senha não confere" value="<?=$senha?>">
						</div>
						<div class="col-12 col-md-4 mt-2">
							<label for="foto">Foto (JPG):</label>
							<input type="file" name="foto" id="foto" class="form-control">
							<input type="hidden" name="foto" value="<?=$foto?>" class="form-control" >
								<?php 	
									if( !empty($foto)){
										$foto = "<img src='../fotos/".$foto."p.jpg' alt='".$primeiro_nome."' width='150px'>";
									} else{
										$foto = "";
									}
								?>
								<div><?php echo $foto ;?></div>
						</div>
						<div class="col-12 col-md-4  mt-2">
							<label for="cep">CEP:</label>
							<input type="text" name="cep" id="cep" class="form-control" required data-parsley-required-message="Preencha o CEP"
							value="<?=$cep;?>" placeholder="Código Postal">
						</div>
						<div class="col-12 col-md-2 mt-2" style="display: none;">
							<label for="cidade_id">ID Cidade</label>
							<input type="text" name="cidade_id" id="cidade_id" class="form-control" required data-parsley-required-message="Preencha a Cidade" readonly
							value="<?=$cidade_id;?>">
						</div>
						<div class="col-12 col-md-4 mt-2">
							<label for="cidade">Nome da Cidade:</label>
							<input type="text" id="cidade" name="cidade" class="form-control" value="<?=$cidade;?>" placeholder="ex: São Paulo">
						</div>
						<div class="col-12 col-md-4 mt-2">
							<label for="estado">Estado:</label>
							<input type="text" id="estado" name="estado" class="form-control"  value="<?=$cidade_id;?>" placeholder="UF">
						</div> 	
						<div class="col-12 col-md-4 mt-2">
							<label for="bairro">Bairro:</label>
							<input type="text" id="bairro" name="bairro" class="form-control"  value="<?=$bairro;?>" placeholder="Bairro">
						</div> 
						<div class="col-12 col-md-4 mt-2">
							<label for="endereco">Endereço:</label>
							<input type="text" id="endereco" name="endereco" class="form-control"  value="<?=$cidade_id;?>" placeholder="Endereço">
						</div> 
						<div class="col-12 col-md-4  mt-2">
							<label for="complemento">Complemento:</label>
							<input type="text" id="complemento" name="complemento" class="form-control"  value="<?=$complemento;?>" placeholder="Complemento">
						</div> 
						<div class="col-12 col-md-4 mt-2">
							<label for="numero_resid">Numero de Residencia:</label>
							<input type="text" id="numero_resid" name="numero_resid" class="form-control"  value="<?=$cidade_id;?>" placeholder="Numero Residencia">
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
					</div><br>
					<div class="row g-2">
                        <div class="col-sm-4 mt-4">
							<button type="submit" class="btn btn-success margin">
								Salvar Dados
							</button>
                        </div>
                        <div class="col-sm">
                            <div class="float-end mt-3 ">
                                <a href="listagem/usuario" class="btn btn-primary">Listar Registros</a> 
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
        $("#cep").mask("99999-999"); 
		$('#cpf').mask('000.000.000-00');
		$("#dataNascimento").mask("00/00/0000");
		$("#celular").mask("(00) 00000-0000");     
	});

    function confirmarEmail(email){
        $.get("../admin/validacao/verificaEmail.php", {email:email,id:<?=$id;?>}, function(dados){
            if(dados != ""){
                alert(dados);
                $("#email").val("");
            }
        }) 
    }

	$("#cep").blur(function(){
        cep = $("#cep").val();
        cep = cep.replace(/\D/g, '');
        //alert(cep);
        if(cep == ""){
            alert("Preencha o cep");
        } else{
            //consultar o cep no viacep.com.br
            $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados){
                $("#cidade").val(dados.localidade);
                $("#estado").val(dados.uf);
				$("#bairro").val(dados.bairro);
				$("#endereco").val(dados.logradouro);
                //buscar id da cidade
                $.get("buscarCidade.php", {cidade: dados.localidade, estado: dados.uf}, function(dados){
                    if(dados != "Erro")
                        $("#cidade_id").val(dados);
                    else
                        alert(dados);
                })
                //focar no complemento
                $("#endereco").focus();
            })
        }
    })   
</script>