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
?>
<div class="container-fluid p-0">
	<h1 class="h3 mb-3">Configurações</h1>
	<div class="row">
		<div class="col-md-3 col-xl-2">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title mb-0">Configurações de Perfil</h5>
				</div>
				<div class="list-group list-group-flush" role="tablist">
					<a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#account" role="tab">
      					Conta
    				</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#password" role="tab">
      					Senha
    				</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#privacy" role="tab">
      					Privacidade e Segurança
    				</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#" role="tab">
      					Notificações de Email 
    				</a>		
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="perfil" role="tab">
      					Seus Dados
    				</a>
				</div>
			</div>
		</div>
		<div class="col-md-9 col-xl-10">
			<div class="tab-content">
				<div class="tab-pane fade show active" id="account" role="tabpanel">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0">Informação Pública</h5>
						</div>
						<div class="card-body">
							<form>
								<div class="row">
									<div class="col-md-8">
										<div class="mb-3">
											<label class="form-label" for="inputUsername">Login</label>
											<input type="text" class="form-control" id="inputUsername" placeholder="Login" value="<?=$_SESSION["quanticshop"]["login"];?>">
										</div>
										<div class="mb-3">
											<label class="form-label" for="inputUsername">Email</label>
											<input type="text" class="form-control" id="inputUsername" placeholder="Login" value="<?=$_SESSION["quanticshop"]["email"];?>">
										</div>
									</div>
									<div class="col-md-4">
										<div class="text-center">
											<img alt="<?=$_SESSION["quanticshop"]["primeiro_nome"];?>" src="../fotos/<?=$_SESSION["quanticshop"]["foto"];?>p.jpg" class="rounded-circle img-responsive mt-2" width="128" height="128" />
											<div class="mt-2">
												<span class="btn btn-primary">Upload</span>
											</div>
											<small>Para obter melhores resultados, use uma imagem de pelo menos 128 x 128 pixels no formato .jpg</small>
										</div>
									</div>
								</div>
								<button type="submit" class="btn btn-primary">Salvar Informações</button>
							</form>
						</div>
					</div>
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0">Informação Privada</h5>
						</div>
						<div class="card-body">
							<form>
								<div class="row">
									<div class="mb-3 col-md-6">
										<label class="form-label" for="inputFirstName">Primeiro Nome</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder="Primeiro Nome">
									</div>
									<div class="mb-3 col-md-6">
										<label class="form-label" for="inputLastName">Sobrenome</label>
										<input type="text" class="form-control" id="inputLastName" placeholder="Sobrenome">
									</div>
								</div>
								<div class="mb-3">
									<label class="form-label" for="inputEmail4">Email</label>
									<input type="email" class="form-control" id="inputEmail4" placeholder="Email">
								</div>
								<div class="mb-3">
									<label class="form-label" for="inputAddress">Endereço</label>
									<input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
								</div>
								<div class="mb-3">
									<label class="form-label" for="inputAddress2">Bairro</label>
									<input type="text" class="form-control" id="inputAddress2" placeholder="Apartamento, Andar, Sala, Conjunto, ETC">
								</div>
								<div class="row">
									<div class="mb-3 col-md-6">
										<label class="form-label" for="inputCity">Cidade</label>
										<input type="text" class="form-control" id="inputCity">
									</div>
									<div class="mb-3 col-md-4">
										<label class="form-label" for="inputState">Estado</label>
										<select id="inputState" class="form-control">
											<option selected>Choose...</option>
											<option>...</option>
										</select>
									</div>
									<div class="mb-3 col-md-2">
										<label class="form-label" for="inputZip">CEP</label>
										<input type="text" class="form-control" id="inputZip">
									</div>
								</div>
								<button type="submit" class="btn btn-primary">Salvar Alterações</button>
							</form>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="password" role="tabpanel">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title">Senha</h5>
							<form>
								<div class="mb-3">
									<label class="form-label" for="inputPasswordCurrent">Senha Atual</label>
									<input type="password" class="form-control" id="inputPasswordCurrent">
									<small><a href="#">Forgot your password?</a></small>
								</div>
								<div class="mb-3">
									<label class="form-label" for="inputPasswordNew">Nova Senha</label>
									<input type="password" class="form-control" id="inputPasswordNew">
								</div>
								<div class="mb-3">
									<label class="form-label" for="inputPasswordNew2">Verifique a Senha</label>
									<input type="password" class="form-control" id="inputPasswordNew2">
								</div>
								<button type="submit" class="btn btn-primary">Salvar a Senha</button>
							</form>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="privacy" role="tabpanel">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title">Termos</h5>
							<form>
								<div class="mb-3 mt-3">
									<a href="paginas/politicaDevolucao">Politica de Devolução</a>
								</div>
								<div class="mb-3">
									<a href="paginas/politicaPrivacidade">Politica de Privacidade</a>
								</div>
								<div class="mb-3">
									<a href="paginas/termosCondicoes">Termos e Condições</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>