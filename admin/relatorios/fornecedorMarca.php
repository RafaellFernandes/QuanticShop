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
?>						
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-end">
                        <a class="btn btn-danger mt-3" target="_blank" href="relatorioFornecedorMarca.php">Gerar PDF</a>
                    </div>
                    <h4>RELATÓRIO</h4>
                    <h6 style="color: blue;"><strong>Marca Mais Comprada por Fornecedor</strong></h6>
                </div>
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ID MARCA <br> NOME MARCA</th>
                            <th>ID FORNECEDOR <br> RAZAO SOCIAL</th>
                            <th>CNPJ</th>
                            <th>EMAIL<br>SITE</th>
                            <th>TELEFONE<br>CELULAR</th>
                            <th>ID<br>CIDADE-UF</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql =  "SELECT m.id mid, m.nome_marca, f.id fid, f.*, c.id cid, p.id pid, v.vezesVendido
                                    FROM item_compra c
                                    INNER JOIN produto p ON (p.id = c.produto_id)
                                    INNER JOIN fornecedor f ON (f.id = c.fornecedor_id)
                                    INNER JOIN marca m ON (m.id = p.marca_id)
                                    INNER JOIN item_venda v ON (v.produto_id = p.id)
                                    WHERE c.ativo = 1 AND p.ativo = 1
                                    ORDER BY v.vezesVendido ASC";

                            $consulta = $pdo->prepare($sql);
                            $consulta->execute();

                            while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
                           
                                echo "<tr>
                                        <td>$dados->mid<br>$dados->nome_marca</td>
                                        <td>$dados->fid<br>$dados->razaoSocial</td>
                                        <td>$dados->cnpj</td>
                                        <td>$dados->email<br>$dados->siteFornecedor</td>
                                        <td>$dados->telefone<br>$dados->celular</td>
                                        <td>$dados->cidade_id<br>$dados->cidade - $dados->estado</td>
                                    </tr>";
                                }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>	