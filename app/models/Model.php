<?php

namespace App\Models;

use App\Core\Database;

/*
 *  Classe que representa o Model base.
 *  Os Models da aplicação devem herdar essa classe.
 */

class Model
{

    protected Database $db;

    public function __construct()
    {
        $this->db = Database::get();
    }
}
