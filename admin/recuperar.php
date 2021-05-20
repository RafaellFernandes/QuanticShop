<?php
      include('config/conexao.php');
      include('Email.php');

      if(isset($_POST['esqueciasenha'])){
        $token = uniqid();
        
         $_SESSION['email'] = $_POST['email'];
         $_SESSION['token'] = $token;

         $sql = $pdo->prepare("SELECT * FROM usuario WHERE email = ?");
         $sql->execute([$_SESSION['email']]);

         if($sql->rowCount() == 1){
            $info = $sql->fetch();
        
            $mail = new Email('smtp.mailtrap.io','9f243cd520239f','fa9d79d2aa1c8c','Quantic Shop');

            $mail->enviarPara($_POST['email'], $info['primeiro_nome']);

            $url = 'http://localhost//QuanticShop/admin/redefinir.php';

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
 
            die('As orientações para criar uma nova senha no site tal foram enviadas ao seu e-mail.');
       }else{
            die('Não encontramos esse <b>email</b> em nossa base de dados.');
       }
    }
   
?>