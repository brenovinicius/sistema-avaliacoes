  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
    <li class="nav-item dropdown">
            <a id="username-dropdown" href="#" data-toggle="dropdown" aria-haspopup="true" 
            aria-expanded="false" class="nav-link dropdown-toggle"><?php echo $_SESSION['username'] ?></a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
              <li><a href="/alterar_senha" class="dropdown-item">Alterar Senha</a></li>
              <li class="dropdown-divider"></li>
              <li><a href="/logout" class="dropdown-item">Sair</a></li>
            </ul>
          </li>
    </ul>
  </nav>
  <!-- /.navbar -->