<?php

include_once '../config/conexao.php';

class financeirocontroller {

    function GerarMultas($cpf, $apartamento, $valor, $data, $descricao) {
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
            $relatorio .= "<td>R$ ".number_format ($row[1], 2,',','.')."</td>";
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

}
