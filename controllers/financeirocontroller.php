<?php

class financeirocontroller {

    function GerarMultas($cpf, $apartamento, $valor, $data, $descricao) {
        include_once '../../config/conexao.php';
        $db = new Conexao();
        $query = "SELECT condominio FROM Usuario WHERE cpfCnpj = '$cpf'";
        $execute = mysqli_query($db->con, $query);
        $condominio = "";
        while ($row = mysqli_fetch_row($execute)) {
            $condominio = $row[0];
        }
        $inserir = "INSERT INTO Multas (apartamento, valor, data, descricao) VALUES ('$apartamento', '$valor', '$data', '$descricao');";
        $execut = mysqli_query($db->con, $inserir);
        $query = "select id from Multas where id = (select max(id) from Multas);";
        $executa = mysqli_query($db->con, $query);
        $id = "";
        while ($row = mysqli_fetch_row($executa)) {
            $id = $row[0];
        }
        $financeiro = "INSERT INTO Financeira (condominio, multas, data, valor, descricao, entrada_saida) VALUES ('$condominio', '$id', '$data', '$valor', 'Outros', 'entrada');";
        $executar = mysqli_query($db->con, $financeiro);
        echo '<script>
        alert("Multa Cadastrada com sucesso!");
		window.location.href = "../../web/index.php";
        </script>';
    }

    function CadastrpFinanceiro($condominio, $data, $valor, $descricao, $entrada_saida) {
        //include_once '../config/conexao.php';
        $db = new Conexao();
        $query = "";
        $inserir = "INSERT INTO Financeira (condominio, data, valor, descricao, entrada_saida) VALUES ('$condominio', '$data', '$valor', '$descricao', '$entrada_saida');";
        $execut = mysqli_query($db->con, $inserir);
        echo '<script>
        alert("Financeiro Cadastrado com sucesso!");
		window.location.href = "../../web/index.php";
        </script>';
    }

    function Relatorio($condominio) {
        include_once '../config/conexao.php';
        $db = new Conexao();
        $relatorio = '
            <table class="table table-hover">
                <thead>
                    <tr>
                        <td>Descrição</td>
                        <td>Valor</td>
                        <td>Data</td>
                        <td>Tipo</td>
                    </tr>
                </thead>
                <tbody>';
        $query = "SELECT descricao, valor, date_format(data, '%d-%m-%Y') data, entrada_saida FROM Financeira
                    WHERE 
                    condominio = '13.457.853/0001-07' 
                    AND 
                    date_format(data, '%Y-%m') = DATE_FORMAT(ADDDATE(CURDATE(), INTERVAL -1 MONTH), '%Y-%m')
                    ORDER BY data";
        $result = mysqli_query($db->con, $query);
        while ($row = mysqli_fetch_row($result)) {
            $relatorio .= "<tr>";
            $relatorio .= "<td>$row[0]</td>";
            $relatorio .= "<td>R$ " . number_format($row[1], 2, ',', '.') . "</td>";
            $relatorio .= "<td>$row[2]</td>";
            $relatorio .= "<td>$row[3]</td>";
            $relatorio .= "</tr>";
        }
        $relatorio .= '  
            </tbody>
        </table>';
        return $relatorio;
    }

    function grafic_barra($valores, $titulo, $data, $id) {
        ?>
        <canvas id="<?= $id ?>" style="margin-top:30px"></canvas>
        <script>
            var ctx = document.getElementById('<?= $id ?>').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?= $valores ?>,
                    datasets: [{
                            label: '<?= $titulo ?>',
                            backgroundColor: '#7E70C6',
                            borderColor: 'rgb(255, 99, 132)',
                            data: <?= $data ?>
                        }]
                }
            });</script>
        <?php
    }

    function carrega_grafico_barras2($valores, $titulo, $titulo2, $data, $data2, $cor1, $cor2, $id) {
        ?>
        <canvas id="<?= $id ?>" style="margin-top:30px"></canvas>
        <script>
            var ctx = document.getElementById('<?= $id ?>').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?= $valores ?>,
                    datasets: [{
                            label: '<?= $titulo ?>',
                            backgroundColor: <?= $cor1 ?>,
                            borderColor: 'rgba(54, 162, 235, 1)',
                            data: <?= $data ?>
                        }, {
                            label: '<?= $titulo2 ?>',
                            backgroundColor: <?= $cor2 ?>,
                            borderColor: 'rgb(255, 99, 132)',
                            data: <?= $data2 ?>
                        }]
                }
            });</script>
        <?php
    }

    function grafico_pizza($valores, $titulo, $data, $id, $cores) {
        ?>
        <canvas id="<?= $id ?>" style="margin-top:30px"></canvas>
        <script>
            var ctx = document.getElementById('<?= $id ?>').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: <?= $valores ?>,
                    datasets: [{
                            label: '<?= $titulo ?>',
                            backgroundColor: <?= $cores ?>,
                            data: <?= $data ?>
                        }]
                }
            });
        </script>
        <?php
    }

    function grafico_rosca($valores, $titulo, $data, $id) {
        ?>
        <canvas id="<?= $id ?>" style="margin-top:30px"></canvas>
        <script>
            var ctx = document.getElementById('<?= $id ?>').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: <?= $valores ?>,
                    datasets: [{
                            label: '<?= $titulo ?>',
                            /*backgroundColor: ['rgb(255, 99, 132)', 'rgb(255, 199, 132)', 'rgb(55, 99, 132)'],*/
                            data: <?= $data ?>
                        }]
                },
                options: let opcoes = {
                    cutoutPercentage: 40
                }
            });
        </script>
        <?php
    }

    function grafic_linha($valores, $titulo, $data, $id, $color) {
        ?>
        <canvas id="<?= $id ?>" style="margin-top:30px"></canvas>
        <script>
            var ctx = document.getElementById('<?= $id ?>').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?= $valores ?>,
                    datasets: [{
                            label: '<?= $titulo ?>',
                            backgroundColor: <?= $color ?>,
                            borderColor: "#2E8B57",
                            data: <?= $data ?>
                        }]
                }
            });</script>
        <?php
    }

    function GerarBoletos($array) {
        include_once '../../config/conexao.php';
        $db = new Conexao();
        ?><pre><?php
                //print_r($array);        exit();
                ?></pre><?php
        include '../../web/vendor/autoload.php';
        \Sounoob\pagseguro\config\Config::setAccountCredentials('ivangzyk@gmail.com', '710e1100-a3a1-4df1-b952-535ff57d0ae1cb1bd94a4da2a1c4c4a90bde3a7fca2634ee-bbe7-4f76-ab31-4bcd60ed0287');

        foreach ($array as $key => $value) {
            $boleto = new \Sounoob\pagseguro\Boleto();

            $id = $value['id'];
            $valor = $value['valor'];
            $descricao = "Prestação de condominio referente ao apartamento " . $value['blc'] . "-" . $value['ap'];
            $doc = $value['doc'];
            $nome = $value['nome'];
            $email = $value['email'];
            if ($value['telfixo'] == null) {
                $fone = $value['telCel'];
            } else {
                $fone = $value['telfixo'];
            }
            $data_venc = date("Y-m-d", strtotime("+9 days", time()));
            $cep = $value['cep'];
            $rua = $value['rua'];
            $numero = $value['numero'];
            $bairro = $value['bairro'];
            $cidade = $value['cidade'];
            $estado = $value['estado'];

            $search = array('(', ')', '-', ' ');
            $replace = array('', '', '', '');
            $fone = str_replace($search, $replace, $fone);
            $ddd_cliente = preg_replace('/\A.{2}?\K[\d]+/', '', $fone);
            $numero_cliente = preg_replace('/^\d{2}/', '', $fone);
            //Valor de cada boleto. Caso sua conta não absorver a taxa do boleto, será acrescentado 1 real no valor do boleto.
            $boleto->setAmount($valor);
            //Descrição do boleto
            $boleto->setDescription($descricao);
            //O CPF do comprador
            if ((strlen($doc)) < 16) {
                $boleto->setCustomerCPF($doc);
            } else {
                $boleto->setCustomerCNPJ($doc);
            }

            //Nome do comprador
            $boleto->setCustomerName($nome);
            //Email do comprador
            $boleto->setCustomerEmail($email);
            //Telefone do comprador
            $boleto->setCustomerPhone($ddd_cliente, $numero_cliente);
            //Data de vencimento do boleto no formato de Ano-Mês-Dia. Essa data precisa ser no futuro, e no máximo 30 dias apatir do dia atual.
            $boleto->setFirstDueDate(date("Y-m-d", strtotime("+9 days", time())));
            //Instruções para quem irá receber o pagamento
            $boleto->setInstructions('APÓS ' . date("Y-m-d", strtotime("+9 days", time())) . ' MULTA DE R$ 2,55 (2%');
            //CEP do comprador
            $boleto->setCustomerAddressPostalCode($cep);
            //Endereço do comprador
            $boleto->setCustomerAddress($rua, $numero);
            //Bairro do comprador
            $boleto->setCustomerAddressDistrict($bairro);
            //Cidade do comprador
            $boleto->setCustomerAddressCity($cidade);
            //Estado do comprador
            $boleto->setCustomerAddressState($estado);


            //Executa a conexão e captura a resposta do PagSeguro.
            $data = $boleto->send();

            //Você terá uma array de objeto, precisará de uma estrutura de laço para percorrer um a um.
            foreach ($data->boletos as $row) {
                $link = $row->paymentLink;
                $cod = $row->code;
                $insert = "INSERT INTO boleto(ap, venc, link, cod, status) VALUES ('$id', '$data_venc', '$link', '$cod', '1');";
                $execut = mysqli_query($db->con, $insert);
            }
        }
    }

    function CarregoBletos($doc) {
        include_once '../../config/conexao.php';
        $db = new Conexao();
        $ap = "";
        $data_venc = "";
        $link = "";
        $status = "";
        $relatorio = '<table class="table">
                        <thead>
                          <tr>
                            <th scope="col">VENCIMENTO</th>
                            <th scope="col">STATUS</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>';
        $query = "SELECT ap FROM apUser WHERE cpf_cnpj = '".$doc."';";
        $result = mysqli_query($db->con, $query);
        while ($row = mysqli_fetch_row($result)){
            $ap = $row[0];
            $query_boleto = "SELECT venc, link, status FROM boleto where ap = ' ".$ap."';";
            $result_boleto = mysqli_query($db->con, $query_boleto);
            while ($row_boleto = mysqli_fetch_row($result_boleto)){
                $data_venc = $row_boleto[0];
                $link = $row_boleto[1];
                if($row_boleto[2] != 3 || $row_boleto[2] != 4){
                    $status = "Aguardando pagamento";
                }else{
                    $status = "Pago";
                }
                $relatorio .= '<tr>
                            <td>'.$data_venc.' </td>
                            <td>'.$status.' </td>
                            <td><a href="'.$link.'"><button type="button" class="btn btn-info btn-sm">GERAR BOLETO</button></a></td>
                            </tr>';
            }
        }
        $relatorio .= '</tbody>
                </table>';
        return $relatorio;
    }
}
?>
        