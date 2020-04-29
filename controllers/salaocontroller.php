<?php
require '../../models/salao.php';
/**
 * Description of salaocontroller
 *
 * @author I.A.Gzyk
 */
class salaocontroller {
    function CadastraSalao($cnpj, $nome){
        $salao = new Salao($cnpj,$nome);
        $salao->setSalao($nome);
        return $salao;
    }
    
    function ReservaSalao(){
        
    }
    
    function CadastraRegras(){
        
    }
}
