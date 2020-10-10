<?php

namespace App\Controllers;

/*
 *  Classe que representa o Controller base.
 *  Os controllers da aplicação devem herdar essa classe, se necessário.
 */

class Controller
{

  /**
   * Carrega e instancia o model
   *
   * @param  mixed $model
   * @return void
   */
  public function model($model)
  {
    require_once APP_ROOT . '/models/' . $model . '.php';
    return new $model();
  }

  /**
   * Carrega a view e seus dados
   *
   * @param  mixed $view
   * @param  mixed $data
   * @return void
   */
  public function view($view, $data = [])
  {
    if (file_exists(APP_ROOT . '/views/' . $view . '.php')) {
      require_once APP_ROOT . '/views/' . $view . '.php';
    } else {
      die('Esta view não existe.');
    }
  }
}
