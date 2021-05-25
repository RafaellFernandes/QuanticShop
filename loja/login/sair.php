<?php 
  session_start();
  $_SESSION = array();
  session_destroy();
  header("Location: http://localhost/QuanticShop/loja/login/login");
?>