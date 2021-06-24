<?php
    include('config/config.php'); 
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="vendor/images/saturno.png">
        <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
        <link href="login/styleLogin.css" rel="stylesheet">
        <title>Quantic Shop - Redefinir Senha</title>
    </head>
    <body class="bodyLogin">
        <?php
            if(isset($_GET['token'])){
                $token = $_GET['token'];
                if($token != $_SESSION['token']){
                    die('<div class="wrapper mt-5">
                            <div class="container d-flex flex-column  mb-5 ">
                                <div class="container mt-5">
                                    <div class="card">
                                        <div class="card-header text-center">
                                            <b>Quantic Shop</b>
                                        </div>
                                        <div class="card-body text-center">
                                            <h3 class="text-danger">O Token não Corresponde</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>');
                }else{
        ?>
        <div class="wrapper mt-5">
            <div class="container d-flex flex-column  mb-5 ">
                <div class="container mt-5">
                    <div class="card">
                        <div class="card-header text-center">
                            <b>Quantic Shop </b>
                        </div>
                        <div class="card-body text-center">
                            <?php
                                $sql = $pdo->prepare("SELECT * FROM cliente WHERE email = ?");
                                $sql->execute([$_SESSION['email']]);
                                $info = $sql->fetch();
                                
                                if($sql->rowCount() == 1){    
                                    if(isset($_POST['redefinirsenha'])){
                                            $senha = $_POST['senha'];
                                            $criptografada = password_hash($senha, PASSWORD_BCRYPT);
                                            $sql = $pdo->prepare("UPDATE cliente SET senha = ? WHERE email = ?");
                                            $sql->execute([$criptografada, $_SESSION['email']]);
                                            echo "<script>alert('Senha Salva com Sucesso!');location.href='http://localhost//QuanticShop/loja/pages/home';</script>";                                                
                                    }
                                }else{
                                    echo 'Não encontramos esse email';
                                }  
                            ?>
                            <h4><i class="fas fa-lock"></i> Redefinir a minha senha</h4>
                            <div class="card-body text-center ">
                                <form method="POST">
                                    <div class="input_group col-12">
                                        <label for="senha">Digite a sua nova senha</label>
                                        <input type="password" id="senha" class="form-control" name="senha"><br>
                                        <label for="redigite">Redigite a sua nova senha</label>
                                        <input type="password" id="redigite" class="form-control" name="redigite" data-parsley-equalto="#senha"
							            data-parsley-equalto-message="As senhas devem ser iguais">
                                    </div>
                                    <div class="input_group mt-3">
                                        <button class="btn btn-primary" type="submit" name="redefinirsenha" value="Redefinir">Redefinir</button>
                                    </div>
                                </form>
                                <div class="direitos">
                                    <p class="text-small mt-5">Todos os direitos reservados</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        }   
    ?>
    <?php
        }else{
            echo    '<div class="wrapper mt-5">
                        <div class="container d-flex flex-column  mb-5 ">
                            <div class="container mt-5">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <b>Quantic Shop</b>
                                    </div>
                                    <div class="card-body text-center">
                                        <h3 class="text-danger">É Necessário um Token Para redefinir a Senha</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            ';
        }   
    ?>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>