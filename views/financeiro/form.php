<?php
/*
 * Table Financeiro
 * //condominio (pegar o condominio do sindico)
 * //multas (gravar quando gerar multas)
 * //salao (gravar ao fazer a reserva do salão)
 * data (caso seja salo pagar a data da reserva)
 * valor
 * descricao
 * entrada_saida
 * 
 * Table Saldo
 * condo
 * saldo
 */
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8" />
        <link href="../../web/css/styles.css" rel="stylesheet" />
        <script src="../web/js/all.min.js"></script>
    </head>
    <body>
        <div id="layoutSidenav_content">
            <div class="container-fluid">
                <h1 class="mt-3">Cadastro Financeiro</h1>
                <div class="card mb-2"> </div>
                <br><br>
                <div class="container">
                    <form action="../views/financeiro/cadastro.php" method="POST" class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Valor:</label>
                                <input class='form-control' type="number" name="valor">
                                <label>Data:</label>
                                <input class='form-control' type="date" name="data">
                                <label>Tipo:</label>
                                <select name='entrada_saida' class='form-control'>
                                    <option value='entarda'>Entarda</option>
                                    <option value='saida'>Saída</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Descrição:</label>
                                <textarea class="form-control" rows="7"   name="descricao"></textarea>
                            </div>
                        </div>
                        <input type="submit" value="Salvar" class="btn btn-primary float-right">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
