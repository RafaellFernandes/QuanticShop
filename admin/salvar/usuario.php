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

  	//recuperar os dados do formulario
  	$id = $primeiro_nome = $sobrenome = $email = $login = $senha = $cidade_id = $foto = $cep = $cidade = $estado = $bairro = 
    $complemento = $numero_resid = $ativo = $cpf = $celular = $dataNascimento = $genero_id =  "";
      
  	foreach ($_POST as $key => $value) {
        //guardar as variaveis
        $$key = trim ( $value );
    }

    include "validacao/functions.php";
    include "validacao/imagem.php";
 
    //Verificar se as Variaveis estao Vazias
    if( empty($primeiro_nome) ){
        echo "<script>alert('Preencha o Primeiro Nome!');history.back();</script>";
    } else if( empty($sobrenome) ){
        echo "<script>alert('Preencha o Sobrenome!');history.back();</script>";
    } else if( empty($login) ){
        echo "<script>alert('Digite se Login de Acesso!');history.back();</script>";
    } else if( empty($email) ){
        echo "<script>alert('Preencha o Email!');history.back();</script>";
    } else if( empty($cidade) ){
        echo "<script>alert('O Campo Cidade Esta vazio!');history.back();</script>";
    } else if( empty($numero_resid) ){
        echo "<script>alert('Digite o Numero da Residencia!');history.back();</script>";
    } else if( empty($senha) ){
        echo "<script>alert('Preencha a senha!');history.back();</script>";
    }
  
    $dataNascimento = formatar($dataNascimento);

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
        $foto = "usuario_{$foto}_{$usuario}";

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
        $senha = password_hash($senha, PASSWORD_BCRYPT);

        //inserir se o id estiver em branco
        $sql = "INSERT INTO usuario(primeiro_nome, sobrenome, email, login, senha, cidade_id, foto, cidade, estado, cep, complemento, bairro, numero_resid, endereco, ativo, cpf, dataNascimento, celular, genero_id) 
        VALUES (:primeiro_nome, :sobrenome, :email, :login, :senha, :cidade_id, :foto, :cidade, :estado, :cep, :complemento, :bairro, :numero_resid, :endereco, :ativo, :cpf, :dataNascimento, :celular, :genero_id) ";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":primeiro_nome", $primeiro_nome);
        $consulta->bindParam(":sobrenome", $sobrenome);
        $consulta->bindParam(":login", $login);
        $consulta->bindParam(":email", $email);
        $consulta->bindParam(":senha", $senha);
        $consulta->bindParam(":cidade_id", $cidade_id);
        $consulta->bindParam(":foto", $foto);
        $consulta->bindParam(":cidade", $cidade);
        $consulta->bindParam(":estado", $estado);
        $consulta->bindParam(":cep", $cep);
        $consulta->bindParam(":complemento", $complemento);
        $consulta->bindParam(":bairro", $bairro);
        $consulta->bindParam(":numero_resid", $numero_resid);
        $consulta->bindParam(":endereco", $endereco);
        $consulta->bindParam(":ativo", $ativo);
        $consulta->bindParam(":cpf", $cpf);
        $consulta->bindParam(":dataNascimento", $dataNascimento);
        $consulta->bindParam(":celular", $celular);
        $consulta->bindParam(":genero_id", $genero_id);
 
      } else if ( empty ( $foto ) ) {
        $sql = "UPDATE usuario SET primeiro_nome = :primeiro_nome, sobrenome = :sobrenome, email = :email, login = :login,
        cidade_id = :cidade_id, cidade = :cidade, estado = :estado, cep = :cep, complemento = :complemento, bairro = :bairro, 
        numero_resid = :numero_resid, endereco = :endereco, ativo = :ativo, dataNascimento = :dataNascimento, cpf = :cpf, celular = :celular, genero_id = :genero_id WHERE id = :id ";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":primeiro_nome", $primeiro_nome);
        $consulta->bindParam(":sobrenome", $sobrenome);
        $consulta->bindParam(":login", $login);
        $consulta->bindParam(":email", $email);
        $consulta->bindParam(":cidade_id", $cidade_id);
        $consulta->bindParam(":cidade", $cidade);
        $consulta->bindParam(":estado", $estado);
        $consulta->bindParam(":cep", $cep);
        $consulta->bindParam(":complemento", $complemento);
        $consulta->bindParam(":bairro", $bairro);
        $consulta->bindParam(":numero_resid", $numero_resid);
        $consulta->bindParam(":endereco", $endereco);
        $consulta->bindParam(":ativo", $ativo);
        $consulta->bindParam(":cpf", $cpf);
        $consulta->bindParam(":dataNascimento", $dataNascimento);
        $consulta->bindParam(":celular", $celular);
        $consulta->bindParam(":genero_id", $genero_id);
        $consulta->bindParam(":id", $id);

    } else {
        //update se o id estiver preenchido
        //update sem senha
        //qual arquivo sera gravado
                    
        $sql = "UPDATE usuario SET primeiro_nome = :primeiro_nome, sobrenome = :sobrenome, email = :email, login = :login,
        cidade_id = :cidade_id, foto = :foto, cidade = :cidade, estado = :estado, cep = :cep, complemento = :complemento, bairro = :bairro, 
        numero_resid = :numero_resid, endereco = :endereco, ativo = :ativo, dataNascimento = :dataNascimento, cpf = :cpf, celular = :celular, genero_id = :genero_id WHERE id = :id ";
       
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":primeiro_nome", $primeiro_nome);
        $consulta->bindParam(":sobrenome", $sobrenome);
        $consulta->bindParam(":login", $login);
        $consulta->bindParam(":email", $email);
        $consulta->bindParam(":cidade_id", $cidade_id);
        $consulta->bindParam(":foto", $foto);
        $consulta->bindParam(":cidade", $cidade);
        $consulta->bindParam(":estado", $estado);
        $consulta->bindParam(":cep", $cep);
        $consulta->bindParam(":complemento", $complemento);
        $consulta->bindParam(":bairro", $bairro);
        $consulta->bindParam(":numero_resid", $numero_resid);
        $consulta->bindParam(":endereco", $endereco);
        $consulta->bindParam(":ativo", $ativo);
        $consulta->bindParam(":cpf", $cpf);
        $consulta->bindParam(":dataNascimento", $dataNascimento);
        $consulta->bindParam(":celular", $celular);
        $consulta->bindParam(":genero_id", $genero_id);
        $consulta->bindParam(":id", $id); 
    }

    if ( $consulta->execute() ) {
        $titulo = "Sucesso";
		$mensagem = "Usuário Salvo/Alterado!";
		$icone = "success";
		mensagem($titulo, $mensagem, $icone);
    } else {
        echo $erro = $consulta->errorInfo()[2];
        $titulo = "Erro";
		$mensagem = "Erro ao Salvar/Alterar!";
		$icone = "error";
		mensagem($titulo, $mensagem, $icone);
    }
}