<?php

namespace App\Controllers;

/**
 * Controller principal da aplicação
 */
class AppController extends Controller
{

    /**
     * Retorna a página principal
     *
     * @return void
     */
    public function index()
    {
        $this->view('home');
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
