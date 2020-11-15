<?php

namespace App\Models;

use App\Core\Auth;
use App\Core\Database;

class Usuario
{
    private $db;

    public function __construct()
    {
        $this->db = Database::get();
    }
    
    /**
     * Retorna a quantidade de usuário encontrados com o username informado
     *
     * @param  mixed $username
     * @return void
     */
    public function getCountByUsername($username)
    {
        $this->db->query("SELECT * FROM usuario WHERE username = :username");
        $this->db->bind(':username', $username);
        $this->db->execute();
        return $this->db->rowCount();
    }
    
    /**
     * Busca o usuário pelo username informado
     *
     * @param  mixed $username
     * @return void
     */
    public function buscarUsuario($username)
    {
        $this->db->query("SELECT * FROM usuario WHERE username = :username");
        $this->db->bind(':username', $username);
        $usuario = $this->db->single();
        return $usuario;
    }
    
    /**
     * Persiste o usuário no banco de dados
     *
     * @param  mixed $usuario
     * @return void
     */
    public function salvar($usuario)
    {
        $this->db->query('INSERT INTO usuario (username, permissao, senha, status, acesso_inicial)
        VALUES (:username, :permissao, :senha, :status, :acesso_inicial)');
        $this->db->bind(':username', $usuario['username']);
        $this->db->bind(':permissao', $usuario['permissao']);
        $this->db->bind(':senha', $usuario['senha']);
        $this->db->bind(':status', $usuario['status']);
        $this->db->bind(':acesso_inicial', $usuario['acesso_inicial']);
        $this->db->execute();
    }
    
    /**
     * Atualiza o usuário no banco de dados
     *
     * @param  mixed $usuario
     * @return void
     */
    public function atualizar($usuario)
    {
        $this->db->query('UPDATE usuario SET username=:username, permissao=:permissao, senha=:senha, status=:status, acesso_inicial=:acesso_inicial WHERE id =:id');
        $this->db->bind(':id', $usuario['id']);
        $this->db->bind(':username', $usuario['username']);
        $this->db->bind(':permissao', $usuario['permissao']);
        $this->db->bind(':senha', $usuario['senha']);
        $this->db->bind(':status', $usuario['status']);
        $this->db->bind(':acesso_inicial', $usuario['acesso_inicial']);
        $this->db->execute();
    }
    
    /**
     * Cria um novo usuário no banco de dados
     *
     * @param  mixed $username
     * @param  mixed $permissao
     * @return void
     */
    public function novoUsuario($username, $permissao)
    {
        $usuario['username'] = $username;
        $usuario['permissao'] = $permissao;
        $usuario['senha'] = Auth::encodePassword($username);
        $usuario['status'] = true;
        $usuario['acesso_inicial'] = true;
        $this->salvar($usuario);
    }
    
    /**
     * Exclui o usuário do banco de dados
     *
     * @param  mixed $id
     * @return void
     */
    public function excluir($id)
    {
        $this->db->query('DELETE FROM usuario WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
    }
}
