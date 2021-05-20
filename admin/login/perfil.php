<?php
    //verificar se não está logado
    if ( !isset ( $_SESSION["quanticshop"]["id"] ) ){
        exit;
    }

	$hoje = date_create($_SESSION["quanticshop"]["dataNascimento"]); 

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
					<img src="../fotos/<?=$_SESSION["quanticshop"]["foto"];?>p.jpg" alt="<?=$_SESSION["quanticshop"]["primeiro_nome"];?>" class="img-fluid  mb-2" width="128" height="128" />
					<h4 class="card-title mb-0"><?=$_SESSION["quanticshop"]["primeiro_nome"];?></h4>
					
				</div>
				<hr class="my-0" />
				<div class="card-body">
					<h5 class="h6 card-title">Sobre</h5>
					<ul class="list-unstyled mb-0">
						<li class="mb-1"><h7><span data-feather="home" class="feather-sm me-1"></span>Mora em <?=$_SESSION["quanticshop"]["cidade"];?> - <?=$_SESSION["quanticshop"]["estado"];?></h7></li>
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
								<input class="form-control" type="text" placeholder="<?=$_SESSION["quanticshop"]["primeiro_nome"];?>" aria-label="readonly input example" readonly>
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