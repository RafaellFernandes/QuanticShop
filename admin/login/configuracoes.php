<div class="container-fluid p-0">
	<h1 class="h3 mb-3">Configurações</h1>
	<div class="row">
		<div class="col-md-3 col-xl-2">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title mb-0"><strong>Configurações de Perfil</strong></h5>
				</div>
				<div class="list-group list-group-flush" role="tablist">
					<a class="list-group-item list-group-item-action active" data-toggle="list" href="#account" role="tab">
          				Conta
        			</a>
					<a class="list-group-item list-group-item-action" data-toggle="list" href="#password" role="tab">
          				Senha
        			</a>
					<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
          				Privacidade e Segurança
        			</a>
					<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
						Notificações de Email
					</a>
					<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
          				Notificações Web 
        			</a>
					<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
          				Widgets
        			</a>
					<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
          				Your data
        			</a>
					<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
          				Deletar Conta
        			</a>
				</div>
			</div>
		</div>
		<div class="col-md-9 col-xl-10">
			<div class="tab-content">
				<div class="tab-pane fade show active" id="account" role="tabpanel">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0">Informações</h5>
						</div>
						<div class="card-body">
							<form>
								<div class="row">
									<div class="col-md-8">
										<div class="mb-3">
											<label class="form-label" for="inputUsername">Nome de Usuário</label>
											<input type="text" class="form-control" id="inputUsername" placeholder="Nome de Usuário">
										</div>
										<div class="mb-3">
											<label class="form-label" for="inputUsername">Biografia</label>
											<textarea rows="2" class="form-control" id="inputBio" placeholder="Tell something about yourself"></textarea>
										</div>
									</div>
									<div class="col-md-4">
										<div class="text-center">
											<img alt="Charles Hall" src="img/avatars/avatar.jpg" class="rounded-circle img-responsive mt-2" width="128" height="128" />
											<div class="mt-2">
												<span class="btn btn-primary"><i class="fas fa-upload"></i> Upload</span>
											</div>
											<small>For best results, use an image at least 128px by 128px in .jpg format</small>
										</div>
									</div>
								</div>
								<button type="submit" class="btn btn-primary">Salvar Mudanças</button>
							</form>
						</div>
					</div>
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0">Informações Privadas</h5>
						</div>
						<div class="card-body">
							<form>
								<div class="row">
									<div class="mb-3 col-md-6">
										<label class="form-label" for="inputFirstName">Primeiro Nome</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder="First name">
									</div>
									<div class="mb-3 col-md-6">
										<label class="form-label" for="inputLastName">Sobrenome</label>
										<input type="text" class="form-control" id="inputLastName" placeholder="Last name">
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
										<label class="form-label" for="inputZip">Cep</label>
										<input type="text" class="form-control" id="inputZip">
									</div>
								</div>
								<button type="submit" class="btn btn-primary">Salvar Mudanças</button>
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
									<label class="form-label" for="inputPasswordCurrent">Current password</label>
									<input type="password" class="form-control" id="inputPasswordCurrent">
									<small><a href="#">Esqueceu Sua Senha?</a></small>
								</div>
								<div class="mb-3">
									<label class="form-label" for="inputPasswordNew">Nova Senha</label>
									<input type="password" class="form-control" id="inputPasswordNew">
								</div>
								<div class="mb-3">
									<label class="form-label" for="inputPasswordNew2">Repita a Nova Senha</label>
									<input type="password" class="form-control" id="inputPasswordNew2">
								</div>
								<button type="submit" class="btn btn-primary">Salvar Mudanças</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>