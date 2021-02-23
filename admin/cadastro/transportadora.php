<?php
  	//verificar se não está logado
  	if ( !isset ( $_SESSION["quanticshop"]["id"] ) ){
    	exit;
 	}

  	//iniciar as variaveis
  	$Nome = $cnpj = $cep = $Endereco = $cidade_id = $Telefone = $nome_cidade = $estado = $email = "";
  
 	//se nao existe o id
 	if ( !isset ( $id ) ) $id = "";
  
	//verificar se existe um id
	if( !empty ( $id ) ) {
    //selecionar dados do banco
    $sql = "SELECT t.id as idtransportadora
					,t.*
					,c.* 
			FROM transportadora t 
            INNER JOIN cidade c ON(c.id = t.cidade_id) 
            WHERE t.id = :id limit 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":id", $id);
    $consulta->execute();
    $dados = $consulta->fetch(PDO::FETCH_OBJ);
	
	// separar os dados
    $id          = $dados->idtransportadora;
    $Nome        = $dados->Nome;
    $cnpj        = $dados->cnpj;
    $Endereco    = $dados->Endereco;
    $cep         = $dados->cep;
    $Telefone    = $dados->Telefone;
	$cidade_id   = $dados->cidade_id;
	$estado      = $dados->estado;
	$email       = $dados->email;
	$nome_cidade = $dados->nome_cidade;

	if( empty ( $dados->id ) ) {
	    echo "<p class='alert alert-danger'> A Transportadora não existe! </p>";
        exit;
    }
}
?>
<div class="container-fluid p-0">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Cadastro</h4>
                <h6 class="card-subtitle text-muted">Transportadora</h6>
            </div>
            <div class="card-body">
				<form name="formCadastro" method="post" action="salvar/transportadora" data-parsley-validate enctype="multipart/form-data">
					<p>* Campos Obrigatórios</p>
					<div class="row">
						<div class="col-12 col-md-2" style="display: none;">
							<label for="id">ID:</label>
							<input type="text" name="id" id="id" class="form-control" readonly value="<?=$id;?>">
						</div>
						<div class="col-12 col-md-12">
							<label for="Nome">* Nome:</label>
							<input type="text" name="Nome" id="Nome" class="form-control" required data-parsley-required-message="Preencha o nome" value="<?=$Nome;?>" placeholder="Digite o nome da transportadora">
						</div>
						<div class="col-12 col-md-4">
							<label for="cnpj">* Cnpj:</label>
							<input type="text" name="cnpj" id="cnpj" class="form-control" required data-parsley-required-message="Preencha o Cnpj" value="<?=$cnpj;?>" onblur="validaCnpj()" placeholder="CNPJ da Empresa">
						</div>
						<div class="col-12 col-md-4">
							<label for="Telefone">* Telefone:</label>
							<input type="text" name="Telefone" id="Telefone" class="form-control" placeholder="Com DDD e sem espaços" value="<?=$Telefone;?>">
						</div>
						<div class="col-12 col-md-4">
							<label for="email">E-mail:</label>
							<input type="email" name="email" id="email" class="form-control"  placeholder="email@exemplo.com.br" data-parsley-type-message="Digite um e-mail válido" onblur="confirmarEmail(this.value)"
							value="<?=$email;?>">
						</div>
						<div class="col-12 col-md-4">
							<label for="cep">* CEP:</label>
							<input type="text" name="cep" id="cep" class="form-control" required data-parsley-required-message="Preencha o CEP" value="<?=$cep;?>" placeholder="12345-678">
						</div>
						<div class="col-12 col-md-2"  style="display: none;">
							<label for="cidade_id">ID Cidade</label>
							<input type="text" name="cidade_id" id="cidade_id" class="form-control" required data-parsley-required-message="Preencha a Cidade" readonly value="<?=$cidade_id;?>">
						</div>
						<div class="col-12 col-md-5">
							<label for="nome_cidade">* Nome da Cidade:</label>
							<input type="text" name="nome_cidade" id="nome_cidade" class="form-control" value="<?=$nome_cidade;?>" placeholder="Cidade" >
						</div>
						<div class="col-12 col-md-3">
							<label for="estado">* Estado:</label>
							<input type="text" name="estado" id="estado" class="form-control" value="<?=$estado;?>" placeholder="UF" readonly>
						</div>
						<div class="col-12 col-md-12">
							<label for="Endereco">* Endereço</label>
							<input type="text" name="Endereco" id="Endereco" class="form-control" value="<?=$Endereco;?>" placeholder="Av.Paraná, 2801">
						</div>
					</div><br>
					<button type="submit" class="btn btn-success margin">
						<!--<i class="fas fa-check"></i>--> Salvar Dados
					</button>
					<div class="float-right">
						<a href="listagem/transportadora" class="btn btn-primary">Listar Registros</a>
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
			$("#cnpj").mask("99.999.999/9999-99");
			$("#Telefone").mask("(99) 9999-9999");
            $("#cep").mask("99999-999");      
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
               $.get("validacao/verificaEmailTransp.php", {email:email,id:<?=$id;?>}, function(dados){
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
                         $("#Endereco").val(dados.logradouro);
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
                         $("#Endereco").focus();
                     })
                }
            })
        
	</script>