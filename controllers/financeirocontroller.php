<?php

include_once '../../config/conexao.php';

/**
 * Description of financeirocontroller
 *
 * @author I.A.Gzyk
 */
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
        while ($row = mysqli_fetch_row($executa)){
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

}
