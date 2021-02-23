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
  $Nome = $Email = $Login = $Senha = $cidade_id = $Foto = $cep = $nome_cidade = $estado = "";

if(!empty($id)){
    //selecionar dados
    $sql = "SELECT u.id as idusuario ,u.*, c.* FROM usuario u INNER JOIN cidade c ON (c.id = u.cidade_id)
            WHERE u.id = :id limit 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":id",$id);
    $consulta->execute();
    
    $dados = $consulta->fetch(PDO::FETCH_OBJ);
    
    if(empty($dados->id)){
        echo "<p class='alert alert-danger'>Usuario não existe! </p>";
        exit;
    }
    
    $id            = $dados->idusuario;
    $Nome          = $dados->Nome;
    $Email         = $dados->Email;
    $Login         = $dados->Login;
    $Senha         = $dados->Senha;
    $Foto          = $dados->Foto;
	$cidade_id     = $dados->cidade_id;
	$nome_cidade   = $dados->nome_cidade;
	$estado        = $dados->estado;
	$cep           = $dados->cep;
    
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
							<label for="Nome">* Primeiro Nome:</label>
							<input type="text" name="Nome" id="Nome" class="form-control" required data-parsley-required-message="Preencha o nome" 
							value="<?=$Nome;?>" placeholder="Digite seu Primeiro nome">
						</div>
						<div class="col-12 col-md-6">
							<label for="Nome">* Sobrenome:</label>
							<input type="text" name="Nome" id="Nome" class="form-control" required data-parsley-required-message="Preencha o nome" 
							value="<?=$Nome;?>" placeholder="Digite seu sobrenome completo">
						</div>
						<div class="col-12 col-md-4">
							<label for="Email">* E-mail:</label>
							<input type="email" name="Email" id="Email" class="form-control" required data-parsley-required-message="Preencha o e-mail"  placeholder="email@exemplo.com.br"
							data-parsley-type-message="Digite um e-mail válido" onblur="confirmarEmail(this.value)" value="<?=$Email;?>">
						</div>
						<div class="col-12 col-md-4">
							<label for="Login">* Login:</label>
							<input type="text" name="Login" id="Login" class="form-control" required data-parsley-required-message="Preencha o Login" placeholder="Digite o Login de Acesso ao sistema" value="<?=$Login;?>">
						</div>
						<div class="col-12 col-md-4">
							<label for="Senha">* Senha:</label>
							<input type="password" name="Senha" id="Senha" class="form-control" value="<?=$Senha?>">
						</div>
						<div class="col-12 col-md-6">
							<label for="senha2">* Redigite a Senha:</label>
							<input type="password" name="senha2" id="senha2" class="form-control" data-parsley-equalto="#Senha" data-parsley-trigger="keyup" data-parsley-error-message="Senha não confere" value="<?=$Senha?>">
						</div>
						<div class="col-12 col-md-6">
							<label for="Foto">* Foto (JPG):</label>
							<input type="file" name="Foto" id="Foto" class="form-control">
							<input type="hidden" name="Foto" value="<?=$Foto?>" class="form-control" >
								<?php 	
									if( !empty($Foto)){
										$Foto = "<img src='../fotos/".$Foto."p.jpg' alt='".$Nome."' width='150px'>";
									} else{
										$Foto = "";
									}
								?>
								<div><?php echo $Foto ;?></div>
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
							<label for="nome_cidade">Nome da Cidade:</label>
							<input type="text" id="nome_cidade" class="form-control" value="<?=$cidade_id;?>" placeholder="ex: São Paulo">
						</div>
						<div class="col-12 col-md-4">
							<label for="estado">Estado:</label>
							<input type="text" id="estado" class="form-control" readonly value="<?=$cidade_id;?>" placeholder="UF">
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
                $("#nome_cidade").val(dados.localidade);
                $("#estado").val(dados.uf);
                //buscar id da cidade
                $.get("buscarCidade.php", {cidade: dados.localidade, estado: dados.uf}, function(dados){
                    if(dados != "Erro")
                        $("#cidade_id").val(dados);
                    else
                        alert(dados);
                })
                //focar no complemento
                $("#cep").focus();
            })
        }
    })   
</script>