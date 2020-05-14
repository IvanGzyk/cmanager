<?php

include_once '../../config/conexao.php';

/**
 * Description of financeirocontroller
 *
 * @author I.A.Gzyk
 */
class financeirocontroller {

    function GerarMultas($apartamento, $valor, $data, $descricao) {
        $db = new Conexao();
        $inserir = "INSERT INTO Multas (apartamento, valor, data, descricao) VALUES ('$apartamento', '$valor', '$data', '$descricao');";
        $execut = mysqli_query($db->con, $inserir);
        echo '<script>
        alert("Multa Cadastrada com sucesso!");
		window.location.href = "../../web/index.php";
        </script>';
    }
    
    function CadastrpFinanceiro($condominio, $data, $valor, $descricao, $entrada_saida){
        $db = new Conexao();
        $inserir = "INSERT INTO Financeira (condominio, data, valor, descricao, entrada_saida) VALUES ('$condominio', '$data', '$valor', '$descricao', '$entrada_saida');";
        $execut = mysqli_query($db->con, $inserir);
        echo '<script>
        alert("Financeiro Cadastrado com sucesso!");
		window.location.href = "../../web/index.php";
        </script>';
    }

}
