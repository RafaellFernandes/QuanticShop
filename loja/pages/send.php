<?php 

include "mailconfig.php";

$date = date("d/m/Y h:i");


//ENVIO DA MENSAGEM ORIGINAL
$headers = "$cabecalho_da_mensagem_original";
if ($assunto_digitado_pelo_usuario=="n")
{
  $assunto = "$assunto_da_mensagem_original";
};
$seuemail = "$email_para_onde_vai_a_mensagem";
$mensagem = "$configuracao_da_mensagem_original";
mail($seuemail,$assunto,$mensagem,$headers);

//ENVIO DE MENSAGEM DE RESPOSTA AUTOMATICA
$headers = "$cabecalho_da_mensagem_de_resposta";
if ($assunto_digitado_pelo_usuario=="n")
{
  $assunto = "$assunto_da_mensagem_de_resposta";
}
else
{
  $assunto = "Re: $assunto";
};
$mensagem = "$configuracao_da_mensagem_de_resposta";
mail($email,$assunto,$mensagem,$headers);

echo "<script>window.location='$exibir_apos_enviar'</script>";

?>