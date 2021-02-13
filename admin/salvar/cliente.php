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
    $id = $Nome = $cpf = $DataNascimento = $Email = $Senha = $Cep = $Endereco = $Complemento = $Bairro = $cidade_id = 
    $Foto = $Telefone = $Celular = $nome_cidade = $estado = $numeroCasa = $numeroApto = $sexo = $nome_cidade = $estado = "";
      
      //print_r($_POST);
      //print_r($_FILES);
      
  	foreach ($_POST as $key => $value) {
  	//guardar as variaveis
    $$key = trim ( $value );
  		
    }

    if( empty($Nome) ){
        echo "<script>alert('Digite seu Nome!');history.back();</script>";
    } else if( empty($cpf) ){
        echo "<script>alert('Digite seu CPF!');history.back();</script>";
    } else if( empty($DataNascimento) ){
        echo "<script>alert('Digite sua data de Nascimento!');history.back();</script>";
    } else if( empty($Cep) ){
        echo "<script>alert('Digite seu Cep!');history.back();</script>";
    } else if( empty($Email) ){
        echo "<script>alert('Preencha o Email!');history.back();</script>";
    } else if( empty($Endereco) ){
        echo "<script>alert('Preencha o Endereço!');history.back();</script>";
    } else if( empty($Celular) ){
        echo "<script>alert('Preencha o Celular!');history.back();</script>";
    } else if( empty($Senha) ){
        echo "<script>alert('Preencha a Senha!');history.back();</script>";
    } else if( empty($numeroCasa) ){
      echo "<script>alert('Digite o Numero da Casa!');history.back();</script>";
  }

    //iniciar uma transacao
    $pdo->beginTransaction();
    
    $DataNascimento = formatar($DataNascimento);
    
    $arquivo = time()."-".$_SESSION["bancotcc"]["id"];
         
      if(empty($id)){
          
        $Senha = password_hash($Senha, PASSWORD_DEFAULT);
        
          //inserir se o id estiver em branco
          $sql = "INSERT INTO cliente (Nome, cpf, DataNascimento, Email, Senha, Cep, Endereco, Complemento, Bairro, cidade_id, Foto, Telefone, Celular, numeroCasa, numeroApto, sexo, nome_cidade, estado) 
          VALUES (:Nome, :cpf, :DataNascimento, :Email, :Senha, :Cep, :Endereco, :Complemento, :Bairro, :cidade_id, :Foto, :Telefone, :Celular, :numeroCasa, :numeroApto, :sexo, :nome_cidade, :estado) ";
          $consulta = $pdo->prepare($sql);
          $consulta->bindParam(":Nome", $Nome);
          $consulta->bindParam(":cpf", $cpf);
          $consulta->bindParam(":DataNascimento", $DataNascimento);
          $consulta->bindParam(":Email", $Email);
          $consulta->bindParam(":Senha", $Senha);
          $consulta->bindParam(":Cep", $Cep);
          $consulta->bindParam(":Endereco", $Endereco);
          $consulta->bindParam(":Complemento", $Complemento);
          $consulta->bindParam(":Bairro", $Bairro);
          $consulta->bindParam(":cidade_id", $cidade_id);
          $consulta->bindParam(":Foto", $arquivo);
          $consulta->bindParam(":Telefone", $Telefone);
          $consulta->bindParam(":Celular", $Celular);
          $consulta->bindParam(":numeroCasa", $numeroCasa);
          $consulta->bindParam(":numeroApto", $numeroApto);
          $consulta->bindParam(":sexo", $sexo);
          $consulta->bindParam(":nome_cidade", $nome_cidade);
          $consulta->bindParam(":estado", $estado);
          
          
      } else {
          //update se o id estiver preenchido
          //qual arquivo sera gravado
            if(!empty( $_FILES["Foto"]["name"])){
                $Foto = $arquivo;
            }
                    
          $sql = "UPDATE cliente SET Nome = :Nome, cpf = :cpf, DataNascimento = :DataNascimento,
           Email = :Email, Senha = :Senha, Cep = :Cep, Endereco = :Endereco, Complemento = :Complemento,
         Bairro = :Bairro, cidade_id = :cidade_id, Foto = :Foto, Telefone = :Telefone, Celular = :Celular, 
            numeroCasa = :numeroCasa, numeroApto = :numeroApto, sexo = :sexo, nome_cidade = :nome_cidade, estado = :estado WHERE id = :id";
          $consulta = $pdo->prepare($sql);
          $consulta->bindParam(":Nome", $Nome);
          $consulta->bindParam(":cpf", $cpf);
          $consulta->bindParam(":DataNascimento", $DataNascimento);
          $consulta->bindParam(":Email", $Email);
          $consulta->bindParam(":Senha", $Senha);
          $consulta->bindParam(":Cep", $Cep);
          $consulta->bindParam(":Endereco", $Endereco);
          $consulta->bindParam(":Complemento", $Complemento);
          $consulta->bindParam(":Bairro", $Bairro);
          $consulta->bindParam(":cidade_id", $cidade_id);
          $consulta->bindParam(":Foto", $arquivo);
          $consulta->bindParam(":Telefone", $Telefone);
          $consulta->bindParam(":Celular", $Celular);
          $consulta->bindParam(":numeroCasa", $numeroCasa);
          $consulta->bindParam(":numeroApto", $numeroApto);
          $consulta->bindParam(":sexo", $sexo);
          $consulta->bindParam(":nome_cidade", $nome_cidade);
          $consulta->bindParam(":estado", $estado);
          $consulta->bindParam(":id", $id);
          
      }
      //executar e verificar se deu certo
        if ( $consulta->execute() ) {
                //verificar se o arquivo nao está sendo enviado 
            if( empty($_FILES["Foto"]["type"]) and (!empty($id)) ){
                //a capa deve estar vazia e ID nao estiver vazio
                //gravar no banco 
                $pdo->commit();
                echo "<script>alert('Cliente Salvo com Sucesso!');location.href='listar/cliente';</script>";

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
                echo "<script>alert('Cliente Salvo com Sucesso!');location.href='listar/cliente';</script>";
            }

            //erro ao gravar
            echo "<script>alert('Erro ao gravar no servidor');history.back();</script>";
            exit;
        } else {
            echo '<script>alert("Erro ao salvar");history.back();</script>';
            exit;
        }
  }