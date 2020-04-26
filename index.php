<!DOCTYPE html>
<?php
?>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <link href="web/css/styles.css" rel="stylesheet" />
        <script src="web/js/funcoes.js" type="text/javascript"></script>
        <link href="web/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <script src="web/js/all.min.js"></script>
        <title>CMANAGER</title>
    </head>
    <body>
        <nav class = 'navbar navbar-expand-lg py-3 navbar-static-top navbar-light' style = 'background-color: #e3f2fd;'>
            <a href = 'index.php' class = 'navbar-brand'>
                <img src = 'web/img/logo-cmanager-pequeno.png' width = '45' alt = '' class = 'd-inline-block align-middle mr-2'>
                <span class = 'text-uppercase font-weight-bold'>CMANAGER</span>
            </a>

            <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarTogglerDemo01' aria-controls='navbarTogglerDemo01' aria-expanded='false' aria-label='Toggle navigation'><span class='navbar-toggler-icon'></span></button>

            <div class='collapse navbar-collapse' id='navbarTogglerDemo01'>
                <ul class = 'navbar-nav ml-auto'>
                    <li class = 'nav-item active'>
                        <ul class='navbar-nav mr-auto'>
                            <li class='nav-item'>
                                <a class='nav-link' href='web/index.php')" . ">Inicial</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' href='web/login/'>Entrar</a>
                            </li>
                            <li class='nav-item dropdown'>
                                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdownMenuLink' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>O que Fzemos?</a>
                                <div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'> 
                                    <a class='dropdown-item' href="#">Nosso Trabalho</a>
                                    <a class='dropdown-item' href='#'" . ">Condominios</a>
                                    <a class='dropdown-item' href='#'" . ">Parceiros</a>
                                </div>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' href='#' onclick=" ."Conteudo(" . $value['link'] . ")" . ">Contato</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <h1 align="center">AGUARDE...<br />EM BREVE VOCÊ CONHECERÁ A MAIS NOVA SOLUÇÃO PARA O SEU CONDOMÍNIO</h1>
        <br />
        <p align="center">Condominium Manager - A solução para o seu condomínio</p>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>