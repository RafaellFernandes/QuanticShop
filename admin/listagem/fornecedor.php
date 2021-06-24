<?php
    if (!isset($_SESSION["quanticshop"]["id"])) {
        $titulo = "Erro";
        $mensagem = "Usuário Não Logado";
        $icone = "error";
        mensagem($titulo, $mensagem, $icone);
        exit;
    }

    if ($_SESSION["quanticshop"]["nivelAcesso"] != "admin") {
        echo "<script>location.href='http://localhost//QuanticShop/erros/401.php'</script>";
        exit;
    }

    //mostrar erros
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
    error_reporting(E_ALL);
    
?>
<div class="container-fluid p-0">
	<div class="row">
		<div class="col-12 col-xl-12">
			<div class="card">
				<div class="card-header">
					<div class="float-end">
						<a href="cadastro/fornecedor" class="btn btn-primary">Cadastrar Novo</a>
					</div>
					<h4>LISTA</h4>
					<h6 style="color: green;"><strong>Fornecedores Ativos</strong></h6>
				</div>
				<table class="table table-bordered table-hover table-striped " id="tabela">
                    <thead>
                        <tr>      
                            <th>Nome</th>
                            <th>CNPJ</th>
                            <th>Telefone</th>
                            <th>Site e Email</th>
                            <th>Cidade</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT id, razaoSocial, cnpj, telefone, siteFornecedor, ativo, email, cidade, estado 
                                    FROM fornecedor
                                    WHERE ativo = 1";

                            $consulta = $pdo->prepare($sql);
                            $consulta->execute();

                            while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
                                //separar os dados
                                $id         	          = $dados->id;
                                $razaoSocial 	          = $dados->razaoSocial; 
                                $cnpj                     = $dados->cnpj;               
                                $telefone                 = $dados->telefone;
                                $cidade 	              = $dados->cidade;
                                $estado                   = $dados->estado;
                                $siteFornecedor           = $dados->siteFornecedor;
                                $email                    = $dados->email;
                                $ativo                    = $dados->ativo;
                                              
                                //mostrar na tela
                                echo '<tr>
                                        <td>'.$razaoSocial.'</td>
                                        <td>'.$cnpj.'</td>
                                        <td>'.$telefone.'</td>
                                        <td>'.$siteFornecedor.'<br>'.$email.'</td>
                                        <td>'.$cidade.' - '.$estado.'</td>
                                        <td class="table-action text-center">
                                            <a href="cadastro/fornecedor/'.$id.'" alt="Editar" title="Editar">
                                                <i class="align-middle"  data-feather="edit-2"></i>
                                            </a>
                                            
                                        </td>
                                    </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>

    // function excluir(id){
    //     if (confirm("Deseja mesmo excluir? ")) {
    //         //ir para exclusao
    //         location.href="excluir/fornecedor/"+id;
    //     }
    // }

    $(document).ready( function () {
        $('#tabela').DataTable({
            language: {
                "emptyTable":     "Nenhum registro",
                "info":           "Mostrando de _START_ a _END_ de _TOTAL_ registros",
                "lengthMenu":     "Mostrar _MENU_ registros",
                "loadingRecords": "Carregando...",
                "processing":     "Processando...",
                "search":         "Procurar:",
                "zeroRecords":    "Nenhum registro encontrado",
                "paginate": {
                    "first":      "Primeiro",
                    "last":       "Último",
                    "next":       "Próximo",
                    "previous":   "Anterior"
                },
            }
        });
    } );
</script>