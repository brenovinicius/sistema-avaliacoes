<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Helpers\Cor;
use App\Helpers\FlashMessage;
use App\Helpers\Permissoes;
use App\Helpers\PlanilhaUtils;
use App\Helpers\Sexo;
use App\Helpers\UF;
use App\Models\Bloco;

/**
 * Controller do aluno
 */
class AlunoController extends Controller
{

    private $blocoModel;

    use FlashMessage;

    public function __construct()
    {
        $this->setModel('Aluno');
        $this->blocoModel = new Bloco;
    }

    /**
     * Retorna a página de listagem dos alunos
     *
     * @return void
     */
    public function listar()
    {
        Auth::requerPermissao(Permissoes::ADMIN);
        $alunos = $this->model->buscarTodos();
        $this->view('aluno/listar', ['alunos' => $alunos]);
    }

    /**
     * Retorna a pagina de importação de alunos
     *
     * @return void
     */
    public function importar()
    {
        Auth::requerPermissao(Permissoes::ADMIN);
        $blocos = $this->blocoModel->buscarTodos();
        $this->view('aluno/importar', ["blocos" => $blocos]);
    }
    
    /**
     * Retorna a página de detalhes do usuário
     *
     * @param  mixed $data
     * @return void
     */
    public function detalhar($data)
    {
        Auth::requerPermissao(Permissoes::ADMIN);
        $id = $data['id'];
        $aluno = $this->model->buscarPorId($id);
        $this->view('aluno/detalhar', ['aluno' => $aluno]);
    }
    
    /**
     * Retorna a tela de acesso inicial para o aluno
     *
     * @param  mixed $data
     * @return void
     */
    public function acessoInicial($data)
    {
        Auth::requerPermissao(Permissoes::ALUNO);
        if (Auth::checkAcessoInicial()) {
            $data['acesso_inicial'] = true;
            $aluno = $this->model->buscarPorMatricula($_SESSION['username']);
            $data["aluno"] = $aluno;
            $data["aluno"]["senha"] = "";
            $this->editar($data);
        } else {
            $this->redirect('aluno/dados');
        }
    }
    
    /**
     * Retorna a tela edição dos dados do aluno somente para a permissão ALUNO
     *
     * @param  mixed $data
     * @return void
     */
    public function dados($data)
    {
        Auth::requerPermissao(Permissoes::ALUNO);
        if (Auth::checkAcessoInicial()) {
            $this->redirect("aluno/acesso_inicial");
        }
        $aluno = $this->model->buscarPorMatricula($_SESSION['username']);
        $data['id'] = $aluno['id'];
        $data['aluno_edicao'] = true;
        $data['aluno'] = $aluno;
        $this->editar($data);
    }
    
    /**
     * Retorna a tela edição dos dados aluno.
     *
     * @param  mixed $data
     * @return void
     */
    public function editar($data)
    {
        if (isset($data['acesso_inicial'])) {
            $dados["aluno"] = $data["aluno"];
            $dados["acesso_inicial"] = $data["acesso_inicial"];
        } elseif (isset($data["aluno_edicao"])) {
            $dados["aluno"] = $data["aluno"];
        } else {
            $id = $data["id"];
            $aluno = $this->model->buscarPorId($id);
            $dados = ['aluno' => $aluno];
        }

        $dados['sexo_opcoes'] = Sexo::$opcoes;
        $dados['cor_opcoes'] = Cor::$opcoes;
        $dados['estados'] = UF::$estados;
        $this->view("aluno/editar", $dados);
    }
    
    /**
     * Recebe os dados do aluno e persiste no banco de dados
     *
     * @param  mixed $data
     * @return void
     */
    public function atualizar($data)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Limpar campos
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Capturar dos dados do aluno
            $aluno = [
                'id' => $_POST['id'],
                'nome' => trim($_POST['nome']),
                'matricula' => trim($_POST['matricula']),
                'cpf' => trim($_POST['cpf']),
                'email' => trim($_POST['email']),
                'celular' => trim($_POST['celular']),
                'data_nascimento' => trim($_POST['data_nascimento']),
                'sexo' => $_POST['sexo'],
                'cor' => $_POST['cor'],
                'bloco_id' => $_POST['bloco'],
            ];
            // Capturar dos dados do endereço
            $endereco = [
                'logradouro' => trim($_POST['logradouro']),
                'numero' => trim($_POST['numero']),
                'bairro' => trim($_POST['bairro']),
                'cep' => trim($_POST['cep']),
                'uf' => $_POST['uf'],
                'cidade' => trim($_POST['cidade']),
                'complemento' => trim($_POST['complemento']),
            ];

            // Validações
            $dados['errors'] = [];

            if (empty($aluno['nome'])) {
                $dados['errors']['nome'] = "Insira um nome.";
            }
            if (empty($aluno['matricula'])) {
                $dados['errors']['matricula'] = "Insira a matricula.";
            }
            if (empty($aluno['cpf'])) {
                $dados['errors']['cpf'] = "Insira o CPF";
            } else if (!validaCPF($aluno['cpf'])) {
                $dados['errors']['cpf'] = "CPF é inválido";
            }
            if (empty($aluno['email'])) {
                $dados['errors']['email'] = "Insira o email.";
            } else if (!filter_var($aluno['email'], FILTER_VALIDATE_EMAIL)) {
                $dados['errors']['email'] = "Email inválido";
            }
            if (empty($aluno['celular'])) {
                $dados['errors']['celular'] = "Insira o número do celular.";
            } else if (!validaCelular($aluno['celular'])) {
                $dados['errors']['celular'] = "Número de celular inválido. Digite no padrão: (XX) XXXXX-XXXX";
            }
            if (empty($aluno['data_nascimento'])) {
                $dados['errors']['data_nascimento'] = "Insira a data de nascimento.";
            } else if (!validaData($aluno['data_nascimento'])) {
                $dados['errors']['data_nascimento'] = "Data de nascimento inválida";
            }
            if (empty($aluno['sexo'])) {
                $dados['errors']['sexo'] = "Escolha um sexo.";
            }
            if (empty($aluno['cor'])) {
                $dados['errors']['cor'] = "Escolha uma cor.";
            }
            if (empty($endereco['cep'])) {
                $dados['errors']['endereco']['cep'] = "Digite o CEP";
            } else if (!validaCEP($endereco['cep'])) {
                $dados['errors']['endereco']['cep'] = "CEP inválido";
            }
            if (empty($endereco['logradouro'])) {
                $dados['errors']['endereco']['logradouro'] = "Digite o logradouro";
            }
            if (empty($endereco['numero'])) {
                $dados['errors']['endereco']['numero'] = "Digite o numero";
            }
            if (empty($endereco['uf'])) {
                $dados['errors']['endereco']['uf'] = "Selecione um estado";
            }
            if (empty($endereco['cidade'])) {
                $dados['errors']['endereco']['cidade'] = "Digite uma cidade";
            }
            if (empty($endereco['bairro'])) {
                $dados['errors']['endereco']['bairro'] = "Digite um bairro";
            }

            // Validações de primeiro acesso do aluno
            if (isset($data["acesso_inicial"])) {
                $validacao = Auth::validarSenha($_POST["senha"]);
                if (!empty($validacao)) {
                    $dados['errors']['senha'] = $validacao;
                    $dados['acesso_inicial'] = true;
                }
            }

            if (!empty($dados['errors'])) {
                $dados['sexo_opcoes'] = Sexo::$opcoes;
                $dados['cor_opcoes'] = Cor::$opcoes;
                $dados['estados'] = UF::$estados;
                $dados['aluno'] = $aluno;
                $dados['aluno']['endereco'] = $endereco;
                return $this->view("aluno/editar", $dados);
            }

            //Atualizar
            $aluno['endereco'] = $endereco;
            try {
                $this->model->atualizar($aluno);

                // Primeiro acesso do aluno
                if (isset($data["acesso_inicial"])) {
                    Auth::alterarSenhaDesabilitarAcessoInicial($aluno["matricula"], $_POST["senha"]);
                }

                // Mensagem de retorno conforme o perfil do usuario logado
                if (Auth::temPermissao(Permissoes::ADMIN)) {
                    $this->flashMessage('success', "Aluno atualizado com sucesso.");
                }

                if (Auth::temPermissao(Permissoes::ALUNO)) {
                    $this->flashMessage('success', "Dados atualizados com sucesso.");
                }

            } catch (\Throwable $th) {
                $this->flashMessage('danger', "Erro ao atualizar o aluno.");
            }

            // Redirecionar a pagina conforme o perfil do usuario logado
            if (Auth::temPermissao(Permissoes::ALUNO)) {
                $this->redirect("aluno/dados");
                return;
            }

            if (Auth::temPermissao(Permissoes::ADMIN)) {
                $this->redirect('admin/alunos');
                return;
            }
        }

    }

    /**
     * Recebe os dados os dados do arquivo excel e o bloco
     *
     * @return void
     */
    public function importarSalvar()
    {
        $allowed_mimes = array('application/vnd.ms-excel',
            'application/excel',
            'application/vnd.msexcel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        $blocos = $this->blocoModel->buscarTodos();

        if ($_FILES['arquivo']['size'] == 0) {
            $data = ['arquivo_error' => "Escolha um arquivo antes de enviar", "blocos" => $blocos];
            $this->view("aluno/importar", $data);
            die();
        }

        if (!in_array($_FILES['arquivo']['type'], $allowed_mimes)) {
            $data = ["arquivo_error" => "O tipo de arquivo é inválido. Selecione um arquivo excel.", "blocos" => $blocos];
            $this->view("aluno/importar", $data);
            die();
        }

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $bloco = $_POST['bloco'];

        $alunos = PlanilhaUtils::obterDados($_FILES['arquivo']['tmp_name']); //converte os dados do excel em array
        if (strtolower($alunos[0][0]) == 'matricula' && strtolower($alunos[0][1]) == 'nome') { // verifica se os primeiros valores são as palavras matricula e nome
            $alunos = array_slice($alunos, 1, null); //remove as palavras se necessário
        }

        try {
            $this->model->salvarListaExcel($alunos, $bloco);
            $this->flashMessage('success', "Alunos inseridos com sucesso.");
        } catch (\Throwable $th) {
            $this->flashMessage('danger', $th->getMessage());
        }
        $this->redirect('admin/alunos');

    }
    
    /**
     * Exclui um aluno do banco de dados
     *
     * @param  mixed $data
     * @return void
     */
    public function excluir($data)
    {
        $id = $data["id"];
        try {
            $aluno = $this->model->buscarPorId($id);
            $this->model->excluir($id);
            Auth::excluirUsuario($aluno["matricula"]);
            $this->flashMessage('success', "Aluno excluido com sucesso.");
        } catch (\Throwable $th) {
            $this->flashMessage('danger', "Erro ao excluir o aluno.");
        }
        $this->redirect('admin/alunos');
    }

}
