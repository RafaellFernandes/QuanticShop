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
						<a href="cadastro/usuario" class="btn btn-primary">Cadastrar Novo</a>
					</div>
					<h3>LISTA</h3>
					<h5 style="color: green;"><strong>Usuários Ativos</strong></h5>
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
                            $sql = "SELECT * FROM usuario";
                            $consulta = $pdo->prepare($sql);
                            $consulta->execute();

                            while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
                                //separar os dados
                                $id                     = $dados->id;
                                $primeiro_nome       	= $dados->primeiro_nome;
                                $sobrenome              = $dados->sobrenome;
                                $email                  = $dados->email;
                                $foto                   = $dados->foto;
                                $login                  = $dados->login;
                                $cidade 	            = $dados->cidade;
                                $estado                 = $dados->estado;
                                $imagem                 = "../fotos/".$foto."p.jpg";
                                $ativo                  = $dados->ativo;

                                //mostrar na tela
                                if ($ativo == "1"){
                                    echo '<tr>
                                            <td><img src="'.$imagem.'" alt="'.$primeiro_nome.'" width="48" height="48" class="rounded-circle mr-2"></td>
                                            <td>'.$primeiro_nome.' '.$sobrenome.'</td>
                                            <td>'.$email.'</td>
                                            <td>'.$login.'</td>
                                            <td>'.$cidade.' - '.$estado.'</td>
                                            <td class="table-action text-center">
                                                <a href="cadastro/usuario/'.$id.'" alt="Editar" title="Editar">
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
   function inativar(id){
        if (confirm("Deseja mesmo inativar? ")) {
            //ir para inativação
            location.href="inativos/usuario/"+id;
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