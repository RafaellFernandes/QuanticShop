
<div class="main">
  <div class="shop_top">
		<div class="container">
			<div class="col-md-12">
				<div class="login-page">
					<h4 class="title text-center">Saída</h4>
               <p class="text-center">Deseja realmente sair?</p>
               <br><br><br><br><br>
					<div class="button11">
                  <?php 
                  
                      SESSION_START();
                      $token = SHA1(session_id());
                      if(isset($_GET['token']) && $_GET['token'] === $token) {
                         // limpe tudo que for necessário na saída.
                         // Eu geralmente não destruo a seção, mas invalido os dados da mesma
                         // para evitar algum "necromancer" recuperar dados. Mas simplifiquemos:
                         session_destroy();
                         header("location: login");
                         exit();
                      } else {
                         // echo '<a href= "sairConta.php?token='.$token.'">Confirmar logout</a>';
                         echo' <div class="text-center" >
                                  <a class="btn btn-dark" href= "sair.php?token='.$token.'">Confirmar logout</a>
                               </div>';
                      }

                     // session_start();
                     // unset($_SESSION['id'], $_SESSION['email'], $_SESSION['primeiro_nome']);

                     // $_SESSION['msg'] = "Deslogado com sucesso";
                     // header("Location: home");
                  ?>
					</div>
				   <div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
</div>