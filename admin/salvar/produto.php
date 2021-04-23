
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

   
    
    foreach ($_POST as $key => $value){
        $$key = trim($value);
    }

    if( empty($Nome) ){
        echo "<script>alert('Preencha o Nome');history.back();</script>";
    } else if( empty($departamento_id) ){
        echo "<script>alert('Selecione o Departamento');history.back();</script>";
    }  else if( empty($ValorProduto) ){
        echo "<script>alert('Preencha o valor do Produto');history.back();</script>";
    } else if( empty($Marca_id) ){
        echo "<script>alert('Selecione a Marca do produto');history.back();</script>";
    } else if( empty($Descricao) ){
        echo "<script>alert('Preencha a Descrição');history.back();</script>";
    } else if( empty($qtd_estoque) ){
        echo "<script>alert('Preencha a Quantidade em Estoque');history.back();</script>";
    } else if( empty($_FILES) ){
        echo "<script>alert('Selecione a Foto do Produto');history.back();</script>";
    }
    
    //iniciar uma transacao
    
    $pdo->beginTransaction();
    
    $ValorProduto = formatarValor($ValorProduto);
    
    $arquivo = time()."-".$_SESSION["bancotcc"]["id"];
    
    if(empty($id)){
        //inserir
        $sql= "INSERT INTO produto (Nome, ValorProduto, Descricao, FotoProduto, qtd_estoque, departamento_id, Marca_id) 
        values(:Nome, :ValorProduto, :Descricao, :FotoProduto, :qtd_estoque, :departamento_id, :Marca_id)";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':Nome',$Nome);
        $consulta->bindParam(':ValorProduto',$ValorProduto);
        $consulta->bindParam(':Descricao',$Descricao);
        $consulta->bindParam(':FotoProduto',$arquivo);
        $consulta->bindParam(':qtd_estoque',$qtd_estoque);
        $consulta->bindParam(':departamento_id',$departamento_id);
        $consulta->bindParam(':Marca_id',$Marca_id); 
        
    } else{
        //qual arquivo sera gravado
        if(!empty( $_FILES["FotoProduto"]["name"])){
            $FotoProduto = $arquivo;
        }
        //update
        $sql= "UPDATE produto SET Nome = :Nome, ValorProduto = :ValorProduto, 
        Descricao = :Descricao, FotoProduto = :FotoProduto,
        qtd_estoque = :qtd_estoque, departamento_id = :departamento_id,
         Marca_id = :Marca_id WHERE id = :id";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':Nome',$Nome);
        $consulta->bindParam(':ValorProduto',$ValorProduto);
        $consulta->bindParam(':Descricao',$Descricao);
        $consulta->bindParam(':FotoProduto',$FotoProduto);
        $consulta->bindParam(':qtd_estoque',$qtd_estoque);
        $consulta->bindParam(':departamento_id',$departamento_id);
        $consulta->bindParam(':Marca_id',$Marca_id);
        $consulta->bindParam(':id',$id);
    }
    
    if($consulta->execute()){
        //verificar se o arquivo nao está sendo enviado 
        if( empty($_FILES["FotoProduto"]["type"]) and (!empty($id)) ){
            //a FotoProduto deve estar vazia e ID nao estiver vazio
            //gravar no banco 
            $pdo->commit();
            echo "<script>alert('Produto Salvo!');location.href='listar/produto';</script>";
            
        }
        //veririfcar tipo imagem
        if($_FILES["FotoProduto"]["type"]  !=  "image/jpeg"){
            echo "<script>alert('Seleciona uma imagem Jpeg');history.back();</script>";
            exit;
        }
        if ( move_uploaded_file($_FILES["FotoProduto"]["tmp_name"], "../fotos/".$_FILES["FotoProduto"]["name"])){
            
            $pastaFotos = "../fotos/";
            $nome = $arquivo;
            $imagem = $_FILES["FotoProduto"]["name"];
            redimensionarImagem($pastaFotos,$imagem,$nome);
            
            //gravar no banco - se tudo deu certo
            $pdo->commit();
            echo "<script>alert('Produto Salvo com sucesso!');location.href='listar/produto';</script>";
        }
        
        //erro ao gravar
        echo "<script>alert('Erro ao gravar no servidor');history.back();</script>";
        exit;
    }
    
    //echo consulta->errorInfo()[2];
    exit;
}

echo '<p class="alert alert-danger>Requisição inválida</p>"';