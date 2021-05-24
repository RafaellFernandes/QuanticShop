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
                                $foto       = "../fotos/{$dados->foto}p.jpg";
                                $fotog        = "../fotos/{$dados->foto}g.jpg"; 
                                $ativo        = $dados->ativo;

                                //mostrar na tela
                                if ($ativo == "1"){
                                    ?>
                                        <tr>
                                            <td>
                                                <a href="<?=$fotog?>" data-lightbox="foto" title="<?=$dados->primeiro_nome?>">
                                                    <img src="<?=$foto?>" alt="<?=$dados->primeiro_nome?>" width="70px">
                                                </a>
                                            </td>    
                                            <td><?=$dados->primeiro_nome?> <?=$dados->sobrenome?></td>              
                                            <td><?=$dados->email?></td>
                                            <td><?=$dados->login?></td>
                                            <td><?=$dados->cidade?>-<?=$dados->estado?></td>
                                            <td class="table-action text-center">
                                                <a href="cadastro/usuario/<?=$dados->id?>" alt="Editar" title="Editar">
                                                    <i class="align-middle"  data-feather="edit-2"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
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