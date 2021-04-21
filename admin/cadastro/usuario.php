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

  $primeiro_nome = $sobrenome = $email = $login = $senha = $cidade_id = $foto = $cep = $cidade = $estado = $bairro = $complemento = $numero_resid = $endereco = "";

if(!empty($id)){
    //selecionar dados
    $sql = "SELECT u.id as idusuario, u.*, c.* FROM usuario u INNER JOIN cidade c ON (c.id = u.cidade_id)
            WHERE u.id = :id limit 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":id",$id);
    $consulta->execute();
    
    $dados = $consulta->fetch(PDO::FETCH_OBJ);
    
    if(empty($dados->id)){
        echo "<p class='alert alert-danger'>Usuario não existe! </p>";
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

    
}
?>
<div class="container-fluid p-0">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Cadastro</h4>
                <h6 class="card-subtitle text-muted">Usuario</h6>
            </div>
            <div class="card-body">
				<form name="formCadastro" method="post" action="salvar/usuario" data-parsley-validate enctype="multipart/form-data">
					<p>* Campos Obrigatórios</p>
					<div class="row">
						<div class="col-12 col-md-1" style="display: none;">
							<label for="id">ID</label>
							<input type="text" name="id" id="id" class="form-control" readonly value="<?=$id;?>">
						</div>
						<div class="col-12 col-md-6">
							<label for="primeiro_nome">* Primeiro Nome:</label>
							<input type="text" name="primeiro_nome" id="primeiro_nome" class="form-control" required data-parsley-required-message="Preencha o nome" 
							value="<?=$primeiro_nome;?>" placeholder="Digite seu Primeiro nome">
						</div>
						<div class="col-12 col-md-6">
							<label for="sobrenome">* Sobrenome:</label>
							<input type="text" name="sobrenome" id="sobrenome" class="form-control" required data-parsley-required-message="Preencha o nome" 
							value="<?=$sobrenome;?>" placeholder="Digite seu sobrenome completo">
						</div>
						<div class="col-12 col-md-4">
							<label for="email">* E-mail:</label>
							<input type="email" name="email" id="email" class="form-control" required data-parsley-required-message="Preencha o e-mail"  placeholder="email@exemplo.com.br"
							data-parsley-type-message="Digite um e-mail válido" onblur="confirmarEmail(this.value)" value="<?=$email;?>">
						</div>
						<div class="col-12 col-md-4">
							<label for="login">* Login:</label>
							<input type="text" name="login" id="login" class="form-control" required data-parsley-required-message="Preencha o Login" placeholder="Digite o Login de Acesso ao sistema" value="<?=$login;?>">
						</div>
						<div class="col-12 col-md-4">
							<label for="senha">* Senha:</label>
							<input type="password" name="senha" id="senha" class="form-control" value="<?=$senha?>">
						</div>
						<div class="col-12 col-md-6">
							<label for="senha2">* Redigite a Senha:</label>
							<input type="password" name="senha2" id="senha2" class="form-control" data-parsley-equalto="#senha" data-parsley-trigger="keyup" data-parsley-error-message="Senha não confere" value="<?=$senha?>">
						</div>
						<div class="col-12 col-md-6">
							<label for="foto">* Foto (JPG):</label>
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
						<div class="col-12 col-md-4">
							<label for="cep">* CEP:</label>
							<input type="text" name="cep" id="cep" class="form-control" required data-parsley-required-message="Preencha o CEP"
							value="<?=$cep;?>" placeholder="Código Postal">
						</div>
						<div class="col-12 col-md-2" style="display: none;">
							<label for="cidade_id">ID Cidade</label>
							<input type="text" name="cidade_id" id="cidade_id" class="form-control" required data-parsley-required-message="Preencha a Cidade" readonly
							value="<?=$cidade_id;?>">
						</div>
						<div class="col-12 col-md-4">
							<label for="cidade">Nome da Cidade:</label>
							<input type="text" id="cidade" name="cidade" class="form-control" value="<?=$cidade;?>" placeholder="ex: São Paulo">
						</div>
						<div class="col-12 col-md-4">
							<label for="estado">Estado:</label>
							<input type="text" id="estado" name="estado" class="form-control"  value="<?=$cidade_id;?>" placeholder="UF">
						</div> 	
						<div class="col-12 col-md-4">
							<label for="bairro">Bairro:</label>
							<input type="text" id="bairro" name="bairro" class="form-control"  value="<?=$bairro;?>" placeholder="Bairro">
						</div> 
						<div class="col-12 col-md-4">
							<label for="endereco">Endereço:</label>
							<input type="text" id="endereco" name="endereco" class="form-control"  value="<?=$cidade_id;?>" placeholder="Endereço">
						</div> 
						<div class="col-12 col-md-4">
							<label for="complemento">Complemento:</label>
							<input type="text" id="complemento" name="complemento" class="form-control"  value="<?=$complemento;?>" placeholder="Complemento">
						</div> 
						<div class="col-12 col-md-4">
							<label for="numero_resid">Numero de Residencia:</label>
							<input type="text" id="numero_resid" name="numero_resid" class="form-control"  value="<?=$cidade_id;?>" placeholder="Numero Residencia">
						</div> 
					</div><br>
					<button type="submit" class="btn btn-success margin">
						<!--<i class="fas fa-check"></i>--> Salvar Dados
					</button>
					<div class="float-right">
                        <a href="listagem/usuario" class="btn btn-primary"><!--<i class="fas fa-bars"></i>-->Listar Registros</a> 
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