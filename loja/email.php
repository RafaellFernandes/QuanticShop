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
                
                //Instantiation and passing `true` enables exceptions
                $this->mail = new PHPMailer;

                //Server settings
                $this->mail->isSMTP();                                              //Send using SMTP
               // $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                         //Enable verbose debug output - Mostra as informaçoes na pagina quando manda
                $this->mail->Host       = $host;                                    //Set the SMTP server to send through
                $this->mail->SMTPAuth   = true;                                     //Enable SMTP authentication
                $this->mail->Username   = $username;                                //SMTP username
                $this->mail->Password   = $senha;                                   //SMTP password
                $this->mail->Port       = 465;                                        //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;           //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $this->mail->SMTPSecure = 'ssl';
                                                 

                //Destinatario
                $this->mail->setFrom($username, $nome);
                $this->mail->isHTML(true); 
                $this->mail->addReplyTo($username, $nome);
                $this->mail->CharSet = 'UTF-8';
            
            }

            public function enviarPara($email, $nome){
                $this->mail->addAddress($email, $nome);     // Endereço da sua empresa
            }
    
            public function formatarEmail($info){
                $this->mail->Subject = $info['Assunto'];
                $this->mail->Body    = $info['Corpo'];
                $this->mail->AltBody = strip_tags($info['Corpo']); //Não lembro pq adicionar de novo, mas adiciona pra garantir.
            }
    
            public function enviarEmail(){ //enviando o email
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