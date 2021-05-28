<?php
      include('../config/conexao.php');
      include('Email.php');

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
        
            $mail = new Email('smtp.mailtrap.io','3a1d8178ea29ef','59b79050e81fd1','Quantic Shop');

            $mail->enviarPara($_POST['email'], $info['primeiro_nome']);

            $url = 'http://localhost//QuanticShop/admin/recuperarSenha/redefinir.php';

            $corpo = 'Olá '.$info['primeiro_nome'].', <br>
            Foi solicitada uma redefinição da sua senha na "Nome do site". Acesse o link abaixo para redefinir sua senha.<br>
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
            
            die('As orientações para criar uma nova senha foram enviadas ao seu e-mail.');
        
           
       }else{
            die('Não encontramos esse <b>email</b> em nossa base de dados.');
       }
    }
   
?>