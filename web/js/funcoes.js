function Conteudo(pagina) {
    $('#principal').load(pagina);
}
$(document).ready(function () {
    $("#serch").click(function () {
        $('#principal').load('../views/usuario/views.php');
    });
});