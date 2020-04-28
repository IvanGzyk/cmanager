<?php

include_once '../../config/conexao.php';
include_once '../../models/condominio.php';

Class CondominioController {

    function Create($condominio, $cpf_cnpj, $apartamento, $bloco) {
        $condo = new Condominio($condominio, $cpf_cnpj, $bloco, $apartamento);
        return $condo;
    }

    function Atualiza($apartamento, $bloco) {
        
    }

    function Apaga($id) {
        header('Location:../views/condominio/views.php');
    }
    
    function CreateCondominio($condominio, $cpf_cnpj){
        $condo = new Condominio($condominio, $cpf_cnpj, '', '');
        return $condo;
    }

}
