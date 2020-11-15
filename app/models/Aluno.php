<?php

use App\Helpers\Permissoes;
use App\Models\Model;
use App\Models\Usuario;

class Aluno extends Model
{
    private Usuario $usuarioModel;

    public function __construct()
    {
        parent::__construct();
        $this->usuarioModel = new Usuario;
    }

    /**
     * Busca todos os alunos
     *
     * @return void
     */
    public function buscarTodos()
    {
        $this->db->query("SELECT * FROM aluno");
        $alunos = $this->db->resultset();
        return $alunos;
    }

    /**
     * Busca um Aluno pelo ID
     *
     * @param  mixed $id
     * @return void
     */
    public function buscarPorId($id)
    {
        $this->db->query("SELECT * FROM aluno WHERE id = :id");
        $this->db->bind(':id', $id);
        $aluno = $this->db->single();
        $endereco = $this->buscarEnderecoPorId($aluno['id']);
        if (empty($endereco)) {
            $endereco = [
                'logradouro' => null,
                'numero' => null,
                'bairro' => null,
                'cep' => null,
                'uf' => null,
                'cidade' => null,
                'complemento' => null,
            ];
        }
        $aluno['endereco'] = $endereco;
        return $aluno;
    }

    /**
     * Salva um aluno no banco de dados
     *
     * @param  mixed $aluno
     * @return void
     */
    public function salvar($aluno)
    {
        $this->db->query('INSERT INTO aluno (nome, matricula, cpf, email, celular, sexo, cor, data_nascimento, bloco_id)
        VALUES (:nome, :matricula, :cpf, :email, :celular, :sexo, :cor, :data_nascimento, :bloco_id)');
        $this->db->bind(':nome', $aluno['nome']);
        $this->db->bind(':matricula', $aluno['matricula']);
        $this->db->bind(':cpf', isset($aluno['cpf']) ? $aluno['cpf'] : null);
        $this->db->bind(':email', isset($aluno['email']) ? $aluno['email'] : null);
        $this->db->bind(':celular', isset($aluno['celular']) ? $aluno['celular'] : null);
        $this->db->bind(':sexo', isset($aluno['sexo']) ? $aluno['sexo'] : null);
        $this->db->bind(':cor', isset($aluno['cor']) ? $aluno['cor'] : null);
        $this->db->bind(':data_nascimento', isset($aluno['data_nascimento']) ? $aluno['data_nascimento'] : null);
        $this->db->bind(':bloco_id', $aluno['bloco_id']);
        $this->db->execute();
        if (isset($aluno['endereco'])) {
            $id = $this->db->lastInsertId();
            $this->salvarEndereco($aluno['endereco'], $id);
        }
    }

    /**
     * Atualiza um aluno
     *
     * @param  mixed $aluno
     * @return void
     */
    public function atualizar($aluno)
    {
        $this->db->query('UPDATE aluno SET nome =:nome, matricula =:matricula, cpf=:cpf, email=:email, celular=:celular, sexo=:sexo, cor=:cor, data_nascimento=:data_nascimento, bloco_id=:bloco_id WHERE id =:id');
        $this->db->bind(':id', $aluno['id']);
        $this->db->bind(':nome', $aluno['nome']);
        $this->db->bind(':matricula', $aluno['matricula']);
        $this->db->bind(':cpf', isset($aluno['cpf']) ? $aluno['cpf'] : null);
        $this->db->bind(':email', isset($aluno['email']) ? $aluno['email'] : null);
        $this->db->bind(':celular', isset($aluno['celular']) ? $aluno['celular'] : null);
        $this->db->bind(':sexo', isset($aluno['sexo']) ? $aluno['sexo'] : null);
        $this->db->bind(':data_nascimento', isset($aluno['data_nascimento']) ? $aluno['data_nascimento'] : null);
        $this->db->bind(':cor', isset($aluno['cor']) ? $aluno['cor'] : null);
        $this->db->bind(':bloco_id', $aluno['bloco_id']);
        $this->db->execute();
        $endereco = $this->buscarEnderecoPorId($aluno['id']);
        if (empty($endereco)) {
            $this->salvarEndereco($aluno['endereco'], $aluno['id']);
        } else {
            $this->atualizarEndereco($aluno['endereco'], $aluno['id']);
        }
    }

    /**
     * Salva o endereco do aluno
     *
     * @param  mixed $endereco
     * @param  mixed $alunoId
     * @return void
     */
    public function salvarEndereco($endereco, $alunoId)
    {
        $this->db->query('INSERT INTO endereco (logradouro, numero, cep, bairro, uf, cidade, complemento, aluno_id)
        VALUES (:logradouro, :numero, :cep, :bairro, :uf, :cidade, :complemento, :aluno_id)');
        $this->db->bind(':logradouro', $endereco['logradouro']);
        $this->db->bind(':numero', $endereco['numero']);
        $this->db->bind(':cep', $endereco['cep']);
        $this->db->bind(':bairro', $endereco['bairro']);
        $this->db->bind(':uf', $endereco['uf']);
        $this->db->bind(':cidade', $endereco['cidade']);
        $this->db->bind(':complemento', isset($endereco['complemento']) ? $endereco['complemento'] : null);
        $this->db->bind(':aluno_id', $alunoId);
        $this->db->execute();

    }

    /**
     * Atualiza o endereco do aluno
     *
     * @param  mixed $endereco
     * @param  mixed $alunoId
     * @return void
     */
    public function atualizarEndereco($endereco, $alunoId)
    {
        $this->db->query('UPDATE endereco SET logradouro=:logradouro, numero=:numero, cep=:cep, bairro=:bairro, uf=:uf, cidade=:cidade, complemento=:complemento WHERE aluno_id =:aluno_id');
        $this->db->bind(':aluno_id', $alunoId);
        $this->db->bind(':logradouro', $endereco['logradouro']);
        $this->db->bind(':numero', $endereco['numero']);
        $this->db->bind(':cep', $endereco['cep']);
        $this->db->bind(':bairro', $endereco['bairro']);
        $this->db->bind(':uf', $endereco['uf']);
        $this->db->bind(':cidade', $endereco['cidade']);
        $this->db->bind(':complemento', isset($endereco['complemento']) ? $endereco['complemento'] : null);
        $this->db->execute();

    }

    /**
     * Exclui um aluno do banco de dados e seu endereco caso haja
     *
     * @param  mixed $id
     * @return void
     */
    public function excluir($id)
    {
        $this->excluirEndereco($id);
        $this->db->query('DELETE FROM aluno WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
    }

    /**
     * Exclui um endereco associado a um aluno
     *
     * @param  mixed $id
     * @return void
     */
    public function excluirEndereco($alunoId)
    {
        $this->db->query('DELETE FROM endereco WHERE aluno_id = :aluno_id');
        $this->db->bind(':aluno_id', $alunoId);
        $this->db->execute();
    }

    /**
     * Buscar um aluno pela matricula
     *
     * @param  mixed $matricula
     * @return void
     */
    public function buscarPorMatricula($matricula)
    {
        $this->db->query("SELECT * FROM aluno WHERE matricula = :matricula");
        $this->db->bind(':matricula', $matricula);
        $aluno = $this->db->single();
        $endereco = $this->buscarEnderecoPorId($aluno['id']);
        if (empty($endereco)) {
            $endereco = [
                'logradouro' => null,
                'numero' => null,
                'bairro' => null,
                'cep' => null,
                'uf' => null,
                'cidade' => null,
                'complemento' => null,
            ];
        }
        $aluno['endereco'] = $endereco;
        return $aluno;
    }

    /**
     * Verifica se já existe um aluno com a matricula informada
     *
     * @param  mixed $matricula
     * @return void
     */
    public function seExistePorMatricula($matricula)
    {
        $this->db->query("SELECT * FROM aluno WHERE matricula = :matricula");
        $this->db->bind(':matricula', $matricula);
        $this->db->single();
        return $this->db->rowCount() > 0;

    }

    /**
     * Busca um endereco associado ao id do aluno
     *
     * @param  mixed $id
     * @return void
     */
    public function buscarEnderecoPorId($id)
    {
        $this->db->query("SELECT * FROM endereco WHERE aluno_id = :id");
        $this->db->bind(':id', $id);
        $endereco = $this->db->single();
        return $endereco;
    }

    public function salvarListaExcel($alunos, $bloco)
    {
        foreach ($alunos as $aluno) {
            $matricula = $aluno[0];
            $nome = $aluno[1];
            if (!empty($matricula) and !empty($nome)) {;
                if (!$this->seExistePorMatricula($matricula)) {
                    $aluno = ['matricula' => $matricula, 'nome' => $nome, 'bloco_id' => $bloco];
                    try {
                        $this->salvar($aluno);
                        // Gerar usuario e senha do aluno;
                        $this->usuarioModel->novoUsuario($aluno["matricula"], Permissoes::ALUNO);
                    } catch (\Throwable $th) {
                        $error = 'Não foi possivel salvar o aluno: ' . $aluno['nome'] . ' - ' . $aluno['matricula'];
                        throw new Exception($error);
                    }

                }
            }
        }
    }
}
