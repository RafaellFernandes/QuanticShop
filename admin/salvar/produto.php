
<?php
// https://youtu.be/57bzZuvp6OQ -> Upload de "vários" arquivos e salvando no Banco de Dados (DE UMA SÓ VEZ) com PHP
// https://youtu.be/TxY6loI4dHw -> Upload de Múltiplos arquivos (Salvando na Pasta) - ...continuação




  //verificar se não está logado
  if ( !isset ( $_SESSION["quanticshop"]["id"] ) ){
    exit;
  }

  //mostrar erros
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
    error_reporting(E_ALL);

 //verificar se existem dados no POST
 if ( $_POST ) {
    include "../admin/validacao/functions.php";
    include "../admin/config/conexao.php";

    //recuperar variaveis
    $id = $nome_produto = $codigo = $valor_unitario = $descricao = $espec_tecnica = $foto = $ativo = $departamento_id = $marca_id = "";

    // var_dump($_POST);

    foreach ($_POST as $key => $value) {
        //guardar as variaveis
        $$key = trim ( $value );
    }

    if( empty($nome_produto) ){
        echo "<script>alert('Preencha o Nome do Produto');history.back();</script>";
    } else if( empty($departamento_id) ){
        echo "<script>alert('Selecione o Departamento');history.back();</script>";
    }  else if( empty($valor_unitario) ){
        echo "<script>alert('Preencha o valor do Produto');history.back();</script>";
    } else if( empty($marca_id) ){
        echo "<script>alert('Selecione a Marca do produto');history.back();</script>";
    } else if( empty($descricao) ){
        echo "<script>alert('Preencha a Descrição');history.back();</script>";
    } else if( empty($espec_tecnica) ){
        echo "<script>alert('Preencha a especificação tecnica');history.back();</script>";
    }  else if( empty($ativo) ){
        echo "<script>alert('Preencha o ativo');history.back();</script>";   
    }
    //iniciar uma transacao
    
    $pdo->beginTransaction();
    
    $valor_unitario = formatarValor($valor_unitario);
    
    $arquivo = time()."-".$_SESSION["quanticshop"]["id"];
    
    if(empty($id)){
        //inserir
       
        $sql= "INSERT INTO produto (nome_produto, codigo,  valor_unitario, descricao, espec_tecnica, foto,  departamento_id, marca_id, ativo) 
        values(:nome_produto, :codigo, :valor_unitario, :descricao, :espec_tecnica, :foto, :departamento_id, :marca_id, :ativo)";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':nome_produto',$nome_produto);
        $consulta->bindParam(':codigo',$codigo);
        $consulta->bindParam(':valor_unitario',$valor_unitario);
        $consulta->bindParam(':descricao',$descricao);
        $consulta->bindParam(':espec_tecnica',$espec_tecnica);
        $consulta->bindParam(':foto',$arquivo);
        $consulta->bindParam(':ativo',$ativo);
        $consulta->bindParam(':departamento_id',$departamento_id);
        $consulta->bindParam(':marca_id',$marca_id); 
        
    } else{
        //qual arquivo sera gravado
        if(!empty( $_FILES["foto"]["name"])){
            $foto = $arquivo;
        }
        //update
        $sql= "UPDATE produto SET nome_produto = :nome_produto, codigo = :codigo, valor_unitario = :valor_unitario, 
        descricao = :descricao, espec_tecnica = :espec_tecnica, foto = :foto, ativo = :ativo, departamento_id = :departamento_id,
        marca_id = :marca_id WHERE id = :id";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':nome_produto',$nome_produto);
        $consulta->bindParam(':codigo',$codigo);
        $consulta->bindParam(':valor_unitario',$valor_unitario);
        $consulta->bindParam(':descricao',$descricao);
        $consulta->bindParam(':espec_tecnica',$espec_tecnica);
        $consulta->bindParam(':foto',$arquivo);
        $consulta->bindParam(':ativo',$ativo);
        $consulta->bindParam(':departamento_id',$departamento_id);
        $consulta->bindParam(':marca_id',$marca_id); 
        $consulta->bindParam(':id',$id);
}
    
    if($consulta->execute()){
        //verificar se o arquivo nao está sendo enviado 
        if( empty($_FILES["foto"]["type"]) and (!empty($id)) ){
            //a foto deve estar vazia e ID nao estiver vazio
            //gravar no banco 
            $pdo->commit();
            echo "<script>alert('Produto Salvo!');location.href='listagem/produto';</script>";
            
        }
        //verificar tipo imagem
        if($_FILES["foto"]["type"]  !=  "image/jpeg"){
            echo "<script>alert('Seleciona uma imagem Jpeg');history.back();</script>";
            exit;
        }
        
        // $foto = isset($_FILES['foto']) ? $_FILES['foto'] : FALSE;
        // $diretorio = "../fotos/".$_FILES["foto"]["name"];

        // for ($controle = 0; $controle < count($foto['name']); $controle++){

        //     $destino = $diretorio."/".$foto['name'][$controle];
            if ( move_uploaded_file($_FILES["foto"]["tmp_name"], "../fotos/".$_FILES["foto"]["name"])){
                
                $pastaFotos = "../fotos/";
                $nome = $arquivo;
                $imagem = $_FILES["foto"]["name"];
                redimensionarImagem($pastaFotos,$imagem,$nome);
                
                //gravar no banco - se tudo deu certo
                $pdo->commit();
                echo "<script>alert('Produto Salvo com sucesso!');location.href='listagem/produto';</script>";
            }
        // }
        //erro ao gravar
        echo "<script>alert('Erro ao gravar no servidor');history.back();</script>";
        exit;
    }
    
    //echo consulta->errorInfo()[2];
    exit;
}

echo '<p class="alert alert-danger>Requisição inválida</p>"';