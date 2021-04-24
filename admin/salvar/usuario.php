<?php
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

    //include "../validacao/functions.php";
    include "../admin/validacao/functions.php";
    //include "../config/conexao.php";
   include "../admin/config/conexao.php";

  	//recuperar os dados do formulario
  	$id = $primeiro_nome = $sobrenome = $email = $login = $senha = $cidade_id = $foto = $cep = $cidade = $estado = $bairro = $complemento = $numero_resid = "";
      
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

    //iniciar uma transacao
    $pdo->beginTransaction();
    
    $arquivo = time()."-".$_SESSION["quanticshop"]["id"];
    
    
      
      if(empty($id)){
          
         //$senha = crypt($senha);
         //$senha = password_hash($senha, PASSWORD_DEFAULT);
         $senha = password_hash($senha, PASSWORD_BCRYPT);
          //inserir se o id estiver em branco
          $sql = "INSERT INTO usuario(primeiro_nome, sobrenome, email, login, senha, cidade_id, foto, cidade, estado, cep, complemento, bairro, numero_resid, endereco) 
          VALUES (:primeiro_nome, :sobrenome, :email, :login, :senha, :cidade_id, :foto, :cidade, :estado, :cep, :complemento, :bairro, :numero_resid, :endereco) ";
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

          
          
      } else{
          //update se o id estiver preenchido
          //qual arquivo sera gravado
            if(!empty( $_FILES["foto"]["name"])){
                $foto = $arquivo;
            }
                    
          $sql = "UPDATE usuario SET primeiro_nome = :primeiro_nome, sobrenome = :sobrenome, email = :email, login = :login, senha = :senha,
          cidade_id = :cidade_id, foto = :foto, cidade = :cidade, estado = :estado, cep = :cep, complemento = :complemento, bairro = :bairro, numero_resid = :numero_resid, endereco = :endereco WHERE id = :id ";
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
          $consulta->bindParam(":id", $id);
          
      }
      //executar e verificar se deu certo
        if ( $consulta->execute() ) {
                //verificar se o arquivo nao está sendo enviado 
            if( empty($_FILES["foto"]["type"]) and (!empty($id)) ){
                //a capa deve estar vazia e ID nao estiver vazio
                //gravar no banco 
                $pdo->commit();
                echo "<script>alert('Usuario salvo com Sucesso!');location.href='listagem/usuario';</script>";

            }
            //veririfcar tipo imagem
            if($_FILES["foto"]["type"]  !=  "image/jpeg"){
                echo "<script>alert('Seleciona uma imagem Jpeg');history.back();</script>";
                exit;
            }
            if ( move_uploaded_file($_FILES["foto"]["tmp_name"], "../fotos/".$_FILES["foto"]["name"])){

                $pastaFotos = "../fotos/";
                $nome = $arquivo;
                $imagem = $_FILES["foto"]["name"];
                redimensionarImagem($pastaFotos,$imagem,$nome);

                //gravar no banco - se tudo deu certo
                $pdo->commit();
                echo "<script>alert('Usuario salvo com Sucesso!');location.href='listagem/usuario';</script>";
            }

            //erro ao gravar
            echo "<script>alert('Erro ao gravar no servidor');history.back();</script>";
            exit;
        } else {
            echo '<script>alert("Erro ao salvar");history.back();</script>';
            exit;
        }
  }