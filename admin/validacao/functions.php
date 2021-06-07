<?php

	function validaCPF($cpf) {
	    // Extrai somente os números
	    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
	    // Verifica se foi informado todos os digitos corretamente
	    if (strlen($cpf) != 11) {
	        return "O CPF precisa ter ao menos 11 números";
	    }
	    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
	    if (preg_match('/(\d)\1{10}/', $cpf)) {
	        return "CPF inválido";
	    }
	    // Faz o calculo para validar o CPF
	    for ($t = 9; $t < 11; $t++) {
	        for ($d = 0, $c = 0; $c < $t; $c++) {

	            $d += $cpf[$c] * (($t + 1) - $c);
	        }
	        $d = ((10 * $d) % 11) % 10;

	        if ($cpf[$c] != $d) {
	            return "CPF inválido 2";
	        }
	    }
	    return true;
	}

	function validaCNPJ($cnpj) {
	    $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
	    // Valida tamanho
	    if (strlen($cnpj) != 14)
	        return "CNPJ precisa ter ao menos 14 números";
	    // Valida primeiro dígito verificador
	    for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
	    {
	        $soma += $cnpj[$i] * $j;
	        $j = ($j == 2) ? 9 : $j - 1;
	    }
	    $resto = $soma % 11;
	    if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
	        return "CNPJ inválido";
	    // Valida segundo dígito verificador
	    for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
	    {
	        $soma += $cnpj[$i] * $j;
	        $j = ($j == 2) ? 9 : $j - 1;
	    }
	    $resto = $soma % 11;
	    return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
	}

/*****
//funcao para formatar a data 

****/
    function formatar($data){
        $data = explode("/", $data);
        return $data = $data[2]."-".$data[1]."-".$data[0];
    }

    
// /*****
// //funcao para retirar espaço 

// ****/

    function retirar($texto){
        //12__
        //retira todos os underline e troca por nada("")
        return str_replace("_","",$texto);
    }

// /*****
// //funcao para foramtar valor

// ****/
    function formatarValor($valor){
        // 12.000,00 -> 12000.00
        //primeiro troca o ponto
        $valor = str_replace(".","",$valor);
        //depois troca a virgula em ponto
        $valor = str_replace(",",".",$valor);
        
        return $valor;
        
    }

	function mensagem($titulo, $mensagem, $icone) { //Função que retorna um alerta bonitinho
		?>
		<script>
			//mostrar a telinha animada - alert
			Swal.fire(
			  '<?=$titulo?>',
			  '<?=$mensagem?>',
			  '<?=$icone?>'
			).then((result) => {
				//retornar para a tela anterior
				history.back();
			})
		</script>
		<?php
		exit;
	}