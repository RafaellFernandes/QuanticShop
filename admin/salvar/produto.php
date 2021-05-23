<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["quanticshop"]["id"] ) )exit;

  //mostrar erros
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
    error_reporting(E_ALL);

 //verificar se existem dados no POST
 if ( $_POST ) {

    include "validacao/functions.php";
    include "config/conexao.php";
    include "validacao/imagem.php";

    //recuperar variaveis
    // $id = $nome_produto = $codigo = $valor_unitario = $descricao = $espec_tecnica = $foto = $ativo = $departamento_id = $marca_id = "";

    foreach ($_POST as $key => $value) {
        //guardar as variaveis
        $$key = trim ( $value );
    }

    if( empty($nome_produto) ){
        echo "<>alert('Preencha o Nome do Produto');history.back();</>";
    } else if( empty($departamento_id) ){
        echo "<>alert('Selecione o Departamento');history.back();</>";
    } else if( empty($marca_id) ){
        echo "<>alert('Selecione a Marca do produto');history.back();</>";
    } else if( empty($descricao) ){
        echo "<>alert('Preencha a Descrição');history.back();</>";
    } else if( empty($espec_tecnica) ){
        echo "<>alert('Preencha a especificação tecnica');history.back();</>";
    } 
    
//programação para copiar uma imagem
//no insert envio da foto é obrigatório
//no update só se for selecionada uma nova imagem
//se o id estiver em branco e o imagem tbém - erro

    if ( ( empty ( $id ) ) and ( empty ( $_FILES['foto']['name'] ) ) ) {
        mensagem("Erro ao enviar imagem", 
            "Selecione um arquivo JPG válido", 
            "error");
    } 

    //se existir imagem - copia para o servidor
    if ( !empty ( $_FILES['foto']['name'] ) ) {
        //calculo para saber quantos mb tem o arquivo
        $tamanho = $_FILES['foto']['size'];
        $t = 8 * 1024 * 1024; //byte - kbyte - megabyte

        $foto = time();
        $usuario = $_SESSION['quanticshop']['id'];

        //definir um nome para a imagem
        $foto = "produto_{$foto}_{$usuario}";

        //validar se é jpg
        if ( $_FILES['foto']['type'] != 'image/jpeg' ) {
            mensagem("Erro ao enviar imagem", 
            "O arquivo enviado não é um JPG válido, selecione um arquivo JPG", 
            "error");
        } else if ( $tamanho > $t ) {
            mensagem("Erro ao enviar imagem", 
            "O arquivo é muito grande e não pode ser enviado. Tente arquivos menores que 8 MB", 
            "error");
        } else if ( !copy ( $_FILES['foto']['tmp_name'], '../fotos/'.$_FILES['foto']['name'] ) ) {
            mensagem("Erro ao enviar imagem", 
            "Não foi possível copiar o arquivo para o servidor", 
            "error");
        }

            //redimensionar a imagem
            $pastaFotos = '../fotos/';
            loadImg($pastaFotos.$_FILES['foto']['name'], 
                    $foto, 
                    $pastaFotos);

    } //fim da verificação da foto

    //iniciar uma transacao
    // $pdo->beginTransaction();
    
    $valor_unitario = formatarValor($valor_unitario);
    
    // $arquivo = time()."-".$_SESSION["quanticshop"]["id"];
    
    if(empty($id)){
        //inserir
       
        $sql= "INSERT INTO produto (nome_produto, codigo, descricao, valor_unitario, espec_tecnica, foto,  departamento_id, marca_id, ativo) 
        values(:nome_produto, :codigo, :descricao, :valor_unitario, :espec_tecnica, :foto, :departamento_id, :marca_id, :ativo)";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':nome_produto',$nome_produto);
        $consulta->bindParam(':codigo',$codigo);
        $consulta->bindParam(':descricao',$descricao);
        $consulta->bindParam(':valor_unitario', $valor_unitario);
        $consulta->bindParam(':espec_tecnica',$espec_tecnica);
        $consulta->bindParam(':foto',$foto);
        $consulta->bindParam(':ativo',$ativo);
        $consulta->bindParam(':departamento_id',$departamento_id);
        $consulta->bindParam(':marca_id',$marca_id); 
        // $consulta->bindParam(':fornecedor_id',$fornecedor_id); 
        // $consulta->bindParam(':estoque_id',$estoque_id);  

        
    } else if (empty($foto)){

        $sql= "UPDATE produto SET nome_produto = :nome_produto, codigo = :codigo,  valor_unitario =:valor_unitario,
        descricao = :descricao, espec_tecnica = :espec_tecnica, promocao = :promocao, ativo = :ativo, departamento_id = :departamento_id,
        marca_id = :marca_id, fornecedor_id = :fornecedor_id, estoque_id = :estoque_id WHERE id = :id";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':nome_produto',$nome_produto);
        $consulta->bindParam(':codigo',$codigo);
        $consulta->bindParam(':descricao',$descricao);
        $consulta->bindParam(':valor_unitario', $valor_unitario);
        $consulta->bindParam(':espec_tecnica',$espec_tecnica);
        $consulta->bindParam(':promocao', $promocao);
        $consulta->bindParam(':ativo',$ativo);
        $consulta->bindParam(':departamento_id',$departamento_id);
        $consulta->bindParam(':marca_id',$marca_id);
        $consulta->bindParam(':fornecedor_id',$fornecedor_id);  
        $consulta->bindParam(':estoque_id',$estoque_id);  
        $consulta->bindParam(':id',$id);
    }
    else {
        
        $sql= "UPDATE produto SET nome_produto = :nome_produto, codigo = :codigo, promocao = :promocao, valor_unitario =:valor_unitario,
        descricao = :descricao, espec_tecnica = :espec_tecnica, foto = :foto, ativo = :ativo, departamento_id = :departamento_id,
        marca_id = :marca_id, fornecedor_id = :fornecedor_id, estoque_id = :estoque_id WHERE id = :id";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':nome_produto',$nome_produto);
        $consulta->bindParam(':codigo',$codigo);
        $consulta->bindParam(':descricao',$descricao);
        $consulta->bindParam(':valor_unitario', $valor_unitario);
        $consulta->bindParam(':espec_tecnica',$espec_tecnica);
        $consulta->bindParam(':promocao', $promocao);
        $consulta->bindParam(':foto',$foto);
        $consulta->bindParam(':ativo',$ativo);
        $consulta->bindParam(':departamento_id',$departamento_id);
        $consulta->bindParam(':marca_id',$marca_id); 
        $consulta->bindParam(':estoque_id',$estoque_id);  
        $consulta->bindParam(':id',$id);
    }
    
    if($consulta->execute()){
           
            //gravar no banco 
            // $pdo->commit();
            $titulo = "Sucesso";
            $mensagem = "Produto Salvo/Alterado!";
            $icone = "sucess";
            mensagem($titulo, $mensagem, $icone);
            
    } else {
         //erro ao gravar
        echo $erro = $consulta->errorInfo()[2];
        $titulo = "Erro";
		$mensagem = "Erro ao Gravar/Alterar Produto";
		$icone = "error";
		mensagem($titulo, $mensagem, $icone);
    }
}