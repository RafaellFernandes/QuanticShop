<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["quanticshop"]["id"] ) ){
    exit;
  }
?>						
<div class="container-fluid p-0">
	<div class="row">
		<div class="col-12 col-xl-12">
			<div class="card">
				<div class="card-header">
					<div class="float-end">
						<a class="btn btn-danger" target="_blank" href="relatorioClienteAtivo.php">Gerar PDF</a>
					</div>
					<h4>RELATÓRIO</h4>
					<h6 style="color: blue;"><strong>Clientes Ativos</strong></h6>
				</div>
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>NOME</th>
							<th>CPF/CNPJ</th>
							<th>EMAIL/SITE</th>
                            <th>TELEFONE/CELULAR</th>
							<th>CIDADE-UF</th>
						</tr>
					</thead>
					<tbody><br>
						<?php
                            $sql = "SELECT * FROM cliente";
                            $consulta = $pdo->prepare($sql);
                            $consulta->bindParam(":id", $id);
							$consulta->execute();

							while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
								//separar os dados
								$id 		                 = $dados->id;
                                $primeiro_nome 		         = $dados->primeiro_nome;
                                $sobrenome                   = $dados->sobrenome;
                                $cpf                         = $dados->cpf;
                                $cnpj                        = $dados->cnpj;
								$razaoSocial                 = $dados->razaoSocial;
                                $email                       = $dados->email;
                                $siteClienteJuridico         = $dados->siteClienteJuridico;
							 	$telefone 	                 = $dados->telefone;
                                $celular                     = $dados->celular;
								$cidade_id                   = $dados->cidade_id;
                                $cidade                      = $dados->cidade;
                                $estado                      = $dados->estado;
                                $ativo					     = $dados->ativo;

								//mostrar na tela
								if ($ativo == "1"){
									echo '<tr>
										<td>'.$id.'</td>
										<td>'.$primeiro_nome.''.$sobrenome.'<br>'.$razaoSocial.'</td>
										<td>'.$cpf.'<br>'.$cnpj.'</td>
										<td>'.$email.'<br>'.$siteClienteJuridico.'</td>
										<td>'.$telefone.'<br>'.$celular.'</td>
										<td>'.$cidade_id.'-  '.$cidade.'-'.$estado.'</td>
									</tr>';
								}
								
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>	