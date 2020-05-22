<?php
include_once '../config/conexao.php';
$db = new Conexao();
$usuario = unserialize($_SESSION['usuario']);
$doc = $usuario['doc'];
$cnpj = "";
$select_condominio = "SELECT condominio FROM Usuario "
        . "WHERE cpfCnpj = '$doc'";
$execute = mysqli_query($db->con, $select_condominio);
while ($row = mysqli_fetch_row($execute)){
    $cnpj = $row[0];
}
//Grafico de pizza 1
$valores = array();
$dados = array();
$cores = array('#8A2BE2','#FF6347');
$id1 = "Chart_1";
$query_pizza = "SELECT data, round(SUM(valor),2) soma, entrada_saida FROM `Financeira` "
        . "WHERE date_format(data, '%Y-%m') = DATE_FORMAT(ADDDATE(CURDATE(), INTERVAL -1 MONTH), '%Y-%m')"
        . "AND condominio = '$cnpj' "
        . "GROUP BY date_format(data, '%m-Y'), `entrada_saida`";
$executa_pizza = mysqli_query($db->con, $query_pizza);
while ($row1 = mysqli_fetch_row($executa_pizza)) {
    $valores[] = $row1[2];
    if ($row1[2] == 'entrada') {
        $dados[] = $row1[1];
    } else {
        $dados[] = $row1[1];
    }
}
$valores = json_encode($valores);
$dados = json_encode($dados);
$cores = json_encode($cores);

//grafico de barras 1
$data = array();
$soma = array();
$soma1 = array();
$tipo = '';
$tipo1 = '';
$id = 'Chart';
$query = "SELECT date_format(data, '%m-%Y') data, round(SUM(valor),2) soma, entrada_saida FROM `Financeira` 
WHERE 
condominio = '$cnpj'
AND
data BETWEEN CURDATE() - INTERVAL 180 DAY AND CURDATE()
GROUP BY date_format(data, '%m-%Y'), `entrada_saida`;";
$executa = mysqli_query($db->con, $query);
while ($row = mysqli_fetch_row($executa)) {
    if (in_array($row[0], $data)) {
        
    } else {
        $data[] = $row[0];
    }
    if ($row[2] == 'entrada') {
        $soma[] = $row[1];
        $tipo = 'entrada';
    } else {
        $soma1[] = $row[1];
        $tipo1 = 'saida';
    }
}
$data = json_encode($data);
$soma = json_encode($soma);
$soma1 = json_encode($soma1);

//Grafico de barras 2
$data2 = array();
$soma2 = array();
$soma21 = array();
$tipo2 = '';
$tipo21 = '';
$id2 = 'Chart_2';
$query = "SELECT date_format(data, '%d-%M') data, round(SUM(valor),2) soma, entrada_saida FROM `Financeira` 
WHERE 
data BETWEEN CURDATE() - INTERVAL '30' DAY AND CURDATE() 
AND 
condominio = '$cnpj'
GROUP BY data, `entrada_saida`;";
$executa = mysqli_query($db->con, $query);
while ($row = mysqli_fetch_row($executa)) {
    if (in_array($row[0], $data2)) {
        
    } else {
        $data2[] = $row[0];
    }
    if ($row[2] == 'entrada') {
        $soma2[] = $row[1];
        $tipo2 = 'entrada';
    } else {
        $soma21[] = $row[1];
        $tipo21 = 'saida';
    }
}
$data2 = json_encode($data2);
$soma2 = json_encode($soma2);
$soma21 = json_encode($soma21);

//Grafico de linha 1
$valores3 = array(); 
$titulo3 = "Saldo";
$data3 = array(); 
$id3 = 'Chart_3'; 
$color3 = "'#00FA9A'";
$query = "SELECT date_format(mes, '%d-%m-%Y') mes, saldo FROM SaldoMes 
WHERE 
condominio = '$cnpj'
AND
mes BETWEEN CURDATE() - INTERVAL 180 DAY AND CURDATE();";
$executa = mysqli_query($db->con, $query);
while ($row = mysqli_fetch_row($executa)) {
    $valores3[] = $row[0];
    $data3[] = $row[1];
}
$valores3 = json_encode($valores3);
$data3 = json_encode($data3);
?>

