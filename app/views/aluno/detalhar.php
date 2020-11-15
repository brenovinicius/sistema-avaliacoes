<?php require APP_ROOT . '/views/template/init.php';?>
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Detalhar aluno</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
    <div class="container-fluid">
    <div class="card">
              <div class="card-body p-0">
                <table class="table table-bordered table-hover">
                  <tbody>
                    <tr>
                      <td class="font-weight-bold" >Nome</td>
                      <td><?php echo $data['aluno']['nome'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Matricula</td>
                      <td><?php echo $data['aluno']['matricula'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">CPF</td>
                      <td><?php echo isset($data['aluno']['cpf']) ?  $data['aluno']['cpf'] : "-" ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Email</td>
                      <td><?php echo isset($data['aluno']['email']) ?  $data['aluno']['email'] : "-" ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Celular</td>
                      <td><?php echo isset($data['aluno']['celular']) ?  $data['aluno']['celular'] : "-" ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Cor</td>
                      <td><?php echo isset($data['aluno']['cor']) ?  $data['aluno']['cor'] : "-" ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Sexo</td>
                      <td><?php echo isset($data['aluno']['sexo']) ?  $data['aluno']['sexo'] : "-" ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Data Nascimento</td>
                      <td><?php echo isset($data['aluno']['data_nascimento']) ?  date("d/m/Y", strtotime($data['aluno']['data_nascimento'])) : "-" ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">CEP</td>
                      <td><?php echo isset($data['aluno']['endereco']['cep']) ?  $data['aluno']['endereco']['cep'] : "-" ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Logradouro</td>
                      <td><?php echo isset($data['aluno']['endereco']['logradouro']) ?  $data['aluno']['endereco']['logradouro'] : "-" ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Número</td>
                      <td><?php echo isset($data['aluno']['endereco']['numero']) ?  $data['aluno']['endereco']['numero'] : "-" ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Bairro</td>
                      <td><?php echo isset($data['aluno']['endereco']['bairro']) ?  $data['aluno']['endereco']['bairro'] : "-" ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Estado</td>
                      <td><?php echo isset($data['aluno']['endereco']['uf']) ?  $data['aluno']['endereco']['uf'] : "-" ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Cidade</td>
                      <td><?php echo isset($data['aluno']['endereco']['cidade']) ?  $data['aluno']['endereco']['cidade'] : "-" ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Complemento</td>
                      <td><?php echo isset($data['aluno']['endereco']['complemento']) ?  $data['aluno']['endereco']['complemento'] : "-" ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <a class="btn btn-secondary" id="voltar" href="javascript:history.back()">Voltar</a>
              </div>
            </div>  
    </div>
    </section>
 </div>
<?php require APP_ROOT . '/views/template/end.php';?>
