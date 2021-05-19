<?php
    //verificar se não está logado
    if ( !isset ( $_SESSION["quanticshop"]["id"] ) ){
        exit;
    }

	//buscar os usuarios
	$sql = "SELECT * FROM usuario ";
	$consulta = $pdo->prepare($sql);
	$consulta->execute();

	while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
		//separar os dados
		$id                     = $dados->id;
		$primeiro_nome       	= $dados->primeiro_nome;
		$sobrenome              = $dados->sobrenome;
		$email                  = $dados->email;
		$foto                   = $dados->foto;
		$login                  = $dados->login;
		$cidade 	            = $dados->cidade;
		$estado                 = $dados->estado;
		$imagem                 = "../fotos/".$foto."p.jpg";
		$ativo                  = $dados->ativo;
	}
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
						<li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span> Mora em <a href="#"><?=$_SESSION["quanticshop"]["cidade"];?></a></li>
						<li class="mb-1"><span data-feather="map-pin" class="feather-sm me-1"></span> Email <a href="#"><?=$_SESSION["quanticshop"]["email"];?></a></li>
					</ul>
				</div>
				
			</div>
		</div>
		<div class="col-md-8 col-xl-9">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title mb-0">Mais</h5>
				</div>
				<div class="card-body h-100">
					
				</div>
			</div>
		</div>
	</div>
</div>