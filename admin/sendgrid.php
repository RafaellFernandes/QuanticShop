<?php
require 'vendor/autoload.php';// Se você estiver usando o Composer (recomendado)
// Comente a linha acima se não estiver usando o Composer
require ("vendor/sendgrid/sendgrid-php.php");
// Se não estiver usando o Composer, descomente a linha acima e
// baixe sendgrid-php.zip da versão mais recente aqui,
// substituindo <PATH TO> pelo caminho para o arquivo sendgrid-php.php,
// que está incluído no download:
// https://github.com/sendgrid/sendgrid-php/releases

$email = new  \SendGrid\Mail\Mail(); 
$email->setFrom("raphaelldff@gmail.com", "Rafael");
$email->setSubject("Sending with SendGrid is Fun");
$email->addTo("raphaelldff@gmail.com", "Example User");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
);
$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}