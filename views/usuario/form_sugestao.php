<!DOCTYPE HTML">
<html>
    <head>
        <title>Sugestões e Reclamações</title>
         <script src="https://cdn.tiny.cloud/1/vrusu6xeomqrnzuwno36zejqignyegip270g0fye01j1r59z/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    </head>
    <script>
    tinymce.init({
      selector: 'textarea'
    });
  </script>
    <body>
        <div id="layoutSidenav_content">
            <div class="container-fluid">
                <h1 class="mt-3">Sugestões e Reclamações</h1>
                <div class="card mb-2"> </div>
                <br><br>
                <div class="container">

                    <form action="../views/usuario/create_sugestao.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
    <label>Selecione um anexo</label>
    <input type="file" name="pic" accept="image/*" class="form-control">
  </div>
                
                           <div class="form-group">
                            <label>Mensagem</label>
    <textarea cols="50" rows="10" name="descricao" id="descricao" class="form-control" required="required"></textarea>
                             </div>
                        <button type="submit" class="btn btn-primary float-right">Enviar sugestão</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>