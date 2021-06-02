<?php
if (!isset($_SESSION["quanticshop"]["id"])) {
	$titulo = "Erro";
	$mensagem = "Usuário Não Logado";
	$icone = "error";
	mensagem($titulo, $mensagem, $icone);
exit;
}

if ($_SESSION["quanticshop"]["nivelAcesso"] != "admin") {
$titulo = "Erro";
$mensagem = "Erro na Requisição da Página";
$icone = "error";
mensagem($titulo, $mensagem, $icone);
exit;
}

  include "validacao/functions.php";

  if ( !isset ( $id ) ) $id = "";

  $nomeFantasia = $razaoSocial = $cnpj = $cep = $endereco = $cidade_id = $telefone = $cidade = $estado = $email = $inscricaoEstadual = 
  $celular = $bairro = $numero_resid = $ativo = $complemento = $siteFornecedor = "";

if(!empty($id)){
    //selecionar dados
    $sql = "SELECT f.*, c.cidade, c.estado FROM fornecedor f
            INNER JOIN cidade c ON(c.id = f.cidade_id) 
            WHERE f.id = :id limit 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":id",$id);
    $consulta->execute();
    
    $dados = $consulta->fetch(PDO::FETCH_OBJ);
    
    $id                  = $dados->id;
    $nomeFantasia        = $dados->nomeFantasia;
	$razaoSocial         = $dados->razaoSocial;
    $cnpj                = $dados->cnpj;
	$endereco            = $dados->endereco;
    $inscricaoEstadual   = $dados->inscricaoEstadual;
    $cep                 = $dados->cep;
    $telefone            = $dados->telefone;
	$celular             = $dados->celular;
	$cidade_id           = $dados->cidade_id;
	$email               = $dados->email;
	$cidade              = $dados->cidade;
	$estado         	 = $dados->estado;
	$bairro         	 = $dados->bairro;
	$numero_resid        = $dados->numero_resid;
	$ativo           	 = $dados->ativo;
	$complemento         = $dados->complemento;
	$siteFornecedor      = $dados->siteFornecedor;
   
	if(empty($dados->id)){
		$titulo = "Erro";
		$mensagem = "Fornecedor Não Existente";
		$icone = "error";
		mensagem($titulo, $mensagem, $icone);
        exit;
    }
}
?>
<div class="container-fluid p-0">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
			<h4>CADASTRO</h4>
				<h6 style="color: blue;"><b>Forcedor</b></h6>
			</div>
			<div class="card-body">
				<form name="formCadastro" method="post" action="salvar/fornecedor" data-parsley-validate enctype="multipart/form-data">
					<p> Todos os Campos São Obrigatórios. </p>
					<div class="row">
						<div class="col-12 col-md-2" style="display: none;">
							<label for="id">ID:</label>
							<input type="text" name="id" id="id" class="form-control" readonly value="<?=$id;?>">
						</div>
						<div class="col-12 col-md-2">
							<label for="ativo">Ativo</label>
							<select name="ativo" id="ativo" class="form-control" 
								required data-parsley-required-message="Selecione uma opção">
								<option value="">...</option>
								<option value="1" <?= $ativo == '1' ? "selected" : "" ?>>Ativo</option>
								<option value="0"  <?= $ativo == '0' ? "selected" : "" ?>>Inativo</option>
							</select>
                        </div>
						<div class="col-12 col-md-10">
							<label for="razaoSocial">Razão Social:</label>
							<input type="text" name="razaoSocial" id="razaoSocial" class="form-control" required data-parsley-required-message="Preencha o nome" 
							value="<?=$razaoSocial;?>" placeholder="Digite a Razão Social">
						</div>
						<div class="col-12 col-md-12 mt-2">
							<label for="nomeFantasia">Nome Fantasia:</label>
							<input type="text" name="nomeFantasia" id="nomeFantasia" class="form-control" required data-parsley-required-message="Preencha o nome" 
							value="<?=$nomeFantasia;?>" placeholder="Digite o Nome Fantasia da Transportadora">
						</div>
						<div class="col-12 col-md-4 mt-2">
							<label for="cnpj">CNPJ:</label>
							<input type="text" name="cnpj" id="cnpj" class="form-control" required data-parsley-required-message="Preencha o CNPJ" 
							value="<?=$cnpj;?>"  placeholder="CNPJ da Empresa">
						</div>
						<div class="col-12 col-md-4 mt-2">
							<label for="inscricaoEstadual">Inscrição Estadual:</label>
							<input type="text" name="inscricaoEstadual" id="inscricaoEstadual" class="form-control" required data-parsley-required-message="Preencha o Numero de Inscrição Estadual" 
							value="<?=$inscricaoEstadual;?>" placeholder="Número de Inscrição Estadual">
						</div>
						<div class="col-12 col-md-4 mt-2">
							<label for="telefone">Telefone:</label>
							<input type="text" name="telefone" id="telefone" class="form-control" placeholder="Telefone com DDD" required data-parsley-required-message="Preencha o Telefone" 
							value="<?=$telefone;?>">
						</div>
						<div class="col-12 col-md-4 mt-2">
							<label for="celular">Celular:</label>
							<input type="text" name="celular" id="celular" class="form-control" placeholder="Celular com DDD" required data-parsley-required-message="Preencha o Celular" 
							value="<?=$celular;?>">
						</div>
						<div class="col-12 col-md-4 mt-2">
							<label for="email">E-mail:</label>
							<input type="email" name="email" id="email" class="form-control" required data-parsley-required-message="Preencha o E-mail"  placeholder="email@exemplo.com.br"
							onblur="confirmarEmail(this.value)" value="<?=$email;?>">
						</div>
						<div class="mb-3 col-12 col-md-4 mt-2">
							<label for="siteFornecedor">Site:</label>
							<input type="text" name="siteFornecedor" id="siteFornecedor" class="form-control" required data-parsley-required-message="Preencha o site" 
							 placeholder="www.exemplo.com" value="<?=$siteFornecedor;?>">
						</div>
						<div class="col-12 col-md-4 mt-2">
							<label for="cep">CEP:</label>
							<input type="text" name="cep" id="cep" class="form-control" required data-parsley-required-message="Preencha o CEP" 
							value="<?=$cep;?>" placeholder="Digite o CEP">
						</div>
						<div class="col-12 col-md-2 mt-2" style="display: none;">
							<label for="cidade_id">ID Cidade</label>
							<input type="text" name="cidade_id" id="cidade_id" class="form-control" required data-parsley-required-message="Preencha a Cidade" 
							readonly value="<?=$cidade_id;?>">		
						</div> 
						<div class="col-12 col-md-4 mt-2">
							<label for="cidade">Cidade:</label>
							<input type="text" name="cidade" id="cidade" class="form-control" value="<?=$cidade;?>" placeholder="Nome da Cidade">
						</div>
						<div class="col-12 col-md-2 mt-2">
							<label for="estado">Estado:</label>
							<input type="text" name="estado" id="estado" class="form-control" value="<?=$estado;?>" placeholder="UF">
						</div> 
						<div class="col-12 col-md-6 mt-2">
							<label for="endereco">Endereço</label>
							<input type="text" name="endereco" id="endereco" class="form-control" value="<?=$endereco;?>" placeholder="Avenida, Rua ...">
						</div>
						<div class="mb-3 col-12 col-md-6 mt-2">
							<label for="bairro">Bairro:</label>
							<input type="text" name="bairro" id="bairro" class="form-control" value="<?=$bairro;?>" placeholder="Nome do Bairro">
						</div>
						 <div class="mb-3 col-12 col-md-3 mt-2">
							<label for="complemento">Complemento</label>
							<input type="text" name="complemento" id="complemento" class="form-control" value="<?=$complemento;?>" placeholder="Complemento">
						</div>
						<div class="mb-3 col-12 col-md-6 mt-2">
							<label for="numero_resid">Numero:</label>
							<input type="text" name="numero_resid" id="numero_resid" class="form-control" value="<?=$numero_resid;?>" placeholder="Número">
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
                                <a href="listagem/fornecedor" class="btn btn-primary">Listar Registros</a> 
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
		$("#cnpj").mask("00.000.000/0000-00");
		$("#telefone").mask("(00) 0000-0000");
		$("#celular").mask("(00) 00000-0000");
        $("#cep").mask("00000-000");      
	});

	//  function validaCnpj() {
	// 	let cnpj = document.getElementById('cnpj').value;
	// 	cnpj = cnpj.replace('/','').replace('-','').replace('.','').replace('.','');
    //         $.get("validacao/validaCnpj.php", {cnpj:cnpj, id:<?//=$id;?>}, function(dados){
    //             if(dados != "1"){
    //                 //mostrar erro retornado
    //                 alert(dados);
    //                 //zerar Cnpj
    //                 $("#cnpj").val("");
    //             }
	// 		})
		
    //       }
                 
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
                $("#cidade").val(dados.localidade);
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
                $("#endereco").focus();
            })
        }
    })
</script>