<?php
  /*verificar se não está logado 
  if ( !isset ( $_SESSION["bancotcc"]["id"] ) ){
    exit;
  }*/
?>
    <!DOCTYPE html>

    <html>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>404 Error - Quantic Shop</title>
        <!-- <link href="../admin/vendor/css/styles.css" type="text/css" rel="stylesheet" /> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>

    <body>
    <!-- Erro 404, Pagina nao encontrada -->
    <div class="container-fluid p-0">
	<div class="row">
		<div class="col-12 col-xl-12">
			<div class="card">
				<div class="card-header">
                    <div id="layoutError">  <!-- ******** -->
                        <div id="layoutError_content">
                            <main>
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-6">
                                            <div class="text-center mt-4">
                                                <img class="mb-4 img-error" src="../admin/img/error-404-monochrome.svg" />
                                                <p class="lead">Este URL solicitado não foi encontrado neste servidor.</p>
                                                <a href="paginas/home">
                                                    <i class="fas fa-arrow-left mr-1"></i> Retornar ao Dashboard
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </main>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <!-- <script src="../admin/vendor/js/scripts.js"></script> -->
    </div>
    </body>

    </html>