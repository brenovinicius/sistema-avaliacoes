<?php require APP_ROOT . '/views/template/init.php';?>
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Alterar senha</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Alterar senha</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
    <div class="container-fluid">
    <?php require APP_ROOT . '/views/template/components/messages.php'; ?>
    <div class="alert alert-warning alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <p><i class="icon fas fa-info"></i>A senha deve ter:</p>
              <ul>
                <li>No mínimo 8 caracteres</li>
                <li>Pelo menos uma letra maiúscula</li>
                <li>Pelo menos uma letras minúscula </li>
                <li>Pelo menos um número</li>
              </ul>
              </div>
        <?php if(!empty($data['errors'])) : ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-info"></i>Corrija os erros no formulário.</h5>
        </div>
    <?php endif; ?>
    <div class="card">
      <div class="card-body">
        <form action="/alterar_senha" method="POST">
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
        <div class="form-group">
            <label for="senha_atual">Senha atual</label>
            <input type="password" name="senha_atual" 
            class="form-control form-control-border <?php echo (!empty($data['errors']['senha_atual'])) ? 'is-invalid' : ''; ?>" 
            id="senha_atual" required>
            <?php echo (!empty($data['errors']['senha_atual'])) ? "<span class='error invalid-feedback'>" . 
            $data['errors']['senha_atual'] . "</span>" : ""; ?>
        </div>
        <div class="form-group">
            <label for="senha_nova">Nova Senha</label>
            <input type="password" name="senha_nova" 
            class="form-control form-control-border <?php echo (!empty($data['errors']['senha_nova'])) ? 'is-invalid' : ''; ?>" 
            id="senha_nova" required>
            <?php echo (!empty($data['errors']['senha_nova'])) ? "<span class='error invalid-feedback'>" . 
            $data['errors']['senha_nova'] . "</span>" : ""; ?>
        </div>
        <div class="form-group">
            <label for="senha_confirmacao">Confirmação de Senha</label>
            <input type="password" name="senha_confirmacao" 
            class="form-control form-control-border <?php echo (!empty($data['errors']['senha_confirmacao'])) ? 'is-invalid' : ''; ?>" 
            id="senha_confirmacao"required>
            <?php echo (!empty($data['errors']['senha_confirmacao'])) ? "<span class='error invalid-feedback'>" . 
            $data['errors']['senha_confirmacao'] . "</span>" : ""; ?>
        </div>
              </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Salvar</button>
                  <a class="btn btn-secondary" id="voltar" href="javascript:history.back()">Cancelar</a>
                </div>
         </form>
      </div>
            <!-- /.card -->
    </div>
    </section>
 </div>


<?php require APP_ROOT . '/views/template/end.php';?>
