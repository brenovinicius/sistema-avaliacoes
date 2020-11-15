<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo APP_URL; ?>" class="brand-link">
      <img src="/img/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">
<?php
use App\Helpers\Permissoes;
echo APP_NAME; ?>
</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <?php if($_SESSION['permissao'] === Permissoes::ADMIN) : ?>
        <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-graduate"></i>
              <p>
              Alunos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/alunos" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/alunos/importar" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Importar</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chalkboard-teacher"></i>
              <p>
              Professores
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Importar</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-cog"></i>
              <p>
              Funcionários
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Importar</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-line"></i>
              <p>Relatórios</p>
            </a>
          </li>
          <?php endif; ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tasks"></i>
              <p>Avaliações</p>
            </a>
          </li>
          <?php if($_SESSION['permissao'] === Permissoes::ALUNO) : ?>
            <li class="nav-item">
            <a href="/aluno/dados" class="nav-link">
            <i class="nav-icon fas fa-user-cog"></i>
              <p>Meus dados</p>
            </a>
          </li>
          <?php endif; ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>