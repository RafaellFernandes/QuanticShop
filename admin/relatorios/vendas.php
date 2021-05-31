<?php
include "validacao/functions.php";
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
?>	
<div class="card">
	<div class="card-header">
		<div class="container-fluid p-0">
			<div class="row">
				<div class="col-12 col-xl-12">
					<h4>RELATÓRIO</h4>
					<h6 style="color: blue;"><strong>Vendas</strong></h6>
				</div>
				<div class="card-body">
					<form name="formVendas" method="post" action="relatorioVendas.php" target="vendas" data-parsley-validate="">
						<div class="row">
							<div class="col-12 col-md-3">
								<span>Data Inicio</span>
								<input type="date" name="dataInicial" class="form-control" placeholder="Data Inicial" required data-parsley-required-message="Selecione uma data">
							</div>
							<div class="col-12 col-md-3">
								<span>Data Fim</span>
								<input type="date" name="dataFinal"
								class="form-control" placeholder="Data Final" required data-parsley-required-message="Selecione uma data">
							</div>
							<div class="col-12 col-md-3">
								<span>Tipo de Pagamento</span>
								<select name="filtro" class="form-control">
									<option value="">Todos</option>
									<option value="P">Pagos</option>
									<option value="A">Aguardando Pagamento</option>
									<option value="C">Cancelados</option>
								</select>
							</div>
							<div class="col-12 col-md-3 mt-4">
								<button type="danger" class="btn btn-primary">
									<i class="fas fa-search"></i> Mostrar
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>