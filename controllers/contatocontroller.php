<?php
include_once '../../models/contato.php';
/**
 * Description of contatocontroller
 *
 * @author I.A.Gzyk
 */
class contatocontroller {
    function Create($telfixo, $telcel, $emailprinc, $emailalter, $cpf){
        $contato = new Contato($telfixo, $telcel, $emailprinc, $emailalter, $cpf);
        return $contato;
    }
}
