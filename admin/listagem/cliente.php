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
?>
<div class="container-fluid p-0">
	<div class="row">
		<div class="col-12 col-xl-12">
			<div class="card">
				<div class="card-header">
					<div class="float-end mt-2">
						<a href="cadastro/clienteJ" class="btn btn-primary">Cad. Pessoa Juridica</a>
                        <a href="cadastro/clienteF" class="btn btn-primary">Cad. Pessoa Fisica</a>
					</div>
					<h4>LISTA</h4>
					<h6 style="color: green;"><strong>Clientes | Pessoas Fisicas e/ou Juridicas</strong></h6>
				</div>
                <fieldset>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-10 ">
                                <label class="form-check">
                                    <input name="optradio" type="radio" class="form-check-input" value="fisica" onclick="pessoa(this.value);">
                                    <span class="form-check-label">Pessoa Fisica</span>
                                </label>
                                <label class="form-check">
                                    <input name="optradio" type="radio" class="form-check-input" value="juridica" onclick="pessoa(this.value);">
                                    <span class="form-check-label">Pessoa Juridica</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <!-- Listagem de Pessoa Fisica -->
                <div id="fisica" style="display:none;">
                    <table class="table table-bordered table-hover table-striped" id="tabela">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nome</th>
                                <th>DT Nascimento</th>
                                <th>Cidade</th>
                                <th>Email</th>
                                <th>Celular</th>
                                <th>Ações</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT id, primeiro_nome, sobrenome, cpf, date_format(data_nascimento, '%d/%m/%Y') data_nascimento, pessoaFJ, email, cidade, estado, foto, celular, ativo 
                                        FROM cliente
                                        WHERE pessoaFJ = 'F' AND ativo = 1
                                        ORDER BY primeiro_nome";

                                $consulta = $pdo->prepare($sql);
                                $consulta->execute();
                                while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
                                    //separar os dados
                                    $pessoaFJ  = $dados->pessoaFJ; 
                                    $ativo     = $dados->ativo;
                                    $foto      = "../fotos/{$dados->foto}p.jpg"; 
                                    $fotog     = "../fotos/{$dados->foto}g.jpg"; 
                            ?>
                                <tr>
                                    <td>
                                        <a href="<?=$fotog?>" data-lightbox="foto" title="<?=$dados->primeiro_nome?>">
                                            <img src="<?=$foto?>" alt="<?=$dados->primeiro_nome?>" width="70px">
                                        </a>
                                    </td>                                   
                                    <td><?=$dados->primeiro_nome?> <?=$dados->sobrenome?></td>
                                    <td><?=$dados->data_nascimento?></td>
                                    <td><?=$dados->cidade?>-<?=$dados->estado?></td>
                                    <td><?=$dados->email?></td>
                                    <td><?=$dados->celular?></td>
                                    <td class="table-action text-center">
                                        <a href="cadastro/clienteF/<?=$dados->id?>" alt="Editar" title="Editar">
                                            <i class="align-middle"  data-feather="edit-2"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php  
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                 <!-- Fim da Listagem de Pessoa Fisica -->

                <!-- Listagem de Pessoa Juridica -->
                <div id="juridica" style="display:none;">
                    <table class="table table-bordered table-hover table-striped" id="tabela2">
                        <thead>
                            <tr>
                                <th>Razão Social</th>
                                <th>CNPJ</th>
                                <th>Cidade</th>
                                <th width="10%">Email<br> Site</th>
                                <th>Telefone</th>
                                <th>Ações</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT id, razaoSocial, cnpj, email, cidade, estado, pessoaFJ, telefone, siteClienteJuridico, ativo 
                                        FROM cliente
                                        WHERE pessoaFJ = 'J' AND ativo = 1
                                        ORDER BY id";

                                $consulta = $pdo->prepare($sql);
                                $consulta->execute();

                                while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
                                    //separar os dados
                                    $id 	                = $dados->id;
                                    $pessoaFJ               = $dados->pessoaFJ;
                                    $razaoSocial 	        = $dados->razaoSocial;
                                    $cnpj               	= $dados->cnpj;
                                    $email 	                = $dados->email;
                                    $telefone 	            = $dados->telefone;
                                    $cidade 	            = $dados->cidade;
                                    $estado                 = $dados->estado;
                                    $siteClienteJuridico    = $dados->siteClienteJuridico;
                                    $ativo                  = $dados->ativo;

                                    echo '<tr>
                                            <td>'.$razaoSocial.'</td>
                                            <td>'.$cnpj.'</td>
                                            <td>'.$cidade.' - '.$estado.'</td>
                                            <td>'.$email.'<br>'.$siteClienteJuridico.'</td>
                                            <td>'.$telefone.'</td>
                                            <td class="table-action text-center">
                                                <a href="cadastro/clienteJ/'.$id.'" alt="Editar" title="Editar">
                                                    <i class="align-middle"  data-feather="edit-2"></i>
                                                </a>
                                            </td>
                                        </tr> ';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- Fim da Listagem de Pessoa Juridica -->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    // function excluir(id){
    //     if ( confirm("deseja realmente excluir este registro?") ){
    //         location.href='excluir/cliente/'+id;
    //     }
    // }

    //adicionar o dataTable1 Para a Lista de Pessoa Fisica 
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

    //adicionar o dataTable2 para a Lista de Pessoas Juridicas
    $(document).ready(function(){
        $('#tabela2').DataTable({
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
<script>
    function pessoa(tipo){
      	if(tipo=="fisica"){
      		document.getElementById("fisica").style.display = "inline";
      		document.getElementById("juridica").style.display = "none";
      	}else if(tipo=="juridica"){
      		document.getElementById("fisica").style.display = "none";
      		document.getElementById("juridica").style.display = "inline";
      	}
    }
</script>