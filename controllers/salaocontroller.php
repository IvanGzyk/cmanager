<?php

session_start();
require '../../models/salao.php';
require_once '../../config/conexao.php';
require '../../web/vendor/autoload.php';

use benhall14\phpCalendar\Calendar as Calendar;

/**
 * Description of salaocontroller
 *
 * @author I.A.Gzyk
 */
class salaocontroller {

    function CadastraSalao($cnpj, $nome) {
        $salao = new Salao($cnpj, $nome);
        $salao->setSalao($nome);
        return $salao;
    }

    function ReservaSalao($id_salao, $data, $apartamento) {
        $salao = new Salao("", "");
        $reserva = $salao->setReservas($id_salao, $apartamento, $data);
        return $reserva;
    }

    function Calendario($data) {
        $db = new Conexao();
        $reserva = "";
        $usuario = unserialize($_SESSION['usuario']);
        $doc = $usuario['doc'];
        $query = "SELECT * FROM Salao INNER JOIN Usuario on Usuario.condominio = Salao.condominio WHERE Usuario.cpfCnpj LIKE '$doc' GROUP BY Salao.id";
        
        $execute = mysqli_query($db->con, $query);
        while ($row = mysqli_fetch_row($execute)) {
            $objeto = new Calendar();
            $reservas = array();
            $query_reservas = "SELECT * FROM Reservas WHERE salao = $row[0]";
            $result = mysqli_query($db->con, $query_reservas);
            $linhas = mysqli_num_rows($result);

            if ($linhas == 1) {
                while ($row_reservas = mysqli_fetch_row($result)) {
                    $objeto->addEvent(
                            $row_reservas[2], # Data inicio
                            $row_reservas[2], # Data fim
                            'Reservado', # Evento
                            true, # should the date be masked - boolean default true
                            ['myclass', 'abc']   # (optional) additional classes in either string or array format to be included on the event days
                    );
                }
            } else {
                while ($row_reservas = mysqli_fetch_row($result)) {
                    $reservas[] = array(
                        'start' => $row_reservas[2],
                        'end' => $row_reservas[2],
                        'summary' => 'Reservado',
                        'mask' => true
                    );
                }
                $objeto->addEvents($reservas);
            }
            ?><legend>Salão de festas: <?= $row[2]?></legend><?php
            echo $objeto->draw(date($data));
        }
    }

    function CadastraRegras() {
        
    }

}
