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
    // include "validacao/imagem.php";

    //recuperar variaveis
    $id = $nome_produto = $codigo = $valorUnitario = $descricao = $espec_tecnica = $foto = $ativo = $departamento_id = $marca_id = "";

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

    if(isset($_FILES['foto'])){
        // informações da imagens
        $imagem = $_FILES['foto'];   
        $numArquivo = count(array_filter($imagem['name']));
        // Local de upload
        $pasta = "../fotos/produtos/";
        // Permissões de arquivos
        $tipo       = array('image/jpeg', 'image/png');
        $maxsize    = 1024 * 1024 * 10;
        // mensagens
        $msg        = array();
        $errorMsg   = array(
                    1 => 'Arquivos no upload é maior qye o limite definido de upload_max_filesize, por favor reduza suas imagens',
                    2 => 'O arquivo ultrapassa o limite de tamanho em MAX_FILE_SIZE',
                    3 => 'Upload feito parcialmente, e pode conter erros',
                    4 => 'Upload de arquivo não realizado'
                );

        if($numArquivo <= 0)
                echo 'Selecione uma imagem';
            else{
                for($i = 0; $i < $numArquivo; $i++){
                    $name = $imagem['name'][$i];
                    $type = $imagem['type'][$i];
                    $size = $imagem['size'][$i];
                    $error = $imagem['error'][$i];
                    $tmp = $imagem['tmp_name'][$i];

                    $extensao = @end(explode('.', $name));
                    $nomes[]=$nomeUnico = rand().".$extensao";

                    if($error != 0)
                        $msg[] = "<b>$name :</b> ".$errorMsg[$error];
                    else if(!in_array($type, $tipo))
                        $msg[] = "<b>$name :</b> Erro tipo imagem não permitida!";
                    else if($size > $maxsize)
                        $msg[] = "<b>$name :</b> Tamanho do(s) arquivo(s) maior que o limite 10MB!";
                    else {
                        if(move_uploaded_file($tmp, $pasta."/".$nomeUnico))
                            $msg[] = "<b>$name :</b> Upload realizado com sucesso!";
                        else
                            $msg[] = "<b>$name :</b> Erro! Ocorreu um erro, tente novamente!";
                        }
                }
                    $nomeimagem = implode(',', $nomes);

                    // $result_produtos = "INSERT INTO produto (imagem) VALUES ('{$nomeimagem}'NOW())";
                    // $resultado_produtos = mysqli_query($conn, $result_produtos);                        
                    // fecha else
            }
        }

    //iniciar uma transacao
    // $pdo->beginTransaction();
    // $venda_unitaria = formatarValor($venda_unitaria);
    // $arquivo = time()."-".$_SESSION["quanticshop"]["id"];
    
    if(empty($id)){

        //verifica se já existe o mesmo codigo de produto cadastrado
		$sql = "SELECT codigo from produto";
		$consulta = $pdo->prepare($sql);
		$consulta->execute();	
		while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ){
			if($codigo == $dados->codigo) {
				mensagem("Erro", "Já existe esse código de produto cadastrado", "error");
				exit;
			}
		}
        $sql= "INSERT INTO produto (nome_produto, codigo, descricao, valorUnitario, espec_tecnica, foto,  departamento_id, marca_id, ativo) 
        values(:nome_produto, :codigo, :descricao, :valorUnitario, :espec_tecnica, :foto, :departamento_id, :marca_id, :ativo)";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':nome_produto',$nome_produto);
        $consulta->bindParam(':codigo',$codigo);
        $consulta->bindParam(':descricao',$descricao);
        $consulta->bindParam(':valorUnitario', $valorUnitario);
        $consulta->bindParam(':espec_tecnica',$espec_tecnica);
        $consulta->bindParam(':foto',$nomeimagem);
        $consulta->bindParam(':ativo',$ativo);
        $consulta->bindParam(':departamento_id',$departamento_id);
        $consulta->bindParam(':marca_id',$marca_id); 
       
    } else if (empty($id)){
        //verifica se já existe o mesmo codigo de produto cadastrado
		$sql = "SELECT codigo from produto";
		$consulta = $pdo->prepare($sql);
		$consulta->execute();	
		while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ){
			if($codigo == $dados->codigo) {
				mensagem("Erro", "Já existe esse código de produto cadastrado", "error");
				exit;
			}
		}

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
        
    } else {

        $sql= "UPDATE produto SET nome_produto = :nome_produto, codigo = :codigo, promocao = :promocao, valorUnitario = :valorUnitario,
        descricao = :descricao, espec_tecnica = :espec_tecnica, ativo = :ativo, departamento_id = :departamento_id,
        marca_id = :marca_id, foto =:foto WHERE id = :id";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':nome_produto',$nome_produto);
        $consulta->bindParam(':codigo',$codigo);
        $consulta->bindParam(':descricao',$descricao);
        $consulta->bindParam(':valorUnitario', $valorUnitario);
        $consulta->bindParam(':espec_tecnica',$espec_tecnica);
        $consulta->bindParam(':promocao', $promocao);
        $consulta->bindParam(':foto',$nomeImagem);
        $consulta->bindParam(':ativo',$ativo);
        $consulta->bindParam(':departamento_id',$departamento_id);
        $consulta->bindParam(':marca_id',$marca_id);  
        $consulta->bindParam(':id',$id);
    }
    
    if($consulta->execute()){
        //gravar no banco 
        // $pdo->commit();
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