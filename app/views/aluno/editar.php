<?php

use App\Helpers\Permissoes;

require APP_ROOT . '/views/template/init.php';?>
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Atualizar dados</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
    <div class="container-fluid">
    <?php require APP_ROOT . '/views/template/components/messages.php'; ?>
    <?php if(isset($data['acesso_inicial'])) : ?>
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-info"></i>Antes de iniciar, atualize seus dados!</h5>
        </div>
    <?php endif; ?>

    <?php if(!empty($data['errors'])) : ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-info"></i>Corrija os erros no formulário.</h5>
        </div>
    <?php endif; ?>

    <?php if($_SESSION['permissao'] === Permissoes::ADMIN) : ?>
      <form action="<?php echo '/admin/alunos/'. $data['aluno']['id']; ?>" method="POST">
    <?php endif; ?>
    <?php if($_SESSION['permissao'] === Permissoes::ALUNO) : ?>
      <form action="<?php echo '/aluno/dados' ?>" method="POST">
    <?php endif; ?>
      <div class="card card-secondary">
        <div class="card-body">
              <input type="hidden" name="id" value="<?php echo $data['aluno']['id']; ?>">
              <input type="hidden" name="bloco" value="<?php echo $data['aluno']['bloco_id']; ?>">
              <?php if(isset($data['acesso_inicial'])) : ?>
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
              <div class="form-group">
                <input type="hidden" name="acesso_inicial" value="true">
                <label for="senha">Nova Senha</label>
                <input type="password" name="senha" class="form-control form-control-border <?php echo (!empty($data['errors']['senha'])) ? 'is-invalid' : ''; ?>" 
                    id="senha" placeholder="Insira uma nova senha" required>
                    <?php echo (!empty($data['errors']['senha'])) ? "<span class='error invalid-feedback'>" . $data['errors']['senha'] . "</span>" : ""; ?>
              </div>
              <hr/>
              <?php endif; ?>
              <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" value="<?php echo $data['aluno']['nome']; ?>" 
                    class="form-control form-control-border <?php echo (!empty($data['errors']['nome'])) ? 'is-invalid' : ''; ?>" 
                    id="nome" placeholder="Digite seu nome..." required readonly>
                    <?php echo (!empty($data['errors']['nome'])) ? "<span class='error invalid-feedback'>" . $data['errors']['nome'] . "</span>" : ""; ?>
              </div>
              <div class="form-group">
                <label for="matricula">Matrícula</label>
                <input type="text" name="matricula" value="<?php echo $data['aluno']['matricula']; ?>" 
                class="form-control form-control-border <?php echo (!empty($data['errors']['matricula'])) ? 'is-invalid' : ''; ?>" id="matricula" readonly required>
                <?php echo (!empty($data['errors']['matricula'])) ? "<span class='error invalid-feedback'>" . $data['errors']['matricula'] . "</span>" : ""; ?>
              </div>
              <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" name="cpf" id="cpf" value="<?php echo $data['aluno']['cpf']; ?>" 
                class="form-control form-control-border <?php echo (!empty($data['errors']['cpf'])) ? 'is-invalid' : ''; ?>" 
                id="cpf" placeholder="Digite seu cpf..." required>
                <?php echo (!empty($data['errors']['cpf'])) ? "<span class='error invalid-feedback'>" . $data['errors']['cpf'] . "</span>" : ""; ?>
              </div>      
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" value="<?php echo $data['aluno']['email']; ?>" 
                class="form-control form-control-border <?php echo (!empty($data['errors']['email'])) ? 'is-invalid' : ''; ?>" 
                id="email" placeholder="Digite seu email..." required>
                <?php echo (!empty($data['errors']['email'])) ? "<span class='error invalid-feedback'>" . $data['errors']['email'] . "</span>" : ""; ?>
              </div>
              <div class="form-group">
                <label for="celular">Celular</label>
                <input type="text" name="celular" id="celular" value="<?php echo $data['aluno']['celular']; ?>" 
                class="form-control form-control-border <?php echo (!empty($data['errors']['celular'])) ? 'is-invalid' : ''; ?>"
                id="celular" placeholder="Digite seu celular..." required>
                <?php echo (!empty($data['errors']['celular'])) ? "<span class='error invalid-feedback'>" . $data['errors']['celular'] . "</span>" : ""; ?>
              </div>
              <div class="form-group">
                <label for="data_nascimento">Data de Nascimento</label>
                <input type="date" name="data_nascimento" 
                value="<?php echo $data['aluno']['data_nascimento']; ?>" 
                class="form-control form-control-border <?php echo (!empty($data['errors']['data_nascimento'])) ? 'is-invalid' : ''; ?>" 
                id="data_nascimento" required>
                <?php echo (!empty($data['errors']['data_nascimento'])) ? "<span class='error invalid-feedback'>" . $data['errors']['data_nascimento'] . "</span>" : ""; ?>
              </div>
              <div class="form-group">
                <label for="sexo">Sexo</label>
                <select class="form-control <?php echo (!empty($data['errors']['sexo'])) ? 'is-invalid' : ''; ?>" name="sexo">
                    <option value="">Selecione</option>
                    <?php foreach ($data['sexo_opcoes'] as $key => $value): ?> 
                        <option value="<?php echo $key ?>" <?php echo ($data['aluno']['sexo']) == $key ? "selected" : ""; ?> ><?php echo $value ?></option>
                    <?php endforeach;?>
                </select>
                <?php echo (!empty($data['errors']['sexo'])) ? "<span class='error invalid-feedback'>" . $data['errors']['sexo'] . "</span>" : ""; ?>
            </div>
              <div class="form-group">
                <label for="cor">Cor</label>
                <select class="form-control <?php echo (!empty($data['errors']['cor'])) ? 'is-invalid' : ''; ?>" name="cor">
                    <option value="">Selecione</option>
                    <?php foreach ($data['cor_opcoes'] as $cor): ?> 
                        <option value="<?php echo $cor ?>"  <?php echo ($data['aluno']['cor']) == $cor ? "selected" : ""; ?> ><?php echo $cor ?></option>
                    <?php endforeach;?>
                </select>
                <?php echo (!empty($data['errors']['cor'])) ? "<span class='error invalid-feedback'>" . $data['errors']['cor'] . "</span>" : ""; ?>
              </div>
              <div class="form-group">
                <label for="cep">CEP</label>
                <input type="text" name="cep" id="cep" value="<?php echo $data['aluno']['endereco']['cep']; ?>"
                class="form-control <?php echo (!empty($data['errors']['endereco']['cep'])) ? 'is-invalid' : ''; ?>" 
                id="cep" placeholder="Digite o cep...">
                 <?php echo (!empty($data['errors']['endereco']['cep'])) ? "<span class='error invalid-feedback'>" . $data['errors']['endereco']['cep'] . "</span>" : ""; ?>
              </div>
              <div class="form-group">
                <label for="logradouro">Logradouro</label>
                <input name="logradouro" type="text" 
                value="<?php echo $data['aluno']['endereco']['logradouro']; ?>"
                class="form-control <?php echo (!empty($data['errors']['endereco']['logradouro'])) ? 'is-invalid' : ''; ?>" 
                id="logradouro" placeholder="Digite o logradouro..." required>
                <?php echo (!empty($data['errors']['endereco']['logradouro'])) ? "<span class='error invalid-feedback'>" . $data['errors']['endereco']['logradouro'] . "</span>" : ""; ?>
              </div>
              <div class="form-group">
                <label for="numero">Número</label>
                <input name="numero" type="text" 
                value="<?php echo $data['aluno']['endereco']['numero']; ?>"
                class="form-control <?php echo (!empty($data['errors']['endereco']['numero'])) ? 'is-invalid' : ''; ?>" 
                id="numero" placeholder="Digite o número da residência..." required>
                <?php echo (!empty($data['errors']['endereco']['numero'])) ? "<span class='error invalid-feedback'>" . $data['errors']['endereco']['numero'] . "</span>" : ""; ?>
              </div>
              <div class="form-group">
                <label for="bairro">Bairro</label>
                <input name="bairro" type="text"
                value="<?php echo $data['aluno']['endereco']['bairro']; ?>"
                class="form-control <?php echo (!empty($data['errors']['endereco']['bairro'])) ? 'is-invalid' : ''; ?>"  
                id="bairro" placeholder="Digite o bairro..." required>
                <?php echo (!empty($data['errors']['endereco']['bairro'])) ? "<span class='error invalid-feedback'>" . $data['errors']['endereco']['bairro'] . "</span>" : ""; ?>
              </div>
              <div class="form-group">
                <label for="uf">Estado</label>
                <select class="form-control <?php echo (!empty($data['errors']['endereco']['uf'])) ? 'is-invalid' : ''; ?>" id="uf" name="uf">
                  <option value="">Selecione</option>
                  <?php foreach ($data['estados'] as $estado): ?> 
                        <option value="<?php echo $estado['sigla'] ?>" <?php echo ($data['aluno']['endereco']['uf']) == $estado['sigla'] ? "selected" : ""; ?> ><?php echo $estado['nome'] ?></option>
                    <?php endforeach;?>
              </select>
              <?php echo (!empty($data['errors']['endereco']['uf'])) ? "<span class='error invalid-feedback'>" . $data['errors']['endereco']['uf'] . "</span>" : ""; ?>
              </div>
              <div class="form-group">
                <label for="cidade">Cidade</label>
                <input name="cidade" type="text" 
                value="<?php echo $data['aluno']['endereco']['cidade']; ?>"
                class="form-control <?php echo (!empty($data['errors']['endereco']['cidade'])) ? 'is-invalid' : ''; ?>"
                id="cidade" required>
                <?php echo (!empty($data['errors']['endereco']['cidade'])) ? "<span class='error invalid-feedback'>" . $data['errors']['endereco']['cidade'] . "</span>" : ""; ?>
              </div>
              <div class="form-group">
                <label for="complemento">Complemento</label>
                <input name="complemento" type="text" class="form-control form-control-border" id="complemento">
              </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a class="btn btn-secondary" id="voltar" href="javascript:history.back()">Cancelar</a>
        </div>
      </div>
    </form>
    </div>
    </section>
 </div>


<?php require APP_ROOT . '/views/template/end.php';?>
