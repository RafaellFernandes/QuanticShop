<?php
  //verificar se não está logado
  if ( !isset ( $pagina ) ){
    exit;
  }

  $msg = NULL;

  //verificar se foi dado um POST
  if ( $_POST ) {
    //iniciar as variaveis
    $email = $senha = "";
    //recuperar o email e a senha digitados
    if ( isset ( $_POST["email"] ) )
      $email = trim ( $_POST["email"] );
    
    if ( isset ( $_POST["senha"] ) )
      $senha = trim ( $_POST["senha"] );

    //verificar se os campos estao em branco
    if ( empty ( $email ) )
      $msg = '<p class="alert alert-danger">Preencha o campo email</p>';
    else if ( empty ( $senha ) ) 
      $msg = '<p class="alert alert-danger">Preencha o campo senha</p>';
    else {
      //verificar se o email existe
      $sql = "SELECT id, primeiro_nome, sobrenome, nomeFantasia, email, senha, foto, cpf, cnpj FROM cliente WHERE email = ? LIMIT 1";
      //apontar a conexao com o banco
      //preparar o sql para execução
      $consulta = $pdo->prepare($sql);
      //passar o parametro para o sql
      $consulta->bindParam(1, $email);
      //executar o sql
      $consulta->execute();
      //puxar os dados do resultado
      $dados = $consulta->fetch(PDO::FETCH_OBJ);

      //verificar se existe usuario
      if ( empty ( $dados->id ) ) 
        $msg = '<p class="alert alert-danger">O usuário não existe!</p>';
      //verificar se a senha esta correta
      else if ( !password_verify($senha, $dados->senha) )
        $msg = '<p class="alert alert-danger">senha incorreta</p>';
      //se deu tudo certo
      else {
        //registrar este usuário na sessao
        $_SESSION["quanticshop"] = 
          array("id"  => $dados->id,
                "primeiro_nome"=> $dados->primeiro_nome,
                "sobrenome"=> $dados->sobrenome,
                "nomeFantasia"=> $dados->nomeFantasia,
                "email"=> $dados->email,
                "foto"=> $dados->foto,
                "cpf"=> $dados->cpf,
                "cnpj"=> $dados->cnpj);
        //redirecionar para o home
        $msg = 'Deu certo!';
        //javascript para redirecionar
        echo '<script>location.href="home";</script>';
        exit;
      }
      //mostrar erros
      ini_set('display_errors',1);
      ini_set('display_startup_erros',1);
      error_reporting(E_ALL);
    }
  }
?>
<div class="main">
  <div class="shop_top">
		<div class="container">
			<div class="col-md-6">
				<div class="login-page">
					<h4 class="title">Cadastre-se</h4>
          <p>Não possui uma conta? cadastre-se ja!</p>
          <br><br><br><br><br>
					<div class="button1 mt-4">
					  <a href="register"><input type="submit" name="Submit" value="Criar uma Conta"></a>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="login-title">
	        <h4 class="title">Entrar</h4>
					<div id="loginbox" class="loginbox">
          <?=$msg;?>
						<form class="user" method="post" name="email" id="login-form" data-parsley-validate>
						  <fieldset class="input">
						    <p id="login-form-username">
						      <label for="modlgn_username">Email</label>
						      <input id="modlgn_username" type="email" name="email" class="inputbox" id="email" required data-parsley-validate="Preencha o Email" placeholder="Email de Acesso">
						    </p>
						    <p id="login-form-password">
						      <label for="modlgn_passwd">Senha</label>
						      <input id="modlgn_passwd" type="password" name="senha" class="inputbox" id="senha" required data-parsley-validate="Preencha a Senha" placeholder="Digite sua Senha">
						    </p>
						    <div class="remember">
							    <p id="login-form-remember">
							      <label for="modlgn_remember"><a href="pages-reset-password.html">Esqueceu sua senha? </a></label>
							    </p>
							    <input type="submit" class="button" value="Entrar"></div>
							  </div>
						  </fieldset>
						</form>
					</div>
			  </div>
			
			</div>
		</div>
	</div>