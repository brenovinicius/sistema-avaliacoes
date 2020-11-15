<?php

namespace App\Core;

use App\Models\Usuario;

class Auth
{

    public static $userModel;
    
    /**
     * Verifica se o usuario e senha informados existem no banco de dados e são válidos
     * Em caso afirmativo adiciona os dados a sessão e return true. Se não somente retorna false.
     *
     * @param  mixed $username
     * @param  mixed $senha
     * @return void
     */
    public static function login($username, $senha)
    {
        $usuario = self::getUserModel()->buscarUsuario($username);
        if ($usuario) {
            if (self::checkPassword($senha, $usuario['senha']) && $usuario['status']) {
                $_SESSION['auth'] = true;
                $_SESSION['permissao'] = $usuario['permissao'];
                $_SESSION['username'] = $usuario['username'];
                $_SESSION['acesso_inicial'] = $usuario['acesso_inicial'];
                $_SESSION['user_id'] = $usuario['id'];
                return true;
            }
        }
        return false;
    }
    
    /**
     * Válida os requisitos para a senha
     *
     * @param  mixed $password
     * @return void
     */
    public static function validarSenha($password) {
        $err = "";
        if(!empty($password) && $password != "" ) {
            if (strlen($password) < 8) {
                $err = "A senha deve ter pelo menos 8 caracteres";
            }
            elseif(!preg_match("#[0-9]+#",$password)) {
                $err = "A senha deve ter pelo menos um número.";
            }
            elseif(!preg_match("#[A-Z]+#",$password)) {
                $err = "A senha deve ter pelo menos uma letra maiúscula.";
            }
            elseif(!preg_match("#[a-z]+#",$password)) {
                $err = "A senha deve ter pelo menos uma letra minúscula.";
            }
        }else{
            $err = "Insira a senha";
        }
        return $err;
    }
    
    /**
     * Verifica se o atributo acesso_inicial existe na sessão
     *
     * @return void
     */
    public static function checkAcessoInicial()
    {
        return $_SESSION['acesso_inicial'];
    }
    
    /**
     * Retorna o usuário logado
     *
     * @return void
     */
    public static function buscarUsuarioLogado()
    {
        return self::getUserModel()->buscarUsuario($_SESSION['username']);
    }
    
    /**
     * Verifica se a permissão informada por parametro é igual a presente na sessão
     *
     * @param  mixed $permissao
     * @return void
     */
    public static function temPermissao($permissao)
    {
        return $_SESSION['permissao'] === $permissao;
    }
    
    /**
     * Verifica se a permissão informada por parametro é igual a presente na sessão
     * Redireciona para a página 403 caso a condição anterior não seja atendida.
     *
     * @param  mixed $permissao
     * @return void
     */
    public static function requerPermissao($permissao)
    {
        if (!self::temPermissao($permissao)) {
            header('location: ' . APP_URL . '/error/403');
        }
    }
    
    /**
     * Verifica se o usuário está logado. Caso não esteja redireciona para a tela de login
     *
     * @return void
     */
    public static function requerLogin()
    {
        if (!isset($_SESSION['auth'])) {
            header('location: ' . APP_URL . '/' . 'login');
        };
    }
    
    /**
     * Altera a senha do usuário.
     *
     * @param  mixed $username
     * @param  mixed $password
     * @return void
     */
    public static function alterarSenha($username, $password) {
        $usuario = self::getUserModel()->buscarUsuario($username);
        $usuario["senha"] = self::encodePassword($password);
        self::getUserModel()->atualizar($usuario);
    }
    
    /**
     * Altera a senha do usuário e desabilita seu acesso inicial
     *
     * @param  mixed $username
     * @param  mixed $password
     * @return void
     */
    public static function alterarSenhaDesabilitarAcessoInicial($username, $password) {
        $usuario = self::getUserModel()->buscarUsuario($username);
        $usuario["senha"] = self::encodePassword($password);
        $usuario["acesso_inicial"] = false;
        self::getUserModel()->atualizar($usuario);
        $_SESSION['acesso_inicial'] = $usuario['acesso_inicial'];
    }
    
    /**
     * Retorna a atual permissão do usuário logado
     *
     * @return void
     */
    public static function permissaoUsuario()
    {
        return $_SESSION['permissao'];
    }
    
    /**
     * Destroi a sessão e seu dados. O usuário será deslogado do sistema.
     *
     * @return void
     */
    public static function logout()
    {
        session_destroy();
    }
    
    /**
     * Verifica se o login e senha informados existem no banco de dados
     * A senha será codificada nesse métodos
     *
     * @param  mixed $username
     * @param  mixed $password
     * @return void
     */
    public static function verficarLoginSenhaValidos($username, $password) {
        $usuario = self::getUserModel()->buscarUsuario($username);
        if ($usuario) {
            if (self::checkPassword($password, $usuario["senha"])) {
                return true;
            }
        }
        return false;   
    }
    
    /**
     * Compara as senha informada são iguais quando codificadas
     *
     * @param  mixed $password
     * @param  mixed $pass
     * @return void
     */
    public static function checkPassword($password, $pass)
    {
        return password_verify($password, $pass);
    }
    
    /**
     * Cria o hash para a senha informada
     *
     * @param  mixed $password
     * @return void
     */
    public static function encodePassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    
    /**
     * Exclui o usuário do banco de dados
     *
     * @param  mixed $username
     * @return void
     */
    public static function excluirUsuario($username) {
        $usuario = self::getUserModel()->buscarUsuario($username);
        self::getUserModel()->excluir($usuario["id"]);
    }
    
    private static function getUserModel()
    {
        if (self::$userModel == null) {
            self::$userModel = new Usuario();
        }
        return self::$userModel;
    }

}
