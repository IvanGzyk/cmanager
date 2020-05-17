<?php
include_once '../config/conexao.php';

$vazao = filter_input(INPUT_GET, 'vazaoagua');
$condominio = filter_input(INPUT_GET, 'condominio');

if (is_null($vazao) || is_null($condominio)) {
    echo "Dados retornados do NodeMCU estão incorretos.";
}

$db = new Conexao();
$con = $db->con;

	date_default_timezone_set('America/Sao_Paulo');
	$data_atual = date('d-m-Y H:i:s');
	$referencia = date('m-Y');
	
	$cubico = $vazao / 1000;
	$cubico_int = number_format($cubico,0,",","");
	$unidades = 112;
	
	if($cubico_int >= '0' && $cubico_int <= '560'){
		$valor = 4342.24;
	}else if($cubico_int >= '560' && $cubico_int <= '1120'){
		$valor = 4342.24;
			for ($i=561; $i <= $cubico_int; $i++) {
    			$valor += 1.20;
			}
	}else if($cubico_int >= '1121' && $cubico_int <= '1680'){
		$valor = 5014.24;
			for ($i=1121; $i <= $cubico_int; $i++) {
    			$valor += 6.68;
			}
	}else if($cubico_int >= '1681' && $cubico_int <= '2240'){
		$valor = 8755.04;
			for ($i=1681; $i <= $cubico_int; $i++) {
    			$valor += 6.72;
			}
	}else if($cubico_int >= '2241' && $cubico_int <= '3360'){
		$valor = 12518.24;
			for ($i=2241; $i <= $cubico_int; $i++) {
    			$valor += 6.77;
			}
	}else if($cubico_int > '3360'){
		$valor = 20100.64;
			for ($i=3361; $i <= $cubico_int; $i++) {
    			$valor += 11.46;
			}
	}
	$porcentagem = 85 / 100;
	$esgoto = $porcentagem * $valor;
	$valor_inicial = number_format($valor + $esgoto,2,".","");
	
	switch (date("m")) {
        case "01":    $mes = "Janeiro";     break;
        case "02":    $mes = "Fevereiro";   break;
        case "03":    $mes = "Março";       break;
        case "04":    $mes = "Abril";       break;
        case "05":    $mes = "Maio";        break;
        case "06":    $mes = "Junho";       break;
        case "07":    $mes = "Julho";       break;
        case "08":    $mes = "Agosto";      break;
        case "09":    $mes = "Setembro";    break;
        case "10":    $mes = "Outubro";     break;
        case "11":    $mes = "Novembro";    break;
        case "12":    $mes = "Dezembro";    break; 
 	}
 
	$nome_mes = $mes."-".date('Y');

	$valida = "SELECT * FROM ConsumoDeAgua WHERE condominio = '$condominio'";
	$executar = mysqli_query($con, $valida);
	$new_referencia = array();
	while ($row = mysqli_fetch_row($executar)) {
    	$new_referencia[] = $row[2];
	
	$nova_vazao = $row[5] + $vazao;
	
	$cubico1 = $nova_vazao / 1000;
	$cubico_int1 = number_format($cubico1,0,",","");
	$unidades1 = 112;
	
	if($cubico_int1 >= '0' && $cubico_int1 <= '560'){
		$valor1 = 4342.24;
	}else if($cubico_int1 >= '560' && $cubico_int1 <= '1120'){
		$valor1 = 4342.24;
			for ($i=561; $i <= $cubico_int1; $i++) {
    			$valor1 += 1.20;
			}
	}else if($cubico_int1 >= '1121' && $cubico_int1 <= '1680'){
		$valor1 = 5014.24;
			for ($i=1121; $i <= $cubico_int1; $i++) {
    			$valor1 += 6.68;
			}
	}else if($cubico_int1 >= '1681' && $cubico_int1 <= '2240'){
		$valor1 = 8755.04;
			for ($i=1681; $i <= $cubico_int1; $i++) {
    			$valor1 += 6.72;
			}
	}else if($cubico_int1 >= '2241' && $cubico_int1 <= '3360'){
		$valor1 = 12518.24;
			for ($i=2241; $i <= $cubico_int1; $i++) {
    			$valor1 += 6.77;
			}
	}else if($cubico_int1 > '3360'){
		$valor1 = 20100.64;
			for ($i=3361; $i <= $cubico_int1; $i++) {
    			$valor1 += 11.46;
			}
	}
	
	$porcentagem1 = 85 / 100;
	$esgoto1 = $porcentagem1 * $valor1;
	$valor_final1 = number_format($valor1 + $esgoto1,2,".","");
	}
	
if (mysqli_num_rows($executar) == 0) {
    $sql2 = "INSERT INTO ConsumoDeAgua (condominio, referencia, nome_mes, atualizacao, valorMedido, valor) VALUES ('$condominio', '$referencia', '$nome_mes', '$data_atual', '$vazao', '$valor_inicial');";
    mysqli_query($con, $sql2);
    echo 'sucesso';
}else if (!(in_array($referencia, $new_referencia))) {
    $sql1 = "INSERT INTO ConsumoDeAgua (condominio, referencia, nome_mes, atualizacao, valorMedido, valor) VALUES ('$condominio', '$referencia', '$nome_mes', '$data_atual', '$vazao', '$valor_inicial');";
    mysqli_query($con, $sql1);
    echo 'sucesso';
}else if (in_array($referencia, $new_referencia)) {
    $sql3 = "UPDATE ConsumoDeAgua SET atualizacao = '".$data_atual."', valorMedido = valorMedido + $vazao, valor = $valor_final1 WHERE condominio = '$condominio' AND referencia = '".$referencia."'";
	mysqli_query($con, $sql3);
    echo 'sucesso';
} else {
    echo 'erro';
}
?>