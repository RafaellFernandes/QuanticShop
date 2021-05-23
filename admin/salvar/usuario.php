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
    //mostrar erros
    ini_set('display_errors',1);
    ini_set('display_startup_erros',1);
    error_reporting(E_ALL);

  //verificar se existem dados no POST
  if ( $_POST ) {

    include "validacao/functions.php";
    include "config/conexao.php";
    include "validacao/imagens.php";

  	//recuperar os dados do formulario
  	$id = $primeiro_nome = $sobrenome = $email = $login = $senha = $cidade_id = $foto = $cep = $cidade = $estado = $bairro = 
    $complemento = $numero_resid = $ativo = $cpf = $celular = $dataNascimento = "";
      
    //print_r($_POST);
    //print_r($_FILES);
      
  	foreach ($_POST as $key => $value) {
  	//guardar as variaveis
    $$key = trim ( $value );
  		
    }
 
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


    //iniciar uma transacao
    $pdo->beginTransaction();
    
    $arquivo = time()."-".$_SESSION["quanticshop"]["id"];
    
      if(empty($id)){
          
        //$senha = crypt($senha);
        //$senha = password_hash($senha, PASSWORD_DEFAULT);
        $senha = password_hash($senha, PASSWORD_BCRYPT);

        //inserir se o id estiver em branco
        $sql = "INSERT INTO usuario(primeiro_nome, sobrenome, email, login, senha, cidade_id, foto, cidade, estado, cep, complemento, bairro, numero_resid, endereco, ativo, cpf, dataNascimento, celular) 
        VALUES (:primeiro_nome, :sobrenome, :email, :login, :senha, :cidade_id, :foto, :cidade, :estado, :cep, :complemento, :bairro, :numero_resid, :endereco, :ativo, :cpf, :dataNascimento, :celular) ";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":primeiro_nome", $primeiro_nome);
        $consulta->bindParam(":sobrenome", $sobrenome);
        $consulta->bindParam(":login", $login);
        $consulta->bindParam(":email", $email);
        $consulta->bindParam(":senha", $senha);
        $consulta->bindParam(":cidade_id", $cidade_id);
        $consulta->bindParam(":foto", $arquivo);
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
 
      } else{
          //update se o id estiver preenchido
          //qual arquivo sera gravado
            if(!empty( $_FILES["foto"]["name"])){
                $foto = $arquivo;
            }
                    
        $sql = "UPDATE usuario SET primeiro_nome = :primeiro_nome, sobrenome = :sobrenome, email = :email, login = :login, senha = :senha,
        cidade_id = :cidade_id, foto = :foto, cidade = :cidade, estado = :estado, cep = :cep, complemento = :complemento, bairro = :bairro, 
        numero_resid = :numero_resid, endereco = :endereco, ativo = :ativo, dataNascimento = :dataNascimento, cpf = :cpf, celular = :celular WHERE id = :id ";
       
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":primeiro_nome", $primeiro_nome);
        $consulta->bindParam(":sobrenome", $sobrenome);
        $consulta->bindParam(":login", $login);
        $consulta->bindParam(":email", $email);
        $consulta->bindParam(":senha", $senha);
        $consulta->bindParam(":cidade_id", $cidade_id);
        $consulta->bindParam(":foto", $arquivo);
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
        $consulta->bindParam(":id", $id);
          
      }
      //executar e verificar se deu certo
        if ( $consulta->execute() ) {
                //verificar se o arquivo nao está sendo enviado 
            if( empty($_FILES["foto"]["type"]) and (!empty($id)) ){
                //a capa deve estar vazia e ID nao estiver vazio
                //gravar no banco 
                $pdo->commit();

                $titulo = "Sucesso";
                $mensagem = "Usuário Salvo!";
                $icone = "success";
                mensagem($titulo, $mensagem, $icone);
                echo "<script>location.href='listagem/usuario';</script>";

            }
            //veririfcar tipo imagem
            if($_FILES["foto"]["type"]  !=  "image/jpeg"){

                $titulo = "Atenção";
                $mensagem = "Selecione uma Imagem JPG";
                $icone = "warning";
                mensagem($titulo, $mensagem, $icone);
                echo "<script>history.back();</script>";
                exit;
            }
            if ( move_uploaded_file($_FILES["foto"]["tmp_name"], "../fotos/".$_FILES["foto"]["name"])){

                $pastaFotos = "../fotos/";
                $nome = $arquivo;
                $imagem = $_FILES["foto"]["name"];
                redimensionarImagem($pastaFotos,$imagem,$nome);

                //gravar no banco - se tudo deu certo
                $pdo->commit();
                $titulo = "Sucesso";
                $mensagem = "Usuário Salvo!";
                $icone = "success";
                mensagem($titulo, $mensagem, $icone);
                echo "<script>location.href='listagem/usuario';</script>";
               
            }

            //erro ao gravar
            $titulo = "Erro";
            $mensagem = "Erro ao Gravar no Servidor";
            $icone = "error";
            mensagem($titulo, $mensagem, $icone);
            echo "<script>history.back();</script>";
            exit;

        } else {
            
            $titulo = "Erro";
            $mensagem = "Erro ao Salvar";
            $icone = "error";
            mensagem($titulo, $mensagem, $icone);
            echo '<script>history.back();</script>';
            exit;
        }
  }