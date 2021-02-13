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
						<a href="cadastro/cliente" class="btn btn-info">Cadastrar Novo</a>
					</div>
					<h4>Lista</h4>
					<h6 class="card-subtitle text-muted">Clientes | Pessoas Fisicas e/ou Juridicas</h6>
				</div>
				<table class="table table-bordered table-hover table-striped" id="tabela">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Nome</th>
                            <th>Nascimento</th>
                            <th>Cidade</th>
                            <th>Email</th>
                            <th>Celular</th>
                            <th>Ações</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT id, Nome, Cpf, date_format(DataNascimento, '%d/%m/%Y') DataNascimento, Email, nome_cidade, estado, Foto, Celular FROM cliente
                            ORDER BY Nome";
                            $consulta = $pdo->prepare($sql);
                            $consulta->execute();
                            while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
                                //separar os dados
                                $id 	            = $dados->id;
                                $Foto           	= $dados->Foto;
                                $Nome 	            = $dados->Nome;
                                $DataNascimento 	= $dados->DataNascimento;
                                $Email 	            = $dados->Email;
                                $Celular 	        = $dados->Celular;
                                $nome_cidade 	    = $dados->nome_cidade;
                                $estado             = $dados->estado;

                                echo '<tr>
                                        <td><img src="../fotos/'.$Foto.'p.jpg" alt="'.$Nome.'" width="48" height="48" class="rounded-circle mr-2"></td>
                                        <td>'.$Nome.'</td>
                                        <td>'.$DataNascimento.'</td>
                                        <td>'.$nome_cidade.' - '.$estado.'</td>
                                        <td>'.$Email.'</td>
                                        <td>'.$Celular.'</td>
                                        <td class="table-action text-center">
                                            <a href="cadastro/cliente/'.$id.'" alt="Editar" title="Editar">
                                                <i class="align-middle"  data-feather="edit-2"></i>
                                            </a>
                                            <a href="javascript:excluir('.$id.')" alt="Excluir" title="Excluir">
                                                <i class="align-middle" data-feather="trash"></i>
                                            </a>
                                        </td>
                                    </tr> ';
                                }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function excluir(id){
        if ( confirm("deseja realmente excluir este registro?") ){
            location.href='excluir/cliente/'+id;
        }
    }

    //adicionar o dataTable 
    $(document).ready(function(){
        $('#tabela').DataTable({
            "language": {
                "lengthMenu": "Mostrando _MENU_ Registros por Pagina",
                "zeroRecords": "Nenhum Registro Encontrado",
                "info": "Mostrando Paginas de  _PAGE_ de _PAGES_",
                "infoEmpty": "No records available",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "Procurar:",
                "zeroRecords":  "Nenhum registro encontrado",
                "paginate": {
                        "first":      "Primeiro",
                        "last":       "Último",
                        "next":       "Próximo",
                        "previous":   "Anterior"
                }
            }
        } );
    })
</script>