<!DOCTYPE HTML">
<html>
    <head>
        <title>Sugestões e Reclamações</title>
    </head>
    <body>
        <div id="layoutSidenav_content">
            <div class="container-fluid">
                <h1 class="mt-3">Sugestões e Reclamações</h1>
                <div class="card mb-2"> </div>
                <br><br>
                <div class="container">

                    <form action="../views/usuario/create_sugestao.php" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Data:</label>
                                <input type="date" name="data"class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Hora:</label>
                                <input type="time" name="hora"class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Carregar Imagem:</label>
                                <input type="file" name="pic" accept="image/*" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Descrição:</label>
                                <textarea cols="50" rows="10" name="descricao" class="form-control"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <button type="reset" class="btn btn-success">Limpar</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>