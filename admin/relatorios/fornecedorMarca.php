<?php
if (!isset($_SESSION["quanticshop"]["id"])) {
  $titulo = "Erro";
  $mensagem = "Usuário Não Logado";
  $icone = "error";
  mensagem($titulo, $mensagem, $icone);
exit;
}

if ($_SESSION["quanticshop"]["nivelAcesso"] != "admin") {
  $titulo = "Erro";
  $mensagem = "Erro na Requisição da Página";
  $icone = "error";
  mensagem($titulo, $mensagem, $icone);
exit;
}
?>						
<div class="container-fluid p-0">
	<div class="row">
		<div class="col-12 col-xl-12">
			<div class="card">
				<div class="card-header">
					<div class="float-end">
						<a class="btn btn-danger mt-3" target="_blank" href="relatorioFornecedorMarca.php">Gerar PDF</a>
					</div>
					<h4>RELATÓRIO</h4>
					<h6 style="color: blue;"><strong>Marca Mais Comprada por Fornecedor</strong></h6>
				</div>
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
                            <th>ID MARCA <br> NOME MARCA</th>
							<th>ID FORNECEDOR <br> RAZAO SOCIAL</th>
							<th>CNPJ</th>
							<th>EMAIL<br>SITE</th>
                            <th>TELEFONE<br>CELULAR</th>
							<th>CIDADE-UF</th>
						</tr>
					</thead>
					<tbody><br>
						<?php
                            $sql =  "SELECT ic.id icid, ic.status icstatus, ic.*,
                                            m.id mid, m.*, 
                                            f.id fid, f.*, 
                                            p.id pid, p.ativo pativo, p.*  
                                     FROM item_compra ic
                                     INNER JOIN produto p ON (p.id = ic.produto_id)
                                     INNER JOIN fornecedor f ON (f.id = ic.fornecedor_id)
                                     INNER JOIN marca m ON (m.id = p.marca_id)
                                     WHERE ic.status = 1
                                     ORDER BY p.vezesVendido DESC";

                            $consulta = $pdo->prepare($sql);
							$consulta->execute();

							while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
								//separar os dados
								$icid 		                 = $dados->icid;
                                $produto_id 		         = $dados->produto_id;
                                $fornecedor_id               = $dados->fornecedor_id;
                                $icstatus					 = $dados->icstatus;

                                $mid 		                 = $dados->mid;
                                $marca_id                    = $dados->marca_id;
                                $nome_marca                  = $dados->nome_marca;

                                $fid 		                 = $dados->fid;
                                $razaoSocial                 = $dados->razaoSocial;
                                $cnpj 	                     = $dados->cnpj;
                                $telefone                    = $dados->telefone;
                                $celular                     = $dados->celular;
                                $email                       = $dados->email;
                                $siteFornecedor              = $dados->siteFornecedor;
                                $cidade_id                   = $dados->cidade_id;
                                $cidade                      = $dados->cidade;
                                $estado                      = $dados->estado;

                                $pid 		                 = $dados->pid;
                                $vezesVendido                = $dados->vezesVendido;
                                $pativo                      = $dados->pativo;
                               
                
								//mostrar na tela
								if ($icstatus == "1"){
									echo '<tr>
                                            <td>'.$mid.'<br>'.$nome_marca.'</td>
                                            <td>'.$fid.'<br>'.$razaoSocial.'</td>
                                            <td>'.$cnpj.'</td>
                                            <td>'.$email.'<br>'.$siteFornecedor.'</td>
                                            <td>'.$telefone.'<br>'.$celular.'</td>
                                            <td>'.$cidade_id.'<br>'.$cidade.'-'.$estado.'</td>
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