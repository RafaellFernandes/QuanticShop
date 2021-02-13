<?php
    //verificar se não está logado
    if ( !isset ( $_SESSION["bancotcc"]["id"] ) ){
        exit;
    }
?>
<div class="container-fluid p-0">
	<div class="row">
		<div class="col-12 col-xl-12">
			<div class="card">
				<div class="card-header">
					<div class="float-right">
						<a href="cadastro/usuario" class="btn btn-info">Cadastrar Novo</a>
					</div>
					<h3>Lista</h3>
					<h5 class="card-subtitle text-muted">Usuários</h5>
				</div>
				<table class="table table-bordered table-hover table-striped" id="tabela">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Login</th>
                            <th>Cidade-UF</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            //buscar os usuarios
                            $sql = "SELECT * FROM usuario where Ativo = 'S'";
                            $consulta = $pdo->prepare($sql);
                            $consulta->execute();

                            while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
                                //separar os dados
                                $id             = $dados->id;
                                $Nome       	= $dados->Nome;
                                $Email          = $dados->Email;
                                $Foto           = $dados->Foto;
                                $Login          = $dados->Login;
                                $nome_cidade 	= $dados->nome_cidade;
                                $estado         = $dados->estado;
                                $imagem         = "../fotos/".$Foto."p.jpg";

                                //mostrar na tela
                                echo '<tr>
                                        <td><img src="'.$imagem.'" alt="'.$Nome.'" width="48" height="48" class="rounded-circle mr-2"></td>
                                        <td>'.$Nome.'</td>
                                        <td>'.$Email.'</td>
                                        <td>'.$Login.'</td>
                                        <td>'.$nome_cidade.' - '.$estado.'</td>
                                        <td class="table-action text-center">
                                            <a href="cadastro/usuario/'.$id.'" alt="Editar" title="Editar">
                                                <i class="align-middle"  data-feather="edit-2"></i>
                                            </a>
                                            <a href="javascript:excluir('.$id.')" alt="Excluir" title="Excluir">
                                                <i class="align-middle" data-feather="trash"></i>
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
    function excluir(id){
        if (confirm("Deseja mesmo excluir? ")) {
            //ir para exclusao
            location.href="excluir/usuario/"+id;
        }
    }
    
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