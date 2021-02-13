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
        echo '<script>location.href="home";</script>';
        exit;
      }
      //mostrar erros
      // ini_set('display_errors',1);
      // ini_set('display_startup_erros',1);
      // error_reporting(E_ALL);
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
					<div class="button1">
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
						<form action="" method="post" name="login" id="login-form">
						  <fieldset class="input">
						    <p id="login-form-username">
						      <label for="modlgn_username">Email</label>
						      <input id="modlgn_username" type="text" name="email" class="inputbox" id="login" size="18" autocomplete="off" required data-parsley-required-message="Preencha o Email">
						    </p>
						    <p id="login-form-password">
						      <label for="modlgn_passwd">Senha</label>
						      <input id="modlgn_passwd" type="password" name="Senha" class="inputbox" id="senha" size="18" autocomplete="off" required data-parsley-required-message="Preencha a senha">
						    </p>
						    <div class="remember">
							    <p id="login-form-remember">
							      <label for="modlgn_remember"><a href="#">Esqueceu sua Senha? </a></label>
							    </p>
							    <input type="submit" name="Submit" class="button" value="Login"><div class="clear"></div>
							  </div>
						  </fieldset>
						</form>
					</div>
			  </div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>