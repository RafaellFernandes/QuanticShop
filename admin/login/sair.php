<?php
/*
session_start();
session_destroy();
header("location:  paginas/login.php"); 
*/
?>
<!doctype html>
<html lang="pt-BR">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   </head>
   <body>
   <div class="card text-center mt-5 mr-5 ml-5">
      <div class="card-header">
      Deseja Fazer Logout?
      </div>
      <div class="card-body">
       
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
               echo' <div class="alert alert-danger " role="alert">
               <a class="btn btn-danger" href= "sair.php?token='.$token.'">Confirmar logout</a>
               </div>';
               }
            ?>
         <div class="alert alert-info" role="alert">
            <a href="../paginas/home" class="btn btn-info">Cancelar</a>
         </div>
      </div>
      <div class="card-footer text-muted">
         Quantic Shop 
      </div>
   </div>
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   </body>
</html>


