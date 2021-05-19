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
    
    include "validacao/functions.php";
    include "config/conexao.php";

  	//recuperar os dados do formulario
    $id = $primeiro_nome = $sobrenome = $cpf  = $data_nascimento = $email = $senha = $cep = $telefone = $celular = $foto = 
    $pessoaFJ = $estado = $cidade = $endereco = $bairro = $complemento = $numero_resid = $cidade_id = $ativo = $genero_id = "";
      
      //print_r($_POST);
      //print_r($_FILES);
      
  	foreach ($_POST as $key => $value) {
  	//guardar as variaveis
    $$key = trim ( $value );
  		
    }

    if( empty($primeiro_nome) ){
        echo "<script>alert('Digite seu Primeiro Nome!');history.back();</script>";
    } else if( empty($sobrenome) ){
      echo "<script>alert('Digite seu Sobrenome!');history.back();</script>";
    } else if( empty($cpf) ){
        echo "<script>alert('Digite seu CPF!');history.back();</script>";
    } else if( empty($data_nascimento) ){
        echo "<script>alert('Digite sua data de Nascimento!');history.back();</script>";
    } else if( empty($cep) ){
        echo "<script>alert('Digite seu Cep!');history.back();</script>";
    } else if( empty($email) ){
        echo "<script>alert('Preencha o Email!');history.back();</script>";
    } else if( empty($endereco) ){
        echo "<script>alert('Preencha o Endereço!');history.back();</script>";
    } else if( empty($celular) ){
        echo "<script>alert('Preencha o Celular!');history.back();</script>";
    } else if( empty($senha) ){
        echo "<script>alert('Preencha a Senha!');history.back();</script>";
    } else if( empty($numero_resid) ){
      echo "<script>alert('Digite o Numero da Residencia!');history.back();</script>";
  }

    //iniciar uma transacao
    $pdo->beginTransaction();
    
    $data_nascimento = formatar($data_nascimento);
    
    $arquivo = time()."-".$_SESSION["quanticshop"]["id"];
         
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
          $consulta->bindParam(":foto", $arquivo);
          $consulta->bindParam(":telefone", $telefone);
          $consulta->bindParam(":celular", $celular);
          $consulta->bindParam(":numero_resid", $numero_resid);
          $consulta->bindParam(":pessoaFJ", $pessoaFJ);
          $consulta->bindParam(":cidade", $cidade);
          $consulta->bindParam(":estado", $estado);
          $consulta->bindParam(":ativo", $ativo);
          $consulta->bindParam(":genero_id", $genero_id);
        
      } else {
          //update se o id estiver preenchido
          //qual arquivo sera gravado
            if(!empty( $_FILES["foto"]["name"])){
                $foto = $arquivo;
            }
                    
          $sql = "UPDATE cliente SET primeiro_nome = :primeiro_nome, sobrenome = :sobrenome, cpf = :cpf, data_nascimento = :data_nascimento,
           email = :email, senha = :senha, cep = :cep, endereco = :endereco, complemento = :complemento, bairro = :bairro, cidade_id = :cidade_id, foto = :foto, 
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
          $consulta->bindParam(":foto", $arquivo);
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
                //verificar se o arquivo nao está sendo enviado 
            if( empty($_FILES["foto"]["type"]) and (!empty($id)) ){
                //a capa deve estar vazia e ID nao estiver vazio
                //gravar no banco 
                $pdo->commit();

                $titulo = "Sucesso";
                $mensagem = "Cliente Salvo!";
                $icone = "success";
                mensagem($titulo, $mensagem, $icone);
                echo "<script>location.href='listagem/cliente';</script>";

            }
            //verificar tipo imagem
            if($_FILES["foto"]["type"]  !=  "image/jpeg"){
                $titulo = "Atenção";
                $mensagem = "Selecione uma Imagem JPG!";
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
                $mensagem = "Cliente Salvo!";
                $icone = "success";
                mensagem($titulo, $mensagem, $icone);
                echo "<script>location.href='listagem/cliente';</script>";
            }

            //erro ao gravar
            $titulo = "Erro";
            $mensagem = "Erro ao Gravar no Servidor!";
            $icone = "error";
            mensagem($titulo, $mensagem, $icone);
            echo "<script>history.back();</script>";
            exit;

        } else {

            $titulo = "Erro";
            $mensagem = "Erro ao Salvar!";
            $icone = "error";
            mensagem($titulo, $mensagem, $icone);
            echo '<script>history.back();</script>';
            exit;
        }
  }