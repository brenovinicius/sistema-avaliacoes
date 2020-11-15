<?php

namespace App\Models;

use App\Models\Model;

class Bloco extends Model
{
    /**
     * Busca todos os blocos
     *
     * @return void
     */
    public function buscarTodos()
    {
        $this->db->query("SELECT id FROM bloco");
        $blocos = $this->db->resultset();
        return $blocos;
    }

}
