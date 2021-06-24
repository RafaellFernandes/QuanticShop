<?php
	if (!isset($_SESSION["quanticshop"]["id"])) {
		$titulo = "Erro";
		$mensagem = "Usuário Não Logado";
		$icone = "error";
		mensagem($titulo, $mensagem, $icone);
		exit;
	}

	$id = $_SESSION["quanticshop"]["id"];
	$sql = "SELECT * FROM cliente WHERE id = $id";

	$consulta = $pdo->prepare($sql);
	$consulta->bindParam(":id", $id);
	$consulta->execute();
	$dados = $consulta->fetch(PDO::FETCH_OBJ);

	$primeiro_nome          = $dados->primeiro_nome;
	$sobrenome              = $dados->sobrenome;
	$email                  = $dados->email;
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
	$data_nascimento        = $dados->data_nascimento;
	$genero_id              = $dados->genero_id;
	$cpf                    = $dados->cpf;
	$celular                = $dados->celular;

	$hoje = date_create($data_nascimento); 

?>
<div class="container-fluid p-0 mt-4 mb-5 mr-2 ml-2">
	<h1 class="h3 mb-3 text-center">PERFIL</h1>
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
					<hr class="my-0" />
					<ul class="list-unstyled mb-0 mt-1">
						<li class="mb-1"><h7><span data-feather="home" class="feather-sm me-1"></span><b>Mora em:</b> <?=$cidade;?> - <?=$estado;?></h7></li>
						<li class="mb-1"><h7><span data-feather="mail" class="feather-sm me-1"></span><b>Email:</b> <?=$email;?></h7></li>
						<li class="mb-1"><h7><span data-feather="heart" class="feather-sm me-1"></span><b>Nasceu em:</b> <?=date_format($hoje, 'd/m/Y');?></h7></li>
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
							<div class="col-12 col-sm-6">
								<span>Primeiro Nome</span>
								<input class="form-control" type="text" placeholder="Nome" aria-label="readonly input example" value="<?=$primeiro_nome;?>" readonly>
							</div>
							<div class="col-12 col-sm-6">
								<span>Sobrenome</span>
								<input class="form-control" type="text" placeholder="Sobrenome" aria-label="readonly input example" value="<?=$sobrenome;?>" readonly>
							</div>
							<div class="col-12 col-sm-6 mt-2">
								<span>Email</span>
								<input class="form-control" type="text" placeholder="Email" aria-label="readonly input example" value="<?=$email;?>" readonly>
							</div>
							<div class="col-12 col-sm-3 mt-2">
								<span>CPF</span> 
								<input class="form-control" type="text" placeholder="Cpf" aria-label="readonly input example" value="<?=$cpf;?>" readonly>
							</div>
							<div class="col-12 col-sm-3 mt-2">
								<span>Celular</span>
								<input class="form-control" type="text" placeholder="Celular" aria-label="readonly input example" value="<?=$celular;?>" readonly>
							</div>
							<div class="col-12 col-sm-4 mt-2">
								<span>Data de Nascimento</span>
								<input class="form-control" type="text" placeholder="Data de Nascimento" aria-label="readonly input example" value="<?=date_format($hoje, 'd/m/Y');?>" readonly>
							</div>
							<div class="col-12 col-sm-4 mt-2">
								<span>CEP</span>
								<input class="form-control" type="text" placeholder="CEP" aria-label="readonly input example" value="<?=$cep;?>" readonly>
							</div>
							<div class="col-12 col-sm-4 mt-2">
								<span>Cidade</span>
								<input class="form-control" type="text" placeholder="Cidade" aria-label="readonly input example" value="<?=$cidade;?>" readonly>
							</div>
							<div class="col-12 col-sm-4 mt-2">
								<span>Estado</span>
								<input class="form-control" type="text" placeholder="Estado" aria-label="readonly input example" value="<?=$estado;?>" readonly>
							</div>
							<div class="col-12 col-sm-4 mt-2">
								<span>Endereço</span>
								<input class="form-control" type="text" placeholder="Endereço" aria-label="readonly input example" value="<?=$endereco;?>" readonly>
							</div>
							<div class="col-12 col-sm-4 mt-2 mb-2">
								<span>Bairro</span>
								<input class="form-control" type="text" placeholder="Bairro" aria-label="readonly input example" value="<?=$bairro;?>" readonly>
							</div>
							<div class="col-12 col-sm-4 mt-2 mb-2">
								<span>Complemento</span>
								<input class="form-control" type="text" placeholder="Apartamento, Casa, Andar, Sala, Conjunto, ETC" aria-label="readonly input example" value="<?=$complemento;?>" readonly>
							</div>
							<div class="col-12 col-sm-4 mt-2  mb-2">
								<span>Numero de Residencia</span>
								<input class="form-control" type="text" placeholder="Numero Residencia" aria-label="readonly input example" value="<?=$numero_resid;?>" readonly>
							</div>
							<hr class=" mt-2 my-0" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>