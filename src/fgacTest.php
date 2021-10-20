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



require '../vendor/autoload.php';

function logTest($msg) {
   echo "\n";
   echo date('Y-m-d H:i:s') . " - $msg";
   echo "\n";
}

$options = array(
   'timeout' => 60000,
 );
   

###################################################################################################################
# Test 1 -  Invalid API key                                                                                       #
################################################################################################################### 
$apikey = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
    
//Consult
$response = Requests::get('http://localhost/cirs/index.php/Api/users', array('X-API-KEY' => $apikey), $options);

logTest('In this example, we need to receive Error Response: {"status":false,"error":"Invalid API key "}');
//processing
if(isset($response->success) && $response->success == true){
   logTest('Ok!');
   logTest('Response: ' . print_r($response->body, true)); 
} else {
   logTest('Error');
   logTest('Response: ' . print_r($response->body, true));
}






    
