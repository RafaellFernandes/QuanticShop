<nav class="navbar navbar-dark bg-dark">
	<div class="btn-group btn-group-sm btn-sm">
  		<ul class="nav" id="nav">	
            <li><a class="dropdown-item" href="departamento/eletrodomesticos">Eletrodomésticos</a></li>
            <li><a class="dropdown-item" href="departamento/eletroportateis">Eletroportáteis</a></li>
            <li><a class="dropdown-item" href="departamento/gamer">Gamer</a></li>
            <li><a class="dropdown-item" href="departamento/hardware">Hardware</a></li>
            <li><a class="dropdown-item" href="departamento/impressora">Impressora</a></li>
            <li><a class="dropdown-item" href="departamento/notebooks">Notebooks</a></li>
            <li><a class="dropdown-item" href="departamento/perifericos">Periféricos</a></li>
            <li><a class="dropdown-item" href="departamento/smartHome">Smart Home</a></li>
            <li><a class="dropdown-item" href="departamento/smartphone">Smartphones</a></li>
			<li><a class="dropdown-item" href="departamento/computadores">Computadores</a></li>	  
  		</ul>
	</div>
</nav>
<div class="latest-products">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

<?php
if(isset($_POST['pesquisaCliente'])):
    //recebemos nosso parâmetro vindo do form
    $parametro = isset($_POST['pesquisaCliente']) ? $_POST['pesquisaCliente'] : null;
    $msg = "";

    //começamos a concatenar nossa tabela
    $msg .=" <div class='col-md-4'>";
    $msg .="    <div class='product-item'>";
    $msg .="        <a href='#'><img align='right' src='../fotos/produtos/' class='img' alt='' title='Produto: '></a>";
    $msg .="        <div class='down-content'>";
    $msg .="             <a href='pages/produto/'><h4></h4></a>";
    $msg .="            <h6>R$ </h6>";
    $msg .="            <a href='pages/produto/' class='btn btn-primary'>Detalhes</a><br>";
    $msg .="        </div>";
    $msg .="     </div>";
    $msg .=" </div>";
                 
                //requerimos a classe de conexão
                require_once('../config/conexao.php');
                    // try {
                    //     $pdo = new Conexao(); 
                    //     $resultado = $pdo->select("SELECT p.id pid, p.*, e.id eid, e.* 
                    //                                FROM produto p
                    //                                INNER JOIN estoque e ON (p.id = e.produto_id)
                    //                                WHERE ativo = 1  AND qtd_estoque > 10 
                    //                                LIKE '%$parametro%' 
                    //                                ORDER BY nome_produto ASC");
                    //     $pdo->desconectar();
                                 
                    //     }catch (PDOException $e){
                    //         echo $e->getMessage();
                    //     }   

                    $sql = "SELECT p.id pid, p.*, e.id eid, e.* 
                            FROM produto p
                            INNER JOIN estoque e ON (p.id = e.produto_id)
                            WHERE ativo = 1  AND qtd_estoque > 10 AND p.nome_produto
                            LIKE '%$parametro%' 
                            ORDER BY nome_produto ASC";

                        $consulta = $pdo->prepare($sql);
                        $consulta->execute();
                        //resgata os dados na tabela
                       
                            while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
                                // if(count($dados)){

                                $pid 	            = $dados->id;
                                $nome_produto       = $dados->nome_produto;
                                $valorUnitario       = $dados->valorUnitario;
                                $foto                = $dados->foto;
                                $imagem              = explode(",", $foto);
                                $valorUnitario       = number_format($valorUnitario, 2, ",", ".");

                         
                                ?>
                                <div class='col-md-4'>
                                    <div class='product-item'>
                                        <a href='pages/produto/<?=$pid?>'><img align='right' src='../fotos/produtos/<?=$imagem[0]?>' class='img' alt='<?=$nome_produto?>' title='Produto: <?=$nome_produto?>'></a>
                                        <div class='down-content'>
                                            <a href='pages/produto/<?=$pid?>'><h4><?=$nome_produto?></h4></a>
                                            <h6>R$ <?=$valorUnitario?></h6>
                                            <a href='pages/produto/<?=$pid?>' class='btn btn-primary'>Detalhes</a><br>           
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    
                                




                            // foreach ($resultado as $res) {
    
                            //     $res = explode(",",$res);
                            //     $foto = $res[0];
                                
                            // $msg .=" <div class='col-md-4'>";
                            // $msg .="    <div class='product-item'>";
                            // $msg .="        <a href='pages/produto/".$res['pid']."'><img align='right' src='../fotos/produtos/".$foto."' class='img' alt='".$res['nome_produto']."' title='Produto: ".$res['nome_produto']."'></a>";
                            // $msg .="        <div class='down-content'>";
                            // $msg .="             <a href='pages/produto/".$res['pid']."'><h4>".$res['nome_produto']."</h4></a>";
                            // $msg .="            <h6>R$ ".$res['valorUnitario']."</h6>";
                            // $msg .="            <a href='pages/produto/".$res['pid']."' class='btn btn-primary'>Detalhes</a><br>";
                            // $msg .="        </div>";
                            // $msg .="     </div>";
                            // $msg .=" </div>";


    // $msg .="                <tr>";
    // $msg .="                    <td>".$res['id']."</td>";
    // $msg .="                    <td>".$res['primeiro_nome']."</td>";
    // $msg .="                    <td>".$res['email']."</td>";
    // $msg .="                </tr>";

                              
                        
                            $msg = "";
                            $msg .="Nenhum resultado foi encontrado...";
                        }
    // $msg .="    </tbody>";
    // $msg .="</table>";
    //retorna a msg concatenada
    echo $msg;
endif;

?>
			</div>
        </div>
    </div>
</div>

<style>
	.dropdown-item {
		color: white;
	}
</style>