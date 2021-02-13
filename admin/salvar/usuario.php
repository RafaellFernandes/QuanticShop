<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["bancotcc"]["id"] ) ){
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

  	//recuperar os dados do formulario
  	$id = $Nome = $Email = $Login = $Senha = $cidade_id = $Foto = $cep = $nome_cidade = $estado = $cep = "";
      
     // print_r($_POST);
      //print_r($_FILES);
      
  	foreach ($_POST as $key => $value) {
  	//guardar as variaveis
    $$key = trim ( $value );
  		
    }

    if( empty($Nome) ){
        echo "<script>alert('Preencha o nome');history.back();</script>";
    } else if( empty($Login) ){
        echo "<script>alert('Digite se Login de acesso!');history.back();</script>";
    }  else if( empty($Email) ){
        echo "<script>alert('Preencha o email');history.back();</script>";
    } else if( empty($Senha) ){
        echo "<script>alert('Preencha a senha');history.back();</script>";
    }

    //iniciar uma transacao
    $pdo->beginTransaction();
    
    $arquivo = time()."-".$_SESSION["bancotcc"]["id"];
    
    
      
      if(empty($id)){
          
         // $Senha = crypt($Senha);
         $Senha = password_hash($Senha, PASSWORD_DEFAULT);
          //inserir se o id estiver em branco
          $sql = "INSERT INTO usuario(Nome, Email, Login, Senha, cidade_id, Foto, nome_cidade, estado, cep) 
          VALUES (:Nome, :Email, :Login, :Senha, :cidade_id, :Foto, :nome_cidade, :estado, :cep) ";
          $consulta = $pdo->prepare($sql);
          $consulta->bindParam(":Nome", $Nome);
          $consulta->bindParam(":Login", $Login);
          $consulta->bindParam(":Email", $Email);
          $consulta->bindParam(":Senha", $Senha);
          $consulta->bindParam(":cidade_id", $cidade_id);
          $consulta->bindParam(":Foto", $arquivo);
          $consulta->bindParam(":nome_cidade", $nome_cidade);
          $consulta->bindParam(":estado", $estado);
          $consulta->bindParam(":cep", $cep);
          
          
      } else{
          //update se o id estiver preenchido
          //qual arquivo sera gravado
            if(!empty( $_FILES["Foto"]["name"])){
                $Foto = $arquivo;
            }
                    
          $sql = "UPDATE usuario SET Nome = :Nome, Email = :Email, Login = :Login, Senha = :Senha,
          cidade_id = :cidade_id, Foto = :Foto, nome_cidade = :nome_cidade, estado = :estado, cep = :cep WHERE id = :id ";
          $consulta = $pdo->prepare($sql);
          $consulta->bindParam(":Nome", $Nome);
          $consulta->bindParam(":Email", $Email);
          $consulta->bindParam(":Login", $Login);
          $consulta->bindParam(":Senha", $Senha);
          $consulta->bindParam(":cidade_id", $cidade_id);
          $consulta->bindParam(":Foto", $Foto);
          $consulta->bindParam(":nome_cidade", $nome_cidade);
          $consulta->bindParam(":estado", $estado);
          $consulta->bindParam(":cep", $cep);
          $consulta->bindParam(":id", $id);
          
      }
      //executar e verificar se deu certo
        if ( $consulta->execute() ) {
                //verificar se o arquivo nao está sendo enviado 
            if( empty($_FILES["Foto"]["type"]) and (!empty($id)) ){
                //a capa deve estar vazia e ID nao estiver vazio
                //gravar no banco 
                $pdo->commit();
                echo "<script>alert('Usuario salvo com Sucesso!');location.href='listar/usuario';</script>";

            }
            //veririfcar tipo imagem
            if($_FILES["Foto"]["type"]  !=  "image/jpeg"){
                echo "<script>alert('Seleciona uma imagem Jpeg');history.back();</script>";
                exit;
            }
            if ( move_uploaded_file($_FILES["Foto"]["tmp_name"], "../fotos/".$_FILES["Foto"]["name"])){

                $pastaFotos = "../fotos/";
                $nome = $arquivo;
                $imagem = $_FILES["Foto"]["name"];
                redimensionarImagem($pastaFotos,$imagem,$nome);

                //gravar no banco - se tudo deu certo
                $pdo->commit();
                echo "<script>alert('Usuario salvo com Sucesso!');location.href='listar/usuario';</script>";
            }

            //erro ao gravar
            echo "<script>alert('Erro ao gravar no servidor');history.back();</script>";
            exit;
        } else {
            echo '<script>alert("Erro ao salvar");history.back();</script>';
            exit;
        }
  }