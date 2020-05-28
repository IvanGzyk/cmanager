<?php
if (isset($_POST['data'])) {
    $data = $_POST['data'];
    ?><script language="javascript" type="text/javascript">
        Conteudo('../views/salao/views.php?data=<?= $data  ?>');
    </script><?php
}
if (isset($_POST['condominio'])) {
    $cond = $_POST['condominio'];
    ?>
    <script language="javascript" type="text/javascript">
        Conteudo('../views/condominio/form_1.php?cond=<?= $cond ?>');
    </script>
    <?php
}
if (isset($_GET['regras'])) {
    $cond = $_GET['condominio'];
    $salao = $_GET['Salao'];
    ?>
    <script language="javascript" type="text/javascript">
        Conteudo('../views/salao/form_regras.php?condominio=<?= $cond ?>&Salao=<?= $salao?>');
    </script>
    <?php
}
if (isset($_GET['cond'])) {
    $cond = $_GET['cond'];
    ?>
    <script language="javascript" type="text/javascript">
        Conteudo('../views/condominio/form_1.php?cond=<?= $cond ?>');
    </script>
    <?php
}
if (isset($_POST['nome'])) {
    ?>
    <script language="javascript" type="text/javascript">
        Conteudo('../views/usuario/views.php?nome=<?= $_POST['nome'] ?>');
    </script>
    <?php
}
if (isset($_POST['tipo'])) {
    ?>
    <script language="javascript" type="text/javascript">
        Conteudo('../views/usuario/views.php?tipo=<?= $_POST['tipo'] ?>');
    </script>
    <?php
}
if (isset($_POST['doc'])) {
    ?>
    <script language="javascript" type="text/javascript">
        Conteudo('../views/usuario/views.php?doc=<?= $_POST['doc'] ?>');
    </script>
    <?php
}
?>
