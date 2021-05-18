<?php 
   session_start();
   $token = md5(session_id());
   if(isset($_GET['token']) && $_GET['token'] === $token) {
      // limpe tudo que for necessário na saída.
      // Eu geralmente não destruo a seção, mas invalido os dados da mesma
      // para evitar algum "necromancer" recuperar dados. Mas simplifiquemos:
      session_destroy();
      header("location: login/login");
      exit();
   } else {
   // echo '<a href= "sairConta.php?token='.$token.'">Confirmar logout</a>';
   echo' <div class="text-center mt-4" >
            <a class="btn btn-danger" href= "sair.php?token='.$token.'">Confirmar logout</a>
         </div>';
   }
?>
                             