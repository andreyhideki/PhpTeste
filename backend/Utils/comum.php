<?php

namespace backend\Utils;

function retornaDiaDaSemana(){
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');
    echo strftime('%A, %d de %B de %Y', strtotime('today'));
}

// echo retornaDiaDaSemana(); //date('d/m/Y');