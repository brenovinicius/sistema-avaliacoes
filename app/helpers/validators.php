<?php

function validaCPF($cpf = null)
{

// Verifica se um número foi informado
    if (empty($cpf)) {
        return false;
    }

// Elimina possivel mascara
    $cpf = preg_replace("/[^0-9]/", "", $cpf);
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

// Verifica se o numero de digitos informados é igual a 11
    if (strlen($cpf) != 11) {
        return false;
    }
// Verifica se nenhuma das sequências invalidas abaixo
    // foi digitada. Caso afirmativo, retorna falso
    else if ($cpf == '00000000000' ||
        $cpf == '11111111111' ||
        $cpf == '22222222222' ||
        $cpf == '33333333333' ||
        $cpf == '44444444444' ||
        $cpf == '55555555555' ||
        $cpf == '66666666666' ||
        $cpf == '77777777777' ||
        $cpf == '88888888888' ||
        $cpf == '99999999999') {
        return false;
        // Calcula os digitos verificadores para verificar se o
        // CPF é válido
    } else {

        for ($t = 9; $t < 11; $t++) {

            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }

        return true;
    }
}

function validaCEP($cep)
{
    if(preg_match('/^[0-9]{5,5}([-]?[0-9]{3,3})?$/', $cep)) {
        return true;
    } 
    return false;
}


function validaCelular($celular) {
    if(preg_match('^\(+[0-9]{2,3}\) [0-9]{5}-[0-9]{4}$^', $celular)){
        return true;
    }
    return false;
}

function validaData($date)
{
  // match the format of the date
  if (preg_match ("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $date, $parts))
  {

    // check whether the date is valid or not
    if (checkdate($parts[2],$parts[3],$parts[1])) {
      return true;
    } else {
      return false;
    }

  } else {
    return false;
  }
}