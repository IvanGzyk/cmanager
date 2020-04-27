<?php

class MenuController {

    function Menu($tipo, $doc) {
        include_once '../config/conexao.php';
        $db = new Conexao();
        $con = $db->con;

        $menu = "<nav class = 'navbar navbar-expand-lg py-3 navbar-static-top navbar-light' style = 'background-color: #e3f2fd;'>
        <a href = 'index.php' class = 'navbar-brand'>
        <img src = 'img/logo-cmanager-pequeno.png' width = '45' alt = '' class = 'd-inline-block align-middle mr-2'>
        <span class = 'text-uppercase font-weight-bold'>CMANAGER</span>
        </a>
		
   		<button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarTogglerDemo01' aria-controls='navbarTogglerDemo01' aria-expanded='false' aria-label='Toggle navigation'><span class='navbar-toggler-icon'></span></button>
				  
        <div class='collapse navbar-collapse' id='navbarTogglerDemo01'>
        <ul class = 'navbar-nav ml-auto'>
        <li class = 'nav-item active'>
        <ul class='navbar-nav mr-auto'>";
        
        //Seleciona o Tipo pelo id...
        $query = "SELECT tipo FROM Tipo WHERE id = $tipo;";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_row($result)) {
            $tipo = $row[0];
        }
        $query = "";
        $query_acesso = "SELECT * FROM Menu order by ordem;";
        $result_acesso = mysqli_query($con, $query_acesso);
        $menu_select = array();
        $carrega_menu = array();
        while ($row = mysqli_fetch_row($result_acesso)) {
            switch ($row[3]) {
                case 'Todos':
                    $menu_select['id'] = $row[0];
                    $menu_select['titulo'] = $row[1];
                    $menu_select['pai'] = $row[2];
                    $menu_select['tipo'] = $row[3];
                    $menu_select['link'] = $row[4];
                    $menu_select['class'] = $row[5];
                    break;
                default:
                    $menu_select['id'] = $row[0];
                    $menu_select['titulo'] = $row[1];
                    $menu_select['pai'] = $row[2];
                    $menu_select['tipo'] = $row[3];
                    $menu_select['link'] = $row[4];
                    $menu_select['class'] = $row[5];
            }
            $carrega_menu[] = $menu_select;
        }
        foreach ($carrega_menu as $value) {
            $icon = "";
            if ($value['tipo'] == $tipo || $value['tipo'] == 'Todos') {
                if ($value['titulo'] == 'doc') {
                    $query = "SELECT nome FROM CadastrCpf_Cnpj WHERE cpf_cnpj = '$doc'";
                    $result = mysqli_query($con, $query);
                    while ($row_name = mysqli_fetch_row($result)) {
                        $value['titulo'] = $row_name[0];
                    }
                    $icon = "<i class='fas fa-user fa-fw'></i>";
                }
                if ($value['class'] == 'nav-link dropdown-toggle') {
                    $query_pai = "SELECT * FROM Menu WHERE pai = " . $value['id'] . ";";
                    $result_pai = mysqli_query($con, $query_pai);

                    $menu .= " <li class='nav-item dropdown'>";
                    if ($value['titulo'] == 'doc') {
                        $menu .= "<a class = 'nav-link dropdown-toggle' id = 'userDropdown' href = '#' role = 'button' data-toggle = 'dropdown' aria-haspopup = 'true' aria-expanded = 'false' > " . $icon . " &nbsp;" . $doc . "</a>";
                    } else {
                        $menu .= "<a class='" . $value['class'] . "' href='#' id='navbarDropdownMenuLink' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" . $value['titulo'] . "</a>";
                    }
                    $menu .= "<div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>";
                    while ($row_pai = mysqli_fetch_row($result_pai)) {
                        if ($row_pai[1] == 'Sair') {
                            $menu .= "<a class='$row_pai[5]' href=$row_pai[4]>$row_pai[1]</a>";
                        } else {
                            $menu .= "<a class='$row_pai[5]' href='#' onclick=" . "Conteudo($row_pai[4])" . ">$row_pai[1]</a>";
                        }
                    }
                    $menu .= "</div></li>";
                } else if ($value['pai'] == null) {
                    if ($value['titulo'] == 'Página Inicial') {
                        $menu .= "<li class='nav-item'><a class=" . $value['class'] . " href='" . $value['link'] . "'>" . $value['titulo'] . "</a></li>";
                    } else
                        $menu .= "<li class='nav-item'><a class='" . $value['class'] . "' href='#' onclick=" . "Conteudo(" . $value['link'] . ")" . ">" . $value['titulo'] . "</a></li>";
                }
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
?>