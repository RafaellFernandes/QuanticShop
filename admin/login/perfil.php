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


	$hoje = date_create($_SESSION["quanticshop"]["dataNascimento"]); 
	$id = $_SESSION["quanticshop"]["id"];
	$sql = "SELECT * FROM usuario WHERE id = $id";
	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(":id", $id);
	$consulta->execute();
	$dados = $consulta->fetch(PDO::FETCH_OBJ);

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





?>
<div class="container-fluid p-0">
	<h1 class="h3 mb-3">PERFIL</h1>
	<div class="row">
		<div class="col-md-4 col-xl-3">
			<div class="card mb-3">
				<div class="card-header">
					<h5 class="card-title mb-0">Detalhes do Perfil</h5>
				</div>
				<div class="card-body text-center">
					<img src="../fotos/<?=$foto;?>p.jpg" alt="<?=$primeiro_nome;?>" class="img-fluid  mb-2" width="128" height="128" />
					<h4 class="card-title mb-0"><?=$primeiro_nome ." ". $sobrenome;?></h4>
					
				</div>
				<hr class="my-0" />
				<div class="card-body">
					<h5 class="h6 card-title">Sobre</h5>
					<ul class="list-unstyled mb-0">
						<li class="mb-1"><h7><span data-feather="home" class="feather-sm me-1"></span>Mora em <?=$cidade;?> - <?=$_SESSION["quanticshop"]["estado"];?></h7></li>
						<li class="mb-1"><h7><span data-feather="mail" class="feather-sm me-1"></span>Email <?=$_SESSION["quanticshop"]["email"];?></h7></li>
						<li class="mb-1"><h7><span data-feather="heart" class="feather-sm me-1"></span>Nasceu em <?=date_format($hoje, 'd/m/Y');?></h7></li>
					</ul>
				</div>
				
			</div>
		</div>
		<div class="col-md-8 col-xl-9">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title mb-0">Suas Informações</h5>
				</div>
				<div class="card-body h-100">
					<div class="container">
						<div class="row">

							<div class="col-12 col-sm-2">
								<span>ID</span>
								<input class="form-control" type="text" placeholder="<?=$_SESSION["quanticshop"]["id"];?>" aria-label="readonly input example" readonly>
							</div>

							<div class="col-12 col-sm-5">
								<span>Primeiro Nome</span>
								<input class="form-control" type="text" placeholder="nome" aria-label="readonly input example" value="<?=$primeiro_nome;?>" >
							</div>

							<div class="col-12 col-sm-5">
								<span>Sobrenome</span>
								<input class="form-control" type="text" placeholder="<?=$_SESSION["quanticshop"]["sobrenome"];?>" aria-label="readonly input example" readonly>
							</div>

							<div class="col-12 col-sm-4 mt-2">
								<span>Email</span>
								<input class="form-control" type="text" placeholder="<?=$_SESSION["quanticshop"]["email"];?>" aria-label="readonly input example" readonly>
							</div>

							<div class="col-12 col-sm-4 mt-2">
								<span>Login</span>
								<input class="form-control" type="text" placeholder="<?=$_SESSION["quanticshop"]["login"];?>" aria-label="readonly input example" readonly>
							</div>

							<div class="col-12 col-sm-4 mt-2">
								<span>Nivel de Acesso</span>
								<input class="form-control" type="text" placeholder="<?=$_SESSION["quanticshop"]["nivelAcesso"];?>" aria-label="readonly input example" readonly>
							</div>

							<div class="col-12 col-sm-4 mt-2">
								<span>Ativo</span>
								<input class="form-control" type="text" placeholder="<?=$_SESSION["quanticshop"]["ativo"];?>" aria-label="readonly input example" readonly>
							</div>

							<div class="col-12 col-sm-4 mt-2">
								<span>CPF</span>
								<input class="form-control" type="text" placeholder="<?=$_SESSION["quanticshop"]["cpf"];?>" aria-label="readonly input example" readonly>
							</div>

							<div class="col-12 col-sm-4 mt-2">
								<span>Celular</span>
								<input class="form-control" type="text" placeholder="<?=$_SESSION["quanticshop"]["celular"];?>" aria-label="readonly input example" readonly>
							</div>

							<div class="col-12 col-sm-4 mt-2">
								<span>Data de Nascimento</span>
								<input class="form-control" type="text" placeholder="<?=date_format($hoje, 'd/m/Y');?>" aria-label="readonly input example" readonly>
							</div>

							<div class="col-12 col-sm-4 mt-2">
								<span>Cidade ID</span>
								<input class="form-control" type="number" placeholder=" <?=$_SESSION["quanticshop"]["cidade_id"];?>" aria-label="readonly input example" readonly>
							</div>

							<div class="col-12 col-sm-4 mt-2">
								<span>CEP</span>
								<input class="form-control" type="text" placeholder="<?=$_SESSION["quanticshop"]["cep"];?>" aria-label="readonly input example" readonly>
							</div>

							<div class="col-12 col-sm-4 mt-2">
								<span>Cidade</span>
								<input class="form-control" type="text" placeholder="<?=$_SESSION["quanticshop"]["cidade"];?>" aria-label="readonly input example" readonly>
							</div>

							<div class="col-12 col-sm-4 mt-2">
								<span>Estado</span>
								<input class="form-control" type="text" placeholder="<?=$_SESSION["quanticshop"]["estado"];?>" aria-label="readonly input example" readonly>
							</div>

							<div class="col-12 col-sm-4 mt-2">
								<span>Endereço</span>
								<input class="form-control" type="text" placeholder="<?=$_SESSION["quanticshop"]["endereco"];?>" aria-label="readonly input example" readonly>
							</div>

							<div class="col-12 col-sm-4 mt-2 mb-2">
								<span>Bairro</span>
								<input class="form-control" type="text" placeholder="<?=$_SESSION["quanticshop"]["bairro"];?>" aria-label="readonly input example" readonly>
							</div>

							<div class="col-12 col-sm-4 mt-2 mb-2">
								<span>Complemento</span>
								<input class="form-control" type="text" placeholder="<?=$_SESSION["quanticshop"]["complemento"];?>" aria-label="readonly input example" readonly>
							</div>

							<div class="col-12 col-sm-4 mt-2  mb-2">
								<span>Numero de Residencia</span>
								<input class="form-control" type="text" placeholder="<?=$_SESSION["quanticshop"]["numero_resid"];?>" aria-label="readonly input example" readonly>
							</div>
							<hr class=" mt-2 my-0" />
						</div>
					</div>
					<a class="btn btn-primary mt-2 float-end" href="login/configuracoes" alt="Editar" title="Editar" role="button">Editar dados</a>
				</div>
			</div>
		</div>
	</div>
</div>