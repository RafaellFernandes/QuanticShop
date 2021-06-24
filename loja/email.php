<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quantic Shop - Email</title>
</head>
<body>
    <?php 
    
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;

        //Load Composer's autoloader
        require 'vendor/autoload.php';

        class Email {
            
            private $mail;

            public function __construct($host = null, $username = null, $senha = null, $nome = null){
                
                $this->mail = new PHPMailer;

                //Server settings
                $this->mail->isSMTP();                                                               
                $this->mail->Host       = $host;                                    
                $this->mail->SMTPAuth   = true;                                    
                $this->mail->Username   = $username;                              
                $this->mail->Password   = $senha;                                 
                $this->mail->Port       = 465;                                      
                $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
                $this->mail->SMTPSecure = 'ssl';
                                                 

                //Destinatario
                $this->mail->setFrom($username, $nome);
                $this->mail->isHTML(true); 
                $this->mail->addReplyTo($username, $nome);
                $this->mail->CharSet = 'UTF-8';
            
            }

            public function enviarPara($email, $nome){
                $this->mail->addAddress($email, $nome);    
            }
    
            public function formatarEmail($info){
                $this->mail->Subject = $info['Assunto'];
                $this->mail->Body    = $info['Corpo'];
                $this->mail->AltBody = strip_tags($info['Corpo']);
            }
    
            public function enviarEmail(){
                if($this->mail->send()){
                    return true;
                }else{
                    return false;
                }
            }
        }
    ?>
</body>
</html>