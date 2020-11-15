<?php

require __DIR__ . "/../vendor/autoload.php";

use CoffeeCode\Router\Router;

session_start();

// Instanciando o Router
$router = new Router(APP_URL);

//Configuração do namespace dos controllers
$router->namespace("App\Controllers");

// Rotas do principais do sistema
$router->group(null);
$router->get("/", "AppController:index");
$router->get("/login", "AppController:login");
$router->post("/login", "AppController:singIn");
$router->get("/logout", "AppController:singOut");
$router->get("/alterar_senha", "AppController:alterarSenha");
$router->post("/alterar_senha", "AppController:alterarSenhaSalvar");


// Rotas para o usuário admin
$router->group("/admin");

// Rotas para o usuário admin gerenciar alunos
$router->get("/alunos", "AlunoController:listar");
$router->get("/alunos/{id}", "AlunoController:editar");
$router->post("/alunos/{id}", "AlunoController:atualizar");
$router->delete("/alunos/{id}", "AlunoController:excluir");
$router->get("/alunos/{id}/detalhar", "AlunoController:detalhar");
$router->get("/alunos/importar", "AlunoController:importar");
$router->post("/alunos/importar", "AlunoController:importarSalvar");

// Rotas para usuário aluno
$router->group("/aluno");
$router->get("/acesso_inicial", "AlunoController:acessoInicial");
$router->get("/dados", "AlunoController:dados");
$router->post("/dados", "AlunoController:atualizar");


// Rota para erros
$router->group("error");
$router->get("/{code}", "AppController:error");

// Router Dispatcher
$router->dispatch();

// Redirecionamento para páginas de erro
if ($router->error()) {
    $router->redirect("/error/{$router->error()}");
}