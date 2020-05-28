<?php
include_once '../../controllers/financeirocontroller.php';
$financeiro = new financeirocontroller();
ini_set('max_execution_time', 30000);
set_time_limit(30000);

include '../../web/vendor/autoload.php';
\Sounoob\pagseguro\config\Config::setAccountCredentials('ivangzyk@gmail.com', '710e1100-a3a1-4df1-b952-535ff57d0ae1cb1bd94a4da2a1c4c4a90bde3a7fca2634ee-bbe7-4f76-ab31-4bcd60ed0287');
$boleto = new \Sounoob\pagseguro\Boleto();

//Variaveis para pegar valores do boleto para salvar em BD
$link = ""; //link para abrir o boleto
$cod = ""; //codigo para buscar o status do boleto
$venc = ""; //data de vencimento do boleto
//Conexão sql
$caminho = 'cmanager.com.br';
$usuario = 'cmanag62';
$senha = 'WyR1eo58j4';
$banco = 'cmanag62_cmanager';
$con = mysqli_connect($caminho, $usuario, $senha) or die("Falha ao se conectar." . mysqli_error($con));
mysqli_set_charset($con, 'utf8');
mysqli_select_db($con, $banco) or die("Falha ao selecionar o banco de dados." . mysqli_error($con));

//busca de valores para reteio por condominio
$query = "SELECT SUM(s.total - e.total) rateio, date_format(e.data, '%m') mes, e.condominio FROM (
        SELECT round(SUM(valor),2) total, DATA, condominio FROM Financeira
        WHERE 
        date_format(data, '%Y-%m') = DATE_FORMAT(ADDDATE(CURDATE(), INTERVAL -1 MONTH), '%Y-%m')
        AND 
        entrada_saida = 'entrada'
        AND descricao <> 'Taxa Condominial'
        GROUP BY condominio, date_format(data, '%Y-%m'))e,

        (SELECT round(SUM(valor),2) total FROM Financeira
        WHERE 
        date_format(data, '%Y-%m') = DATE_FORMAT(ADDDATE(CURDATE(), INTERVAL -1 MONTH), '%Y-%m')
        AND 
        entrada_saida = 'saida'
        AND descricao <> 'Taxa Condominial'
        GROUP BY condominio, date_format(data, '%Y-%m'))s;";

$result = mysqli_query($con, $query);

//arrays para pegar dados para rateio
$dados = array();
$dados_boleto = array();
while ($row = mysqli_fetch_row($result)) {
    $dados['valor'] = $row[0];
    $dados['mes'] = $row[1];
    $dados['condominio'] = $row[2];

    //Pega o total de apartamentos no condominio
    $query_num_ap = "SELECT COUNT(id) total FROM Predio
                    WHERE 
                    condominio = '" . $dados['condominio'] . "';";

    $result_num_ap = mysqli_query($con, $query_num_ap);
    while ($row_num_ap = mysqli_fetch_row($result_num_ap)) {
        $dados['qtd'] = $row_num_ap[0];
    }

    $dados['rateio'] = number_format($dados['valor'] / $dados['qtd'], 2); //pega o valor para rateio por apartamento
    $cont = 0;
    $query_dadosboleto = "SELECT apUser.ap, Predio.blc, Predio.ap, cpfCnpj, nome, telefoneFixo, telefoneCelular, email, rua, numero, bairro, cidade, estado, cep FROM Usuario
                            INNER JOIN Endereco ON cpf_cnpj = '" . $dados['condominio'] . "'
                            INNER JOIN CadastrCpf_Cnpj ON CadastrCpf_Cnpj.cpf_cnpj = Usuario.cpfCnpj
                            INNER JOIN apUser ON apUser.cpf_cnpj = Usuario.cpfCnpj
                            INNER JOIN Contato ON Contato.cpf_cnpj = Usuario.cpfCnpj
                            INNER JOIN Predio ON Predio.id = apUser.ap
                            WHERE Usuario.condominio = '" . $dados['condominio'] . "'
                            Order BY apUser.ap;";

    $result_dadosboleto = mysqli_query($con, $query_dadosboleto);
    //echo $query_dadosboleto;    exit();
    while ($row_dadosboleto = mysqli_fetch_row($result_dadosboleto)) {

        $dados_boleto[$cont]['valor'] = $dados['rateio'];
        $dados_boleto[$cont]['id'] = $row_dadosboleto[0];
        $dados_boleto[$cont]['blc'] = $row_dadosboleto[1];
        $dados_boleto[$cont]['ap'] = $row_dadosboleto[2];

        //pega as reservas feitas no mes
        $query_reservas = "SELECT apartamento, Salao.valor FROM Reservas
                INNER JOIN Salao ON condominio = '" . $dados['condominio'] . "'
                WHERE Salao.id = Reservas.Salao
                AND
                date_format(dataReserva, '%Y-%m') = DATE_FORMAT(ADDDATE(CURDATE(), INTERVAL -1 MONTH), '%Y-%m');";

        $result_reservas = mysqli_query($con, $query_reservas);

        while ($row_reservas = mysqli_fetch_row($result_reservas)) {
            if ($row_reservas[0] == $row_dadosboleto[0]) {
                $dados_boleto[$cont]['valor'] = $dados_boleto[$cont]['valor'] + $row_reservas[1]; //inclementa o valor da reservo no valor do boleto
            }
        }

        //pega as multas do mes
        $query_multas = "SELECT apartamento, valor from Multas
                    INNER JOIN Predio ON condominio = '" . $dados['condominio'] . "'
                    WHERE 
                    Predio.id = Multas.apartamento
                    AND 
                    date_format(data, '%Y-%m') = DATE_FORMAT(ADDDATE(CURDATE(), INTERVAL -1 MONTH), '%Y-%m');";

        $result_multas = mysqli_query($con, $query_multas);

        while ($row_multas = mysqli_fetch_row($result_multas)) {
            if ($row_multas[0] == $row_dadosboleto[0]) {
                $dados_boleto[$cont]['valor'] = $dados_boleto[$cont]['valor'] + $row_multas[1]; //inclementa o valor da mulata no valor da boleto boleto
            }
        }

        $dados_boleto[$cont]['doc'] = $row_dadosboleto[3];
        $dados_boleto[$cont]['nome'] = $row_dadosboleto[4];
        $dados_boleto[$cont]['telfixo'] = $row_dadosboleto[5];
        $dados_boleto[$cont]['telCel'] = $row_dadosboleto[6];
        $dados_boleto[$cont]['email'] = $row_dadosboleto[7];
        $dados_boleto[$cont]['rua'] = $row_dadosboleto[8];
        $dados_boleto[$cont]['numero'] = $row_dadosboleto[9];
        $dados_boleto[$cont]['bairro'] = $row_dadosboleto[10];
        $dados_boleto[$cont]['cidade'] = $row_dadosboleto[11];
        $dados_boleto[$cont]['estado'] = $row_dadosboleto[12];
        $dados_boleto[$cont]['cep'] = $row_dadosboleto[13];
    $cont++;
    }
    /* $dados_boleto[$cont]['telfixo'] = str_replace('(41)', '', $dados_boleto['telfixo']);
      $dados_boleto[$cont]['telfixo'] = str_replace('-', '', $dados_boleto['telfixo']);
      $dados_boleto[$cont]['telfixo'] = str_replace(' ', '', $dados_boleto['telfixo']);
      $dados_boleto[$cont]['telCel'] = str_replace('(41)', '', $dados_boleto['telCel']);
      $dados_boleto[$cont]['telCel'] = str_replace('-', '', $dados_boleto['telCel']);
      $dados_boleto[$cont]['telCel'] = str_replace(' ', '', $dados_boleto['telCel']); */
}
$boleto = $financeiro->GerarBoletos($dados_boleto);