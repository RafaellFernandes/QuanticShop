<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["bancotcc"]["id"] ) ){
    exit;
  }

  if ( !isset ( $id ) ) $id = "";

  $Nome = $cnpj = $cep = $endereco =  $Cidade_id = $Telefone = $nome_cidade = $estado = $email = "";

if(!empty($id)){
    //selecionar dados
    $sql = "SELECT f.*, c.cidade, c.estado FROM fornecedor f
            INNER JOIN cidade c ON(c.id = f.cidade_id) 
            WHERE f.id = :id limit 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":id",$id);
    $consulta->execute();
    
    $dados = $consulta->fetch(PDO::FETCH_OBJ);
    
    if(empty($dados->id)){
        echo "<p class='alert alert-danger'> O Fornecedor não existe! </p>";
        exit;
    }
    
    $id          = $dados->id;
    $Nome        = $dados->Nome;
    $cnpj        = $dados->cnpj;
    $endereco    = $dados->endereco;
    $cep         = $dados->cep;
    $Telefone    = $dados->Telefone;
	$Cidade_id   = $dados->Cidade_id;
	$email       = $dados->email;
	$nome_cidade = $dados->cidade;
	$estado   	 = $dados->estado;
   
}
?>
<div class="container-fluid p-0">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h4>Cadastro</h4>
				<h6 class="card-subtitle text-muted">Fornecedor</h6>
			</div>
			<div class="card-body">
				<form name="formCadastro" method="post" action="salvar/fornecedor" data-parsley-validate enctype="multipart/form-data">
					<p> * Campos Obrigatórios </p>
					<div class="row">
						<div class="col-12 col-md-2">
							<label for="id">ID:</label>
							<input type="text" name="id" id="id" class="form-control" readonly value="<?=$id;?>">
						</div>
						<div class="col-12 col-md-10">
							<label for="Nome">* Nome:</label>
							<input type="text" name="Nome" id="Nome" class="form-control" required data-parsley-required-message="Preencha o nome" 
							value="<?=$Nome;?>" placeholder="Digite o nome da transportadora">
						</div>
						<div class="col-12 col-md-4">
							<label for="cnpj">* Cnpj:</label>
							<input type="text" name="cnpj" id="cnpj" class="form-control" required data-parsley-required-message="Preencha o Cnpj" 
							value="<?=$cnpj;?>" onblur="validaCnpj()" placeholder="CNPJ da Empresa">
						</div>
						<div class="col-12 col-md-4">
							<label for="Telefone">* Telefone:</label>
							<input type="text" name="Telefone" id="Telefone" class="form-control" placeholder="Telefone com DDD" required data-parsley-required-message="Preencha o Telefone" 
							value="<?=$Telefone;?>">
						</div>
						<div class="col-12 col-md-4">
							<label for="email">* E-mail:</label>
							<input type="email" name="email" id="email" class="form-control" required data-parsley-required-message="Preencha o e-mail"  placeholder="email@exemplo.com.br"
							onblur="confirmarEmail(this.value)" value="<?=$email;?>">
						</div>
						<div class="col-12 col-md-4">
							<label for="cep">* CEP:</label>
							<input type="text" name="cep" id="cep" class="form-control" required data-parsley-required-message="Preencha o CEP" value="<?=$cep;?>">
						</div>
						<div class="col-12 col-md-2" style="display: none;">
							<label for="Cidade_id">* ID Cidade</label>
							<input type="text" name="Cidade_id" id="Cidade_id" class="form-control" required data-parsley-required-message="Preencha a Cidade" 
							readonly value="<?=$Cidade_id;?>">		
						</div> 
						<div class="col-12 col-md-4">
							<label for="nome_cidade">Nome da Cidade:</label>
							<input type="text" name="nome_cidade" id="nome_cidade" class="form-control" value="<?=$nome_cidade;?>">
						</div>
						<div class="col-12 col-md-2">
							<label for="estado">Estado:</label>
							<input type="text" name="estado" id="estado" class="form-control" value="<?=$estado;?>" readonly>
						</div> 
						<div class="col-12 col-md-4">
							<label for="endereco">Endereço</label>
							<input type="text" name="endereco" id="endereco" class="form-control" value="<?=$endereco;?>">
						</div>
					</div><br>
					<button type="submit" class="btn btn-success margin">
						<!--<i class="fas fa-check"></i>--> Salvar Dados
					</button>
					<div class="float-right">
						<a href="listagem/fornecedor" class="btn btn-primary"><!--<i class="fas fa-bars"></i>-->Listar Registros</a> 
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
		$("#cnpj").mask("00.000.000/0000-00");
		$("#Telefone").mask("(00) 0000-0000");
        $("#cep").mask("00000-000");      
	});

	 function validaCnpj() {
		let cnpj = document.getElementById('cnpj').value;
		cnpj = cnpj.replace('/','').replace('-','').replace('.','').replace('.','');
            $.get("validacao/validaCnpj.php", {cnpj:cnpj, id:<?=$id;?>}, function(dados){
                if(dados != "1"){
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
                $("#endereco").val(dados.logradouro);
                $("#nome_cidade").val(dados.localidade);
                $("#estado").val(dados.uf);
                         
                //buscar id da cidade 
                $.get("buscarCidade.php", {cidade: dados.localidade, estado: dados.uf}, function(dados){
                    if(dados != "Erro")
                        $("#Cidade_id").val(dados);
					else 
                        alert(dados);		 
                })
                //focar no complemento
                $("#endereco").focus();
            })
        }
    })
</script>