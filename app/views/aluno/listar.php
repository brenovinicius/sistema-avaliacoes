<?php require APP_ROOT . '/views/template/init.php'; ?>
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Listar alunos</h1>
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
    <?php require APP_ROOT . '/views/template/components/messages.php'; ?>
    <div class="card">
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">Nome</th>
                      <th class="text-center">Matrícula</th>
                      <th class="text-center">Bloco</th>
                      <th class="text-center">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(!empty($data['alunos'])) : ?>
                    <?php foreach ($data['alunos'] as $aluno) : ?>
                        <tr>
                            <td class="text-center"><?php echo $aluno["id"] ?></td>
                            <td class="text-center"><?php echo $aluno["nome"] ?></td>
                            <td class="text-center"><?php echo $aluno["matricula"] ?></td>
                            <td class="text-center"><?php echo $aluno["bloco_id"] ?></td>
                            <td class="text-center">
                              <a href="<?php echo '/admin/alunos/'. $aluno['id'] . '/detalhar'; ?>"
										class="btn btn-info btn-sm mb-1"> <i class="fas fa-eye"></i> Detalhar </a>
                    <a href="<?php echo '/admin/alunos/'. $aluno['id']; ?>"
										class="btn btn-primary btn-sm mb-1"> <i class="fas fa-pencil-alt"></i> Editar </a>
										<button data-id="<?php echo $aluno["id"]?>" data-url="/admin/alunos" data-toggle="modal" class="btn btn-danger btn-sm mb-1" 
                      data-target="#delete-dialog" id="<?php echo "delete-aluno-".$aluno["id"]?>">
                      <i class="fas fa-trash"> </i> Excluir
                    </button>
                    </td>
								</tr>
                    <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td class="text-center" colspan="5">Nenhum aluno cadastrado.</td>
                        </tr>
                    <?php endif; ?>    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
    </div>
    </section>
    <?php require APP_ROOT . '/views/template/components/delete.php'; ?>
 </div>

<?php require APP_ROOT . '/views/template/end.php'; ?>
