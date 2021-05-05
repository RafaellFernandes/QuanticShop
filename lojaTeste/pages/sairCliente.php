<?php
session_start();

$token = md5(session_id());

if(isset($_GET['token']) && $_GET['token'] === $token) {
   // limpe tudo que for necessário na saída.
   // Eu geralmente não destruo a seção, mas invalido os dados da mesma
   // para evitar algum "necromancer" recuperar dados. Mas simplifiquemos:
   session_destroy();
   header("location:pages/loginCliente.php");
   exit();
} else {
   echo '<a href="pages/sairCliente.php?token='.$token.'>Confirmar logout</a>';
}


/*
session_start();

//apagar a sessao
unset ( $_SESSION["bancotcc"] );

//redirecionar para a página inicial
header("Location: pages/loginCliente.php");*/