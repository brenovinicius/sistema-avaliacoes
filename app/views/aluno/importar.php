<?php require APP_ROOT . '/views/template/init.php';?>
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Importar alunos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Alunos</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
    <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <form action="/admin/alunos/importar" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label>Bloco</label>
          <select class="form-control" name="bloco">
            <?php foreach ($data['blocos'] as $bloco): ?> 
              <option value="<?php echo $bloco['id'] ?>"><?php echo $bloco['id'] ?></option>
            <?php endforeach;?>
          </select>
        </div>
        <div class="form-group <?php echo (!empty($data['arquivo_error'])) ? 'invalid-file' : ''; ?>">
          <label for="exampleInputFile">Arquivo</label>
            <input id="arquivo" name="arquivo" type="file" class="file"
            data-show-preview="false"
            data-msg-placeholder="Selecione um arquivo excel..."
            data-show-upload="false"
            data-browse-label="Procurar..."
            data-remove-label="Remover"
            accept="application/excel, application/vnd.msexcel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
            >
          <?php echo (!empty($data['arquivo_error'])) ? "<span class='invalid-file-msg'>" . $data['arquivo_error'] . "</span>" : ""; ?>
        </div>
              </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Enviar</button>
                  <a class="btn btn-secondary" id="voltar" href="javascript:history.back()">Cancelar</a>
                </div>
         </form>
      </div>
            <!-- /.card -->
    </div>
    </section>
 </div>


<?php require APP_ROOT . '/views/template/end.php';?>
