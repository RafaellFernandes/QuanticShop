<?php
//utilização de namespaces
namespace controle;

include 'processoAcesso.php';

use processaAcesso as processaAcesso;

$controle = new \processaAcesso\ProcessaAcesso;

if ($_POST['enviar']) {

    $login = $_POST['login'];
    $senha = md5($_POST['senha']);
    $usuario = $controle->verificaAcesso($login, $senha);

    //redirecionando para pagina conforme o tipo do usuário
    if ($usuario[0]['nivelAcesso'] == "admin") {
        header("Location:paginas/home");

    } else if ($usuario[0]['nivelAcesso'] == "cliente") {
        header("Location:paginas/erro");
    }
}



 else if ($_POST['cadastrar']) {
    $login = $_POST['login'];
    $senha = md5($_POST['senha']);
    $tipo_usuario = $_POST['nivelAcesso'];
    $arr = array('login_usuario' => $login, 'senha' => $senha, 'nivelAcesso' => $tipo_usuario);

    if (!$controle->cadastraUsuario($arr)) {
        echo 'Aconteceu algum erro';

    } else {
        $tipo_acesso = $controle->verificaAcesso($login, $senha);

        if ($tipo_acesso[0]['nivelAcesso'] == "admin") {
            header("Location:paginas/home");

        } else if ($tipo_acesso[0]['nivelAcesso'] == "cliente") {
            header("Location:paginas/erro");
        }
    }
}
?>