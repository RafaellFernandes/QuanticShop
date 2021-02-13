<?php
  //verificar se não está logado
  if ( !isset ( $pagina ) ){
    exit;
  }

  $msg = NULL;

  //verificar se foi dado um POST
  if ( $_POST ) {
    //iniciar as variaveis
    $Login = $Senha = "";
    //recuperar o login e a senha digitados
    if ( isset ( $_POST["Login"] ) )
      $Login = trim ( $_POST["Login"] );
    
    if ( isset ( $_POST["Senha"] ) )
      $Senha = trim ( $_POST["Senha"] );

    //verificar se os campos estao em branco
    if ( empty ( $Login ) )
      $msg = '<p class="alert alert-danger">Preencha o campo Login</p>';
    else if ( empty ( $Senha ) ) 
      $msg = '<p class="alert alert-danger">Preencha o campo Senha</p>';
    else {
      //verificar se o login existe
      $sql = "SELECT id, Nome, Login, Senha, Foto FROM usuario WHERE Login = ? LIMIT 1";
      //apontar a conexao com o banco
      //preparar o sql para execução
      $consulta = $pdo->prepare($sql);
      //passar o parametro para o sql
      $consulta->bindParam(1, $Login);
      //executar o sql
      $consulta->execute();
      //puxar os dados do resultado
      $dados = $consulta->fetch(PDO::FETCH_OBJ);

      //verificar se existe usuario
      if ( empty ( $dados->id ) ) 
        $msg = '<p class="alert alert-danger">O usuário não existe!</p>';
      //verificar se a senha esta correta
      else if ( !password_verify($Senha, $dados->Senha) )
        $msg = '<p class="alert alert-danger">Senha incorreta</p>';
      //se deu tudo certo
      else {
        //registrar este usuário na sessao
        $_SESSION["bancotcc"] = 
          array("id"  => $dados->id,
                "Nome"=> $dados->Nome,
                "Foto"=> $dados->Foto);
        //redirecionar para o home
        $msg = 'Deu certo!';
        //javascript para redirecionar
        echo '<script>location.href="../admin/paginas/home";</script>';
        exit;

      }

 //mostrar erros
 ini_set('display_errors',1);
 ini_set('display_startup_erros',1);
 error_reporting(E_ALL);
    }
  }
?>
<div class="container d-flex flex-column">
	<div class="row vh-100">
		<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
			<div class="d-table-cell align-middle">
				<div class="text-center mt-4">
					<h1 class="h2">Bem Vindo de Volta</h1>
					<p class="lead">Entre na sua Conta para Continuar</p>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="m-sm-4">
							<div class="text-center">
                <p class="lead">Quantic Shop System</p>
								<img src="img/enter.png" alt="Entre" class="img-fluid " width="70" height="70" />
                <?=$msg;?>
							</div>
							<form class="user" name="login" method="post" data-parsley-validate>
								<div class="mb-3">
									<label class="form-label">Login</label>
									<input class="form-control form-control-lg" id="login" type="text" name="Login" placeholder="Nome de Usuario" 
                  required data-parsley-validate="Preencha o Login"/>
								</div>
								<div class="mb-3">
									<label class="form-label">Senha</label>
									<input class="form-control form-control-lg" type="password" name="Senha" id="senha" placeholder="Digite sua Senha" 
                  required data-parsley-validate="Preencha a Senha" />
									<small>
                    <a href="pages-reset-password.html">Esqueceu a Senha?</a>
                  </small>
								</div>
								<div>
									<label class="form-check" for="lembrar">
                    <input class="form-check-input" type="checkbox" value="lembrar"  id="lembrar" name="lembrar" checked>
                    <span class="form-check-label">
                      Lembrar meu Login
                    </span>
                  </label>
								</div>
								<div class="text-center mt-3">
									<!-- <a href="index.html" class="btn btn-lg btn-primary">Sign in</a> -->
									<button type="submit" class="btn btn-lg btn-primary">Entrar</button> 
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
  </div>
</div>