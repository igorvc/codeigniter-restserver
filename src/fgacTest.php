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

$options = array(
   'timeout' => 60000,
 );
   
$apikey = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
    
//executando a consulta
$response = Requests::get('http://localhost/cirs/Api/users', array('X-API-KEY' => $apikey), $options);

//processando a resposta
if(isset($response->success) && $response->success == true){
   echo 'Ok!';
   echo 'Response: ', print_r($response->body, true); 
} else {
   echo 'Error';
   echo 'Response: ', print_r($response->body, true);
}

    
