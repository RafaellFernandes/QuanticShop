<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="static/img/icons/icon-48x48.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="login/styleLogin.css" rel="stylesheet">
    <title>Quantic Shop - Redefinir Senha</title>
  </head>
  <body class="bodyLogin">
    <div class="wrapper mt-5">
    <div class="container d-flex flex-column  mb-5 ">
        <div class="container mt-5">
            <div class="card">
                <div class="card-header text-center">
                    <b>Quantic Shop - Sistema</b>
                </div>
                <div class="card-body text-center">
                    <form method="post" action="recuperar.php">
                        <div class="input_form_login  text-center mb-3 ml-5 mr-5">
                            <label for="email">Insira o seu Email.</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="email@exemplo.com" required>
                        </div> 
                        <p class="card-text text-danger text-small text-center">Sera Enviado ao Seu email um link para a Redefinição de senha.</p>
                        <div class="input_form_login float-end">
                            <button class="btn btn-primary" type="submit" name="esqueciasenha" value="Redefinir">Enviar Email</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
