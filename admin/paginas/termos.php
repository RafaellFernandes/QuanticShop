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
<div class="col-md-12">
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title"> Termos e Politicas da Empresa</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table tablesorter " id="">
                    <thead class=" text-primary">
                        <tr>
                            <th class="text-center" >
                                <h2><b>Quantic Shop</b></h2>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">
                                <a href="termos/politicaDevolucao" class="btn btn-primary" type="button">Politica de Devolução</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <a href="termos/politicaPrivacidade" class="btn btn-primary" type="button">Politica de Privacidade</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <a href="termos/termosCondicoes" class="btn btn-primary" type="button">Termos e Condições</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
