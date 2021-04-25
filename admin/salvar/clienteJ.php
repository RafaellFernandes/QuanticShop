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
    include "../admin/validacao/functions.php";
    include "../admin/config/conexao.php";

  	//recuperar os dados do formulario
    $id = $email = $senha = $cep = $telefone = $celular = $pessoaFJ = $nomeFantasia = $razaoSocial =
    $cnpj = $inscricao_estadual = $estado = $cidade = $endereco = $bairro = $numero_resid = $cidade_id = $ativo = $siteJ = $complemento = $genero_id = "";
      
      var_dump($_POST);
      print_r($_POST);
      print_r($_FILES);
      
  	foreach ($_POST as $key => $value) {
  	//guardar as variaveis
    $$key = trim ( $value );
  		
    }

    if( empty($nomeFantasia) ){
        echo "<script>alert('Digite o Nome Fantasia da Empresa!');history.back();</script>";
    } else if( empty($razaoSocial) ){
      echo "<script>alert('Digite a Razão Social!');history.back();</script>";
    } else if( empty($cnpj) ){
        echo "<script>alert('Digite o CNPJ!');history.back();</script>";
    } else if( empty($inscricao_estadual) ){
        echo "<script>alert('Digite a Inscrição Estadual!');history.back();</script>";
    } else if( empty($telefone) ){
        echo "<script>alert('Digite o Telefone!');history.back();</script>";
    } else if( empty($email) ){
        echo "<script>alert('Preencha o Email!');history.back();</script>";
    } else if( empty($endereco) ){
        echo "<script>alert('Preencha o Endereço!');history.back();</script>";
    } else if( empty($celular) ){
        echo "<script>alert('Preencha o Celular!');history.back();</script>";
    } else if( empty($senha) ){
        echo "<script>alert('Preencha a Senha!');history.back();</script>";
    } else if( empty($cep) ){
      echo "<script>alert('Digite o Cep!');history.back();</script>";
    }

    //iniciar uma transacao
    $pdo->beginTransaction();
         
      if(empty($id)){
          
          //$Senha = password_hash($Senha, PASSWORD_DEFAULT);
          $senha = password_hash($senha, PASSWORD_BCRYPT);
          //inserir se o id estiver em branco
          $sql = "INSERT INTO cliente (email, senha, cep, endereco, bairro, cidade_id, telefone, celular, numero_resid, pessoaFJ, cidade, estado, nomeFantasia, razaoSocial, cnpj, inscricao_estadual, ativo, siteJ, complemento, genero_id) 
          VALUES (:email, :senha, :cep, :endereco, :bairro, :cidade_id, :telefone, :celular, :numero_resid, :pessoaFJ, :cidade, :estado, :nomeFantasia, :razaoSocial, :cnpj, :inscricao_estadual, :ativo, :siteJ, :complemento, :genero_id)";
          $consulta = $pdo->prepare($sql);
          $consulta->bindParam(":email", $email);
          $consulta->bindParam(":senha", $senha);
          $consulta->bindParam(":cep", $cep);
          $consulta->bindParam(":endereco", $endereco);
          $consulta->bindParam(":bairro", $bairro);
          $consulta->bindParam(":cidade_id", $cidade_id);
          $consulta->bindParam(":telefone", $telefone);
          $consulta->bindParam(":celular", $celular);
          $consulta->bindParam(":numero_resid", $numero_resid);
          $consulta->bindParam(":pessoaFJ", $pessoaFJ);
          $consulta->bindParam(":cidade", $cidade);
          $consulta->bindParam(":estado", $estado);
          $consulta->bindParam(":nomeFantasia", $nomeFantasia);
          $consulta->bindParam(":razaoSocial", $razaoSocial);
          $consulta->bindParam(":cnpj", $cnpj);
          $consulta->bindParam(":inscricao_estadual", $inscricao_estadual);
          $consulta->bindParam(":ativo", $ativo);
          $consulta->bindParam(":siteJ", $siteJ);
          $consulta->bindParam(":complemento", $complemento);
          $consulta->bindParam(":genero_id", $genero_id);
        
          
          
      } else {
          //update se o id estiver preenchido
                    
          $sql = "UPDATE cliente SET email = :email, senha = :senha, cep = :cep, endereco = :endereco, complemento = :complemento,
         bairro = :bairro, cidade_id = :cidade_id, telefone = :telefone, celular = :celular, 
            numero_resid = :numero_resid, pessoaFJ = :pessoaFJ, cidade = :cidade, estado = :estado, nomeFantasia = :nomeFantasia,
            razaoSocial = :razaoSocial, cnpj = :cnpj, inscricao_estadual = :inscricao_estadual, ativo = :ativo,
             siteJ = :siteJ, complemento = :complemento, genero_id = :genero_id WHERE id = :id";

          $consulta = $pdo->prepare($sql);
          $consulta->bindParam(":email", $email);
          $consulta->bindParam(":senha", $senha);
          $consulta->bindParam(":cep", $cep);
          $consulta->bindParam(":endereco", $endereco);
          $consulta->bindParam(":bairro", $bairro);
          $consulta->bindParam(":cidade_id", $cidade_id);
          $consulta->bindParam(":telefone", $telefone);
          $consulta->bindParam(":celular", $celular);
          $consulta->bindParam(":numero_resid", $numero_resid);
          $consulta->bindParam(":pessoaFJ", $pessoaFJ);
          $consulta->bindParam(":cidade", $cidade);
          $consulta->bindParam(":estado", $estado);
          $consulta->bindParam(":nomeFantasia", $nomeFantasia);
          $consulta->bindParam(":razaoSocial", $razaoSocial);
          $consulta->bindParam(":cnpj", $cnpj);
          $consulta->bindParam(":inscricao_estadual", $inscricao_estadual);
          $consulta->bindParam(":ativo", $ativo);
          $consulta->bindParam(":siteJ", $siteJ);
          $consulta->bindParam(":complemento", $complemento);
          $consulta->bindParam(":genero_id", $genero_id);
          $consulta->bindParam(":id", $id);
          
      }
      //executar e verificar se deu certo
        if ( $consulta->execute() ) {
                //gravar no banco 
                $pdo->commit();
                echo "<script>alert('Cliente Salvo com Sucesso!');location.href='listagem/cliente';</script>";

            //erro ao gravar
            echo "<script>alert('Erro ao gravar no servidor');history.back();</script>";
            exit;
        } else {
            echo '<script>alert("Erro ao salvar");history.back();</script>';
            exit;
        }
   }