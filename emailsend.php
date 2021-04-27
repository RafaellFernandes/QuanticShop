<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once './connection.php';
require './lib/vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Quantic Shop - Contato</title>
    </head>
    <body>
        <h2>Enviar Mensagem</h2>
        <?php
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($data['SendAddMsg'])) {
            //var_dump($data);
            $query_msg = "INSERT INTO contacts_msgs (name, email, subject, content, created) VALUES (:name, :email, :subject, :content, NOW())";
            $add_msg = $conn->prepare($query_msg);

            $add_msg->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $add_msg->bindParam(':email', $data['email'], PDO::PARAM_STR);
            $add_msg->bindParam(':subject', $data['subject'], PDO::PARAM_STR);
            $add_msg->bindParam(':content', $data['content'], PDO::PARAM_STR);

            $add_msg->execute();

            if ($add_msg->rowCount()) {
                $mail = new PHPMailer(true);
                try {
                    $mail->CharSet = 'UTF-8';
                    $mail->isSMTP();
                    $mail->Host = 'smtp.mailtrap.io';
                    $mail->SMTPAuth = true;
                    $mail->Username = '9f243cd520239f';
                    $mail->Password = 'fa9d79d2aa1c8c';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 2525;

                    //Enviar e-mail para o cliente
                    $mail->setFrom('atendimento@celke.com.br', 'Atendimento');
                    $mail->addAddress($data['email'], $data['name']);

                    $mail->isHTML(true);
                    $mail->Subject = 'Recebi a mensagem de contato';
                    $mail->Body = "Prezado(a) " . $data['name'] . "<br><br>Recebi o seu e-mail.<br>Será lido o mais rápido possível.<br>Em breve será respondido.<br><br>Assunto: " . $data['subject'] . "<br>Conteúdo: " . $data['content'];
                    $mail->AltBody = "Prezado(a) " . $data['name'] . "\n\nRecebi o seu e-mail.\nSerá lido o mais rápido possível.\nEm breve será respondido.\n\nAssunto: " . $data['subject'] . "\nConteúdo: " . $data['content'];

                    $mail->send();
                    
                    $mail->clearAddresses();

                    //Enviar e-mail para o colaborador da empresa
                    $mail->setFrom('atendimento@celke.com.br', 'Atendimento');
                    $mail->addAddress('kelly@celke.com.br', 'Kelly');

                    $mail->isHTML(true);
                    $mail->Subject = $data['subject'];
                    $mail->Body = "Nome: " . $data['name'] . "<br>E-mail: " . $data['email'] . "<br>Assunto: " . $data['subject'] . "<br>Conteúdo: " . $data['content'];
                    $mail->AltBody = "Nome: " . $data['name'] . "\nE-mail: " . $data['email'] . "\nAssunto: " . $data['subject'] . "\nConteúdo: " . $data['content'];

                    $mail->send();
                    unset($data);
                    echo "Mensagem de contato enviada com sucesso!<br>";                    
                } catch (Exception $e) {
                    echo "Erro: Mensagem de contato não enviada com sucesso!<br>";
                }
            } else {
                echo "Erro: Mensagem de contato não enviada com sucesso!<br>";
            }
        }
        ?>
        <form name="add_msg" action="" method="POST">
            <label>Nome: </label>
            <input type="text" name="name" id="name" placeholder="Nome completo" value="<?php
            if (isset($data['name'])) {
                echo $data['name'];
            }
            ?>" autofocus required><br><br>

            <label>E-mail: </label>
            <input type="email" name="email" id="name" placeholder="O melhor e-mail"  value="<?php
            if (isset($data['email'])) {
                echo $data['email'];
            }
            ?>" required><br><br>

            <label>Assunto: </label>
            <input type="text" name="subject" id="subject" placeholder="Assunto da mensagem"  value="<?php
            if (isset($data['subject'])) {
                echo $data['subject'];
            }
            ?>" required><br><br>

            <label>Conteúdo: </label>
            <input type="text" name="content" id="content" placeholder="Conteúdo da mensagem"  value="<?php
                   if (isset($data['content'])) {
                       echo $data['content'];
                   }
                   ?>" required><br><br>

            <input type="submit" value="Enviar" name="SendAddMsg">
        </form>
    </body>
</html>