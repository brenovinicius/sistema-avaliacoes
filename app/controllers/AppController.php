<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Helpers\FlashMessage;
use App\Helpers\Permissoes;

/**
 * Controller principal da aplicação
 */
class AppController extends Controller
{

    use FlashMessage;

    /**
     * Retorna a página principal
     *
     * @return void
     */
    public function index()
    {
        Auth::requerLogin();
        $this->view('home');
    }
    
    /**
     * Retorna a página de login
     *
     * @return void
     */
    public function login()
    {
        $this->view('login');
    }
    
    /**
     * Autoriza o usuário a acessar o sistema e o redireciona para sua página específica
     *
     * @param  mixed $data
     * @return void
     */
    public function singIn($data)
    {
        if (isset($data['login'])) {
            if (empty($data['username']) or empty($data['senha'])) {
                $this->flashMessage('danger', "Email e senha são obrigatórios.");
                $this->redirect('login');
            }
            $username = $data['username'];
            $password = $data['senha'];
            if (Auth::login($username, $password)) {

                switch ($_SESSION['permissao']) {
                    case (Permissoes::ADMIN):
                        $this->redirect("");
                        break;
                    case (Permissoes::ALUNO):
                        if ($_SESSION['acesso_inicial']) {
                            $this->redirect('aluno/acesso_inicial');
                        } else {
                            $this->redirect("");
                        }
                        break;
                }
                return;
            }
        }
        $this->flashMessage('danger', "Usuário ou senha inválidos."); //Change for validation
        $this->redirect('login');
    }
    
    /**
     * Faz o logoff
     *
     * @return void
     */
    public function singOut()
    {
        Auth::requerLogin();
        Auth::logout();
        $this->redirect('login');
    }
    
    /**
     * Retorna a página para troca de senha
     *
     * @return void
     */
    public function alterarSenha()
    {
        Auth::requerLogin();
        $this->view("alterar_senha");
    }
    
    /**
     * Recebe a nova senha e altera no banco de dados
     *
     * @return void
     */
    public function alterarSenhaSalvar()
    {
        Auth::requerLogin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Limpar campos
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $senhaAtual = $_POST['senha_atual'];
            $senhaNova = $_POST['senha_nova'];
            $senhaConfirmacao = $_POST['senha_confirmacao'];

            // Validações
            $dados['errors'] = [];

            if (empty($senhaAtual)) {
                $dados['errors']['senha_atual'] = "Insira um a senha atual.";
            }

            if (!Auth::verficarLoginSenhaValidos($_SESSION["username"], $senhaAtual)) {
                $dados['errors']['senha_atual'] = "A senha atual está incorreta.";
            }

            $validacao = Auth::validarSenha($senhaNova);
            if (!empty($validacao)) {
                $dados['errors']['senha_nova'] = $validacao;
            }

            if($senhaNova != $senhaConfirmacao) {
                $dados['errors']['senha_confirmacao'] = "A confirmação de senha não confere.";
            }

            if (!empty($dados['errors'])) {
                return $this->view("alterar_senha", $dados);
            }
            try {
                Auth::alterarSenhaDesabilitarAcessoInicial($_SESSION['username'], $senhaNova);
                $this->flashMessage('success', "Senha alterada com sucesso. Válida a partir do próximo login.");
            } catch (\Throwable $th) {
                $this->flashMessage('danger', "Erro ao alterar a senha.");
            }
            $this->redirect('alterar_senha');
        }
    }

    /**
     * Retorna as páginas de erros
     *
     * @param  mixed $data
     * @return void
     */
    public function error($data)
    {
        $code = $data["code"];
        $this->view("errors/{$code}");
    }
}
