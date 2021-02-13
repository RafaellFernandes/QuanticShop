<?php
    //verificar se não está logado
    if ( !isset ( $_SESSION["bancotcc"]["id"] ) ){
        exit;
    }

?>
<div class="content">
    <div class="row">
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
                                    <th class="text-center">
                                        QUANTIC SHOP
                                    </th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">
                                        <a href="paginas/politicaDevolucao" class="btn btn-info" type="button">Politica de Devolução</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <a href="paginas/politicaPrivacidade" class="btn btn-info" type="button">Politica de Privacidade</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <a href="paginas/termosCondicoes" class="btn btn-info" type="button">Termos e Condições</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-info" type="button" disabled>Vazio</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-info" type="button" disabled>Vazio</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-info" type="button" disabled>Vazio</a>
                                    </td>
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>