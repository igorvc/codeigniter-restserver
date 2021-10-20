<?php

/**
 * CodeIgniter Rest Controller (FGAC)
 *
 * @link            https://github.com/igorvc/codeigniter-restserver/
 *
 * @version         1.0.0
 * @author    Igor V. Custodio <igorvc@vulcanno.com.br>
 * @license   The MIT License
 */



require APPPATH . '../vendor/autoload.php';


   
$apikey = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
    
    //executando a consulta
    $response = Requests::get('https://ws.icmc.usp.br/wsicmc/Grad/listarCursos', array('ICMC-SAPI-KEY' => $apikey), $options);

    //processando a resposta
    if(isset($response->success) && $response->success == true){
       echo 'Ok!';
       echo 'Esta é a resposta: ', print_r($response->body, true); 
    } else {
       echo 'Erro';
       echo 'Esta foi o erro apontado: ', print_r($response->body, true);
    }

    
