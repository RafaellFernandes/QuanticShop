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

    //mostrar erros
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
    error_reporting(E_ALL);

    //verificar se existem dados no POST
    if ( $_POST ) {

    include "validacao/functions.php";
    include "config/conexao.php";
    include "validacao/imagem.php";

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
    
    $venda_unitaria = formatarValor($venda_unitaria);
    
    if(empty($id)){
        //inserir
       
        $sql= "INSERT INTO produto (nome_produto, codigo, descricao, vendaUnitaria, espec_tecnica, foto,  departamento_id, marca_id, ativo) 
        values(:nome_produto, :codigo, :descricao, :valorUnitario, :espec_tecnica, :foto, :departamento_id, :marca_id, :ativo)";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':nome_produto',$nome_produto);
        $consulta->bindParam(':codigo',$codigo);
        $consulta->bindParam(':descricao',$descricao);
        $consulta->bindParam(':valorUnitario', $valorUnitario);
        $consulta->bindParam(':espec_tecnica',$espec_tecnica);
        $consulta->bindParam(':foto',$foto);
        $consulta->bindParam(':ativo',$ativo);
        $consulta->bindParam(':departamento_id',$departamento_id);
        $consulta->bindParam(':marca_id',$marca_id); 
       
    } else if (empty($foto)){

        $sql= "UPDATE produto SET nome_produto = :nome_produto, codigo = :codigo, valorUnitario = :valorUnitario,
        descricao = :descricao, espec_tecnica = :espec_tecnica, promocao = :promocao, ativo = :ativo, departamento_id = :departamento_id,
        marca_id = :marca_id WHERE id = :id";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':nome_produto',$nome_produto);
        $consulta->bindParam(':codigo',$codigo);
        $consulta->bindParam(':descricao',$descricao);
        $consulta->bindParam(':valorUnitario', $valorUnitario);
        $consulta->bindParam(':espec_tecnica',$espec_tecnica);
        $consulta->bindParam(':promocao', $promocao);
        $consulta->bindParam(':ativo',$ativo);
        $consulta->bindParam(':departamento_id',$departamento_id);
        $consulta->bindParam(':marca_id',$marca_id);
        $consulta->bindParam(':id',$id);
    }
    else {
        
        $sql= "UPDATE produto SET nome_produto = :nome_produto, codigo = :codigo, promocao = :promocao, valorUnitario = :valorUnitario,
        descricao = :descricao, espec_tecnica = :espec_tecnica, foto = :foto, ativo = :ativo, departamento_id = :departamento_id,
        marca_id = :marca_id WHERE id = :id";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':nome_produto',$nome_produto);
        $consulta->bindParam(':codigo',$codigo);
        $consulta->bindParam(':descricao',$descricao);
        $consulta->bindParam(':valorUnitario', $valorUnitario);
        $consulta->bindParam(':espec_tecnica',$espec_tecnica);
        $consulta->bindParam(':promocao', $promocao);
        $consulta->bindParam(':foto',$foto);
        $consulta->bindParam(':ativo',$ativo);
        $consulta->bindParam(':departamento_id',$departamento_id);
        $consulta->bindParam(':marca_id',$marca_id);  
        $consulta->bindParam(':id',$id);
    }
    
    if($consulta->execute()){
            //gravar no banco 
            $titulo = "Sucesso";
            $mensagem = "Produto Salvo/Alterado!";
            $icone = "success";
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