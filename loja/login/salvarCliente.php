<?php
//mostrar erros
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

//verificar se existem dados no POST
if ( $_POST ) {
    //recuperar os dados do formulario
    $id = $primeiro_nome = $sobrenome = $cpf  = $data_nascimento = $email = $senha = $cep = $telefone = $celular = $foto = 
    $pessoaFJ = $estado = $cidade = $endereco = $bairro = $complemento = $numero_resid = $cidade_id = $ativo = $genero_id = "";
       
    // print_r($_POST);
    // print_r($_FILES);
      
  	foreach ($_POST as $key => $value) {
        //guardar as variaveis
        $$key = trim ( $value );
  		
    }

    include "validacao/functions.php";
    include "validacao/imagem.php";

    if( empty($primeiro_nome) ){
        echo "<script>alert('Digite seu Primeiro Nome!');history.back();</script>";
    } else if( empty($sobrenome) ){
        echo "<script>alert('Digite seu Sobrenome!');history.back();</script>";
    } else if( validaCpf($cpf) != 1){
        echo "<script>alert('Digite seu CPF!');history.back();</script>";
    } else if( empty($data_nascimento) ){
        echo "<script>alert('Digite sua data de Nascimento!');history.back();</script>";
    } else if( empty($cep) ){
        echo "<script>alert('Digite seu Cep!');history.back();</script>";
    } else if( !filter_var($email, FILTER_VALIDATE_EMAIL) ){
        echo "<script>alert('Digite um e-mail válido');history.back();</script>";
    } else if( empty($endereco) ){
        echo "<script>alert('Preencha o Endereço!');history.back();</script>";
    } else if( empty($celular) ){
        echo "<script>alert('Preencha o Celular!');history.back();</script>";
    } else if( empty($numero_resid) ){
        echo "<script>alert('Digite o Numero da Residencia!');history.back();</script>";
  }

    

    //iniciar uma transacao
    // $pdo->beginTransaction();
    
    $data_nascimento = formatar($data_nascimento);

if ( ( empty ( $id ) ) and ( empty ( $_FILES['foto']['name'] ) ) ) {
    $titulo = "Erro ao enviar imagem";
    $mensagem = "Selecione um arquivo JPG válido";
    $icone = "error";
    mensagem($titulo, $mensagem, $icone);
    exit;
} 

//se existir imagem - copia para o servidor
if ( !empty ( $_FILES['foto']['name'] ) ) {
    //calculo para saber quantos mb tem o arquivo
    $tamanho = $_FILES['foto']['size'];
    $t = 8 * 1024 * 1024; //byte - kbyte - megabyte

    $foto = time();
    $usuario = "clienteLoja_";

    //definir um nome para a imagem
    $foto = "cliente_{$foto}_{$usuario}";

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
         
    if(empty($id)){
        //$Senha = password_hash($Senha, PASSWORD_DEFAULT);
        $senha = password_hash($senha, PASSWORD_BCRYPT);
        //inserir se o id estiver em branco
        $sql = "INSERT INTO cliente (primeiro_nome, sobrenome, cpf, data_nascimento, email, senha, cep, endereco, complemento, bairro, cidade_id, foto, telefone, celular, numero_resid, pessoaFJ, cidade, estado, ativo, genero_id) 
        VALUES (:primeiro_nome, :sobrenome, :cpf, :data_nascimento, :email, :senha, :cep, :endereco, :complemento, :bairro, :cidade_id, :foto, :telefone, :celular, :numero_resid, :pessoaFJ, :cidade, :estado, :ativo, :genero_id) ";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":primeiro_nome", $primeiro_nome);
        $consulta->bindParam(":sobrenome", $sobrenome);
        $consulta->bindParam(":cpf", $cpf);
        $consulta->bindParam(":data_nascimento", $data_nascimento);
        $consulta->bindParam(":email", $email);
        $consulta->bindParam(":senha", $senha);
        $consulta->bindParam(":cep", $cep);
        $consulta->bindParam(":endereco", $endereco);
        $consulta->bindParam(":complemento", $complemento);
        $consulta->bindParam(":bairro", $bairro);
        $consulta->bindParam(":cidade_id", $cidade_id);
        $consulta->bindParam(":foto", $foto);
        $consulta->bindParam(":telefone", $telefone);
        $consulta->bindParam(":celular", $celular);
        $consulta->bindParam(":numero_resid", $numero_resid);
        $consulta->bindParam(":pessoaFJ", $pessoaFJ);
        $consulta->bindParam(":cidade", $cidade);
        $consulta->bindParam(":estado", $estado);
        $consulta->bindParam(":ativo", $ativo);
        $consulta->bindParam(":genero_id", $genero_id);

    } else if  (empty($foto)) {
        $senha = password_hash($senha, PASSWORD_BCRYPT);
        //update se o id estiver preenchido         
        $sql = "UPDATE cliente SET primeiro_nome = :primeiro_nome, sobrenome = :sobrenome, cpf = :cpf, data_nascimento = :data_nascimento,
         email = :email, senha = :senha, cep = :cep, endereco = :endereco, complemento = :complemento, bairro = :bairro, cidade_id = :cidade_id, 
         telefone = :telefone, celular = :celular,numero_resid = :numero_resid, pessoaFJ = :pessoaFJ,
          cidade = :cidade, estado = :estado, ativo = :ativo, genero_id = :genero_id WHERE id = :id";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":primeiro_nome", $primeiro_nome);
        $consulta->bindParam(":sobrenome", $sobrenome);
        $consulta->bindParam(":cpf", $cpf);
        $consulta->bindParam(":data_nascimento", $data_nascimento);
        $consulta->bindParam(":email", $email);
        $consulta->bindParam(":senha", $senha);
        $consulta->bindParam(":cep", $cep);
        $consulta->bindParam(":endereco", $endereco);
        $consulta->bindParam(":complemento", $complemento);
        $consulta->bindParam(":bairro", $bairro);
        $consulta->bindParam(":cidade_id", $cidade_id);
        $consulta->bindParam(":telefone", $telefone);
        $consulta->bindParam(":celular", $celular);
        $consulta->bindParam(":numero_resid", $numero_resid);
        $consulta->bindParam(":pessoaFJ", $pessoaFJ);
        $consulta->bindParam(":cidade", $cidade);
        $consulta->bindParam(":estado", $estado);
        $consulta->bindParam(":ativo", $ativo);
        $consulta->bindParam(":genero_id", $genero_id);
        $consulta->bindParam(":id", $id);
        
      } else {
        //update sem senha
        //update se o id estiver preenchido
        $sql = "UPDATE cliente SET primeiro_nome = :primeiro_nome, sobrenome = :sobrenome, cpf = :cpf, data_nascimento = :data_nascimento,
        email = :email, cep = :cep, endereco = :endereco, complemento = :complemento, bairro = :bairro, cidade_id = :cidade_id, foto = :foto, 
        telefone = :telefone, celular = :celular,numero_resid = :numero_resid, pessoaFJ = :pessoaFJ,
         cidade = :cidade, estado = :estado, ativo = :ativo, genero_id = :genero_id WHERE id = :id";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":primeiro_nome", $primeiro_nome);
        $consulta->bindParam(":sobrenome", $sobrenome);
        $consulta->bindParam(":cpf", $cpf);
        $consulta->bindParam(":data_nascimento", $data_nascimento);
        $consulta->bindParam(":email", $email);
        // $consulta->bindParam(":senha", $senha);
        $consulta->bindParam(":cep", $cep);
        $consulta->bindParam(":endereco", $endereco);
        $consulta->bindParam(":complemento", $complemento);
        $consulta->bindParam(":bairro", $bairro);
        $consulta->bindParam(":cidade_id", $cidade_id);
        $consulta->bindParam(":foto", $foto);
        $consulta->bindParam(":telefone", $telefone);
        $consulta->bindParam(":celular", $celular);
        $consulta->bindParam(":numero_resid", $numero_resid);
        $consulta->bindParam(":pessoaFJ", $pessoaFJ);
        $consulta->bindParam(":cidade", $cidade);
        $consulta->bindParam(":estado", $estado);
        $consulta->bindParam(":ativo", $ativo);
        $consulta->bindParam(":genero_id", $genero_id);
        $consulta->bindParam(":id", $id);
    }
    //executar e verificar se deu certo
    if ( $consulta->execute() ) {
        //erro ao gravar
        $titulo = "Sucesso";
        $mensagem = "Seus Dados Foram Salvos! Realize o Login para Continuar.";
        $icone = "sucess";
        mensagem($titulo, $mensagem, $icone);
        exit;
    } else {
        $titulo = "Erro";
        $mensagem = "Erro ao Salvar!";
        $icone = "error";
        mensagem($titulo, $mensagem, $icone);
        exit;
    }
  }