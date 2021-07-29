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
                                   <?php
                                        include('config/config.php');
                                        include('email.php');

                                        //mostrar erros
                                        ini_set('display_errors', 1);
                                        ini_set('display_startup_erros', 1);
                                        error_reporting(E_ALL);

                                        if(isset($_POST['esqueciasenha'])){
                                        $token = uniqid();
                                        
                                        $_SESSION['email'] = $_POST['email'];
                                        $_SESSION['token'] = $token;

                                        $sql = $pdo->prepare("SELECT * FROM usuario WHERE email = ?");
                                        $sql->execute([$_SESSION['email']]);

                                        if($sql->rowCount() == 1){
                                             $info = $sql->fetch();
                                        
                                             $mail = new Email('smtp.gmail.com','sac.quanticshop@gmail.com','quanticshop21','Quantic Shop');

                                             $mail->enviarPara($_POST['email'], $info['primeiro_nome']);

                                             $url = 'http://localhost//QuanticShop/admin/redefinir.php';

                                             $corpo = 'Olá '.$info['primeiro_nome'].', <br>
                                             Foi solicitada uma redefinição da sua senha no Sistema Quantic - QuanticShop. Acesse o link abaixo para redefinir sua senha.<br>
                                             <h3><a href="'.$url.'?token='.$_SESSION['token'].'">Redefinir a sua senha</a></h3> 
                                             <br>            
                                             Caso você não tenha solicitado essa redefinição, ignore esta mensagem.<br>
                                             Qualquer problema ou dúvida entre em contato pelo email contato@quantishop.com';
                                   
                                             $informacoes = ['Assunto'=>'Redefinição de senha', 'Corpo'=>$corpo];           
                                             $mail->formatarEmail($informacoes);
                                             
                                             if($mail->enviarEmail()){
                                                  $data['sucesso'] = true;
                                             }else{
                                                  $data['erro'] = true;
                                             }
                                             die('As orientações para criar uma Nova Senha foram enviadas ao seu Email. :)');
                                        
                                             
                                        }else{
                                             die('Não encontramos esse <b>Email</b> em nossa base de dados.');
                                        }
                                   }
                                   ?>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
     </body>
</html>
