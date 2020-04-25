
<?php

/**
 * Description of MenuController
 *
 * @author I.A.Gzyk
 */
class MenuController {

    function Menu($tipo, $doc) {
        include_once '../Config/Conexao.php';
        $db = new Conexao();
        $con = $db->con;

        $menu = "<nav class = 'navbar navbar-expand-lg py-3 navbar-dark bg-dark shadow-sm'>
        <a href = 'index.php' class = 'navbar-brand'>
        <img src = 'img/logo-cmanager-pequeno.png' width = '45' alt = '' class = 'd-inline-block align-middle mr-2'>
        <span class = 'text-uppercase font-weight-bold'>CMANAGER</span>
        </a>

        <div id = 'navbarSupportedContent' class = 'collapse navbar-collapse'>
        <ul class = 'navbar-nav ml-auto'>
        <li class = 'nav-item active'>
        <ul class='navbar-nav mr-auto'>
                <li class='nav-item active'>
                        <a class='nav-link' href='../../cmanager/web/index.php?p=home'>Página Inicial</a>
                </li>";
        //<? $menu 
        //_________________________________________________
        //Seleciona o Tipo pelo id...
        $query = "SELECT tipo FROM Tipo WHERE id = $tipo;";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_row($result)) {
            $tipo = $row[0];
        }
        $query = "";
        $query_acesso = "SELECT * FROM Menu;";
        $result_acesso = mysqli_query($con, $query_acesso);
        $menu_select = array();
        $carrega_menu = array();
        while ($row = mysqli_fetch_row($result_acesso)) {
            switch ($row[3]) {
                case 'Todos':
                    $menu_select['titulo'] = $row[1];
                    $menu_select['pai'] = $row[2];
                    $menu_select['tipo'] = $row[3];
                    $menu_select['linck'] = $row[4];
                    $menu_select['class'] = $row[5];
                    break;
                default:
                    $menu_select['titulo'] = $row[1];
                    $menu_select['pai'] = $row[2];
                    $menu_select['tipo'] = $row[3];
                    $menu_select['linck'] = $row[4];
                    $menu_select['class'] = $row[5];
            }
            $carrega_menu[] = $menu_select;
        }
        //print_r($carrega_menu);
        foreach ($carrega_menu as $value) {
        }
        $query = "SELECT * FROM Menu WHERE acesso = '$tipo';";
        //Seleciona todos os menus que são liberados para o Tipo de Usuario...
        $result = mysqli_query($con, $query);
        $icon = "";
        while ($row = mysqli_fetch_row($result)) {//Monata o menu...
            if ($row[1] == 'doc') {
                $query = "SELECT nome FROM  CadastrCpf_Cnpj WHERE cpf_cnpj = $doc;";
                $result = mysqli_query($con, $query);
                while ($row_name = mysqli_fetch_row($result)) {
                    $row[1] = $row_name[0];
                }
                $icon = "<i class='fas fa-user fa-fw'></i>";
            }
            if ($row[5] == 'nav-link dropdown-toggle') {
                $query_pai = "SELECT * FROM Menu WHERE pai = $row[0];";
                $result_pai = mysqli_query($con, $query_pai);

                $menu .= " <li class='nav-item dropdown'>";
                if ($row[1] == 'doc') {
                    $menu .= "<a class = 'nav-link dropdown-toggle' id = 'userDropdown' href = '#' role = 'button' data-toggle = 'dropdown' aria-haspopup = 'true' aria-expanded = 'false' > " . $icon . " & nbsp;" . $doc . "</a>";
                } else {
                    $menu .= "<a class='$row[5]' href='#' id='navbarDropdownMenuLink' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" . "$row[1]</a>";
                }
                $menu .= "<div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>";
                while ($row_pai = mysqli_fetch_row($result_pai)) {
                    $menu .= "<a class='$row_pai[5]' href='#' onclick=" . "Conteudo($row_pai[4])" . ">$row_pai[1]</a>";
                }
                $menu .= "</div></li>";
            } else if ($row[2] == null) {
                $menu .= "<li class='nav-item'>
                        <a class='$row[5]' href='#' onclick=" . "Conteudo($row[4])" . ">$row[1]</a>
                    </li>";
            }
        }
        $menu .= "</ul>
        </li>
        </ul>
        </div>
        </nav>";

        return $menu;
    }

}
