<?php

namespace App\Helpers;

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class PlanilhaUtils {

    private static Xlsx $xlsx;

    public static function getReader(): Xlsx {
        if (!isset(self::$xlsx)) :
			self::$xlsx = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		endif;
		return self::$xlsx;
        
    }
    
    /**
     * Retorna um array com os dados da panilha. 
     *
     * @param mixed $arquivo
     * @return array
     */
    public static function obterDados($arquivo): array  {
        $leitor = self::getReader();
        $leitor->setReadDataOnly(true);
        $planilha = $leitor->load($arquivo);
        return $planilha->getActiveSheet()->toArray();
    }
}