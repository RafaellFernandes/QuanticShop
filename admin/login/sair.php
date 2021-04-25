<!doctype html>
<html lang="PT-BR">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
      <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
      <link href="../assets/css/app.css" rel="stylesheet">
   </head>
   <body> 
      <div class="container d-flex flex-column">
         <div class="row vh-100">
            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
               <div class="d-table-cell align-middle">
                  <div class="text-center">
                     <h1 class="h2">Quantic Shop - Admin</h1>
                     <p class="lead">Saída</p>
                  </div>
                  <div class="card">
                     <div class="card-body">
                        <div class="m-sm-4">
                           <div class="text-center">
                              <p class="lead">Para realizar o Logout clique em confirmar</p>
                              <img src="../img/user.png" alt="Saida" title="Saida" class="img-fluid text-center" width="70" height="70" />
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
                                 echo' <div class="text-center mt-4" >
                                          <a class="btn btn-danger" href= "sair.php?token='.$token.'">Confirmar logout</a>
                                       </div>';
                                 }
                              ?>
                              <div class="text-center mt-4">
                                 <a href="../paginas/home" class="btn btn-primary">Voltar</a>
                              </div>

                           </div>
                        </div>
                     </div>
                     <p class="text-center">Até Mais :) </p>
                  </div>
               </div>
            </div>
            <p class="text-center">Quantic Shop ME &copy; 2019-2021</p>
         </div>
      </div>
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
   </body>
</html>