<?php
include '../../config/conexao.php';
include_once '../../controllers/condominiocontroller.php';
?>
<legend>Cadastro de Condominio</legend>
<div class="container">
    <form action="../views/usuario/create.php" method="POST" class="form-group"> 
        <div class="form-row">
            <div class="form-group col-md-6">
                Rua:<input type="text" class="form-control" name="rua">
            </div>
            <div class="form-group col-md-6">
                Numero:<input type="numeric" class="form-control" name="num">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                Bairro:<input type="text" class="form-control" name="bairro">
            </div>
            <div class="form-group col-md-6">
                Estado:<input type="text" class="form-control" name="estado">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Cep</label>
                <input id="telfixo" type="text" maxlength="14" class="form-control" name="cep">
            </div> 
        </div>
        <input type="submit" value="Gravar" class="btn btn-primary">
    </form>

</div>