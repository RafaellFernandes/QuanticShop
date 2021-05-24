<?php if (!isset($_SESSION["quanticshop"]["id"])) {
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
					<h6 style="color: blue;"><strong>Gerencia de Estoque</strong></h6>
				</div>
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
                            <th>ID PRODUTO</th>
							<th>CODIGO</th>
							<th>PRODUTO</th>
							<th>QUANTIDADE<br>ESTOQUE</th>
                            <th>DATA CADASTRO</th>
							<th>QUANTIDADE<br>COMPRA</th>
                            <th>CUSTO<br>UNITARIO</th>
                            <th>QUANTIDADE<br>VENDIDA</th>
                            <th>TOTAL<br>COMPRADO</th>
                            <th>TOTAL<br>VENDIDO</th>
						</tr>
					</thead>
					<tbody><br>
						<?php
                            $sql =  "SELECT p.id pid, p.ativo pativo, p.*, count(p.vezesVendido) as vezes, 
                                            ic.id icid, ic.status icstatus, ic.*, count(ic.qtd_produto) as quantidade, date_format(ic.data_cadastro, '%d/%m/%Y') datacad, 
                                            e.id eid, e.* 
                                            FROM item_compra ic 
                                            INNER JOIN produto p ON (p.id = ic.produto_id) 
                                            INNER JOIN estoque e ON (p.id = e.produto_id) 
                                            WHERE ic.status = 1 ORDER BY p.id DESC";

                            $consulta = $pdo->prepare($sql);
							$consulta->execute();
                           
							while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
								//separar os dados

                                $eid 		                 = $dados->eid;
                                $icid 		                 = $dados->icid;
                                $pid 		                 = $dados->pid;
                                $codigo                      = $dados->codigo;
                                $nome_produto                = $dados->nome_produto;
                                $qtd_estoque                 = $dados->qtd_estoque;  
                                $datacad                     = $dados->datacad;
                                $quantidade                  = $dados->quantidade;
                                $custo_unitario              = $dados->custo_unitario;
                                $custo_unitario              = number_format($custo_unitario,2, '.' , ',');	
                                $vezes                       = $dados->vezes;
                                $vezesVendido                = $dados->vezesVendido;
                                $pativo                      = $dados->pativo;
                                
                                $qtd_produto                 = $dados->qtd_produto;                             

								//mostrar na tela
								if ($pativo == "1"){
									echo '<tr>
                                            <td>'.$pid.'</td>
                                            <td>'.$codigo.'</td>
                                            <td>'.$nome_produto.'</td>
                                            <td>'.$qtd_estoque.'</td>
                                            <td>'.$datacad.'</td>
                                            <td>'.$qtd_produto.'</td>
                                            <td>R$ '.$custo_unitario.'</td>
                                            <td>'.$vezesVendido.'</td>
                                            <td>'.$quantidade.'</td>
                                            <td>'.$vezes.'</td>
                                           
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