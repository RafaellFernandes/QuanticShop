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
						<a href="listagem/fornecedor" class="btn btn-primary">Lista de Fornecedores Ativos</a>
					</div>
					<h4>LISTA</h4>
					<h6 style="color: red;"><strong>Fornecedores Inativos</strong></h6>
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
                            $sql = "SELECT id, razaoSocial, cnpj, telefone, cidade, estado, siteFornecedor, email, ativo FROM fornecedor";
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
                                $ativo                    = $dados->ativo;
                                $siteFornecedor           = $dados->siteFornecedor;
                                $email                    = $dados->email;
                                                
                                //mostrar na tela
                                if ( $ativo == "0" ) {
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
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
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