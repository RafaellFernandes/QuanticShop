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
						<a class="btn btn-danger mt-3" target="_blank" href="relatorioProdutoMenosVendido.php">Gerar PDF</a>
					</div>
					<h4>RELATÓRIO</h4>
					<h6 style="color: blue;"><strong>Produto Menos Vendido</strong></h6>
				</div>
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>NOME PRODUTO</th>
							<th>CODIGO</th>
							<th>VALOR UNITARIO</th>
                            <th>VEZES VENDIDA</th>
							<th>ID - MARCA</th>
                            <th>ID - DEPARTAMENTO</th>
						</tr>
					</thead>
					<tbody><br>
						<?php
                            $sql = "SELECT p.id pid, p.ativo pativo, p.*, m.id mid, m.*, d.id did, d.*  
                                    FROM produto p 
                                    INNER JOIN departamento d ON (d.id = p.departamento_id)
                                    INNER JOIN marca m ON (m.id = p.marca_id) ORDER BY p.vezesVendido ASC";

                            $consulta = $pdo->prepare($sql);
							$consulta->execute();                            

							while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
								//separar os dados
								$pid 		                 = $dados->pid;
                                $nome_produto 		         = $dados->nome_produto;
                                $codigo                      = $dados->codigo;
                                $valor_unitario              = $dados->valor_unitario;
                                $valor_unitario              = number_format($valor_unitario,2, '.' , ',');
                                $vezesVendido                = $dados->vezesVendido;
								$marca_id                    = $dados->marca_id;
                                $nome_marca                  = $dados->nome_marca;
                                $departamento_id             = $dados->departamento_id;
							 	$nome_dept 	                 = $dados->nome_dept;
                                $pativo					     = $dados->pativo;

								//mostrar na tela
								if ($pativo == "1"){
                                    echo '<tr>
                                        <td>'.$pid.'</td>
                                        <td>'.$nome_produto.'</td>
                                        <td>'.$codigo.'</td>
                                        <td>R$ '.$valor_unitario.'</td>
                                        <td>'.$vezesVendido.'</td>
                                        <td>'.$marca_id.' - '.$nome_marca.'</td>
                                        <td>'.$departamento_id.' - '.$nome_dept.'</td>
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