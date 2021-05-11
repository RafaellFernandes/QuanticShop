<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["quanticshop"]["id"] ) ){
    exit;
  }
  //mostrar erros
	// ini_set('display_errors',1);
	// ini_set('display_startup_erros',1);
    // error_reporting(E_ALL);
    

//se nao existe o id
if ( !isset ( $id ) ) $id = "";

//iniciar as variaveis
$nome_produto = $codigo = $valor_unitario = $descricao = $espec_tecnica = $foto = $ativo = $departamento_id = $marca_id = "";

  //verificar se existe um id
  if ( !empty ( $id ) ) {

    include "../admin/validacao/functions.php";
   
  	//selecionar os dados do banco para poder editar
      $sql = "SELECT p.*,d.*,m.* FROM produto p
                left join departamento d on (d.id = p.departamento_id)
                left join marca m on(m.id = p.marca_id)
                WHERE p.id = :id LIMIT 1";
      $consulta = $pdo->prepare($sql);
      $consulta->bindParam(":id", $id);
      $consulta->execute();
      
  	$dados  = $consulta->fetch(PDO::FETCH_OBJ);

  	//separar os dados
    $id         	          = $dados->id;
    $nome_produto 	          = $dados->nome_produto; 
    $valor_unitario           = $dados->valor_unitario;
    $valor_unitario           = number_format($valor_unitario,2,",",".");
    $descricao                = $dados->descricao;
    $codigo                   = $dados->codigo;
    $departamento_id          = $dados->departamento_id;
    $nome_dept                = $dados->nome_dept;
    $marca_id                 = $dados->marca_id;
    $nome_marca               = $dados->nome_marca;
    $foto                     = $dados->foto;
  }

?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
                        
<div class="container-fluid p-0">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
                <div class="float-end">
					<a href="cadastro/marca" class="btn btn-primary">Cadastrar Marca</a> 
					<a href="cadastro/departamento" class="btn btn-primary">Cadastrar Departamento</a>
				</div>
				<h4>Cadastro</h4>
				<h6 class="card-subtitle text-muted">Produto</h6>
				
			</div>
			<div class="card-body">
                <form method="post" name="formCadastro"  action="salvar/produto" data_parsley_validate enctype="multipart/form-data">
                    <p> Todos os campos são obrigatórios </p>
                    <div class="row">
                        <div class="col-12 col-md-2"  style="display: none;">
                            <label for="id">ID</label>
                            <input type="text" name="id" id="id" readonly class="form-control" value="<?=$id;?>">
                        </div>
                        <div class="col-12 col-md-9">
                            <label for="nome_produto">Nome do Produto</label>
                            <input type="text" name="nome_produto" id="nome_produto" class="form-control" require data-parsley-required-message="Por favor, preencha este campo" 
                            value="<?=$nome_produto;?>" placeholder="Nome do Produto">
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="codigo">Codigo</label>
                            <input type="text" name="codigo" id="codigo" class="form-control" value="<?=$codigo;?>" placeholder="Código do Produto">
                        </div>
                        <div class="col-12 col-md-4 mt-2">
                            <label for="marca_id">Marca</label>
                            <select name="marca_id" id="marca_id" class="form-control" required data-parsley-required-message="selecione uma opção">
                                <option value="<?=$marca_id;?>">Selecione a Marca</option>
                                    <?php
                                        $sql = "SELECT * FROM marca ORDER BY id";
                                        $consulta = $pdo->prepare($sql);
                                        $consulta->execute();

                                        while ($d = $consulta->fetch(PDO::FETCH_OBJ) ) {
                                        //separar os dados
                                            $id   = $d->id;
                                            $nome_marca = $d->nome_marca;
                                            echo '<option value="'.$id.'">'.$nome_marca.'</option>';
                                        }                    
                                    ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-4 mt-2">
                            <label for="departamento_id">Departamento</label>
                            <select name="departamento_id" id="departamento_id" class="form-control" required data-parsley-required-message="Selecione um Departamento">
                                <option value="<?=$departamento_id;?>">Selecione o Departamento</option>
                                    <?php
                                        $sql = "SELECT id, nome_dept FROM departamento ORDER BY nome_dept";
                                        $consulta = $pdo->prepare($sql);
                                        $consulta->execute();

                                        while ($d = $consulta->fetch(PDO::FETCH_OBJ) ) {
                                        //separar os dados
                                            $id        = $d->id;
                                            $nome_dept  = $d->nome_dept;
                                            echo '<option value="'.$id.'">'.$nome_dept.'</option>';
                                        }
                                    ?>
                            </select>
                        </div>
                        
                        <div class="col-12 col-md-2 mt-2">
                        <label for="ativo">Ativo</label>
                        <select name="ativo" id="ativo" class="form-control" 
                        required data-parsley-required-message="Selecione uma opção">
                            <option value="">Selecione</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
					    </select>
                        </div>
                        <div class="col-12 col-md-10 mt-2">
                            <?php 
                                //variavel r requerido se ID está vazio
                                $r = 'required data-parsley-required-message="Selecione uma foto"';     
                                if(!empty($id)) $r = '';
                            ?>
                            <label for="foto">Foto(s) do Produto (.jpg)</label>
                            <input type="file" name="foto" id="foto" class="form-control" accept=".jpg"<?=$r;?> multiple>
                            <input type="hidden" name="foto" value="<?=$foto;?>" class="form-control" multiple >     
                                <?php
                                    if( !empty($foto)){
                                        $foto = "<img src='../fotos/".$foto."p.jpg' alt='".$nome_produto."' width='150px'>";
                                    } else{
                                        $foto = "";
                                    }
                                ?>
                            <div><?php echo $foto ;?></div>
                        </div>
                        
                        <div class="col-12 col-md-12 mt-2">
                            <label for="descricao">Descrição</label>
                            <textarea name="descricao" id="summernote" required data-parsley-required-message="Preencha este campo" 
                            class="form-control" rows="4" ><?=$descricao;?></textarea>
                        </div>
                        <div class="col-12 col-md-12 mt-2">
                            <label for="espec_tecnica">Especificação Tecnica</label>
                            <textarea name="espec_tecnica" id="summernote2" required data-parsley-required-message="Preencha este campo" 
                            class="form-control" rows="3" ><?=$espec_tecnica;?></textarea>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-sm-4 mt-4">
                            <button type="submit" class="btn btn-success margin mt-3">
                                Salvar Dados
                            </button>
                        </div>
                        <div class="col-sm">
                            <div class="float-right mt-3 ">
                                <a href="listagem/produto" class="btn btn-primary">Listar Registros</a> 
                            </div> 
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>$("#valor_unitario").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});</script>

<!-- <script type="text/javascript">
    $(document).ready(function() {
        $("#qtd_estoque").mask("999999");
    });
</script> -->

<script>
    $('#summernote').summernote({
        placeholder: 'Descrição do Produto',
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['codeview', 'help']]
        ]
    });
</script>
<script>
    $('#summernote2').summernote({
        placeholder: 'Especificações Tecnicas do Produto',
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['codeview', 'help']]
        ]
    });
</script>
<script type="text/javascript">
$(document).ready(function(){ 
	$("#ativo").val("<?=$ativo?>");
	});
</script>


