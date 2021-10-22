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

logTest('(1) In this example, we need to receive Error Response: {"status":false,"error":"Invalid API key "}');
//processing
if(isset($response->success) && $response->success == true){
   logTest('Ok!');
   logTest('Response: ' . print_r($response->body, true)); 
} else {
   logTest('Error');
   logTest('Response: ' . print_r($response->body, true));
}

###################################################################################################################
# Test 2 -  Using root (id=1) Key                                                                                 #
################################################################################################################### 
$apikey = 'a50348e70dc84e99496db527055a65db';
    
//Consult
$response = Requests::get('http://localhost/cirs/index.php/Api/users', array('X-API-KEY' => $apikey), $options);

logTest('(2) Using root (id=1) Key, expected Ok!');
//processing
if(isset($response->success) && $response->success == true){
   logTest('Ok!');
   logTest('Response: ' . print_r($response->body, true)); 
} else {
   logTest('Error');
   logTest('Response: ' . print_r($response->body, true));
}

###################################################################################################################
# Test 3 -  2º Key access specific Controller                                                                     #
################################################################################################################### 
$apikey = 'c5ba6c0463e35622f9c89bbda027b9b9';
    
//Consult
$response = Requests::get('http://localhost/cirs/index.php/Api/users', array('X-API-KEY' => $apikey), $options);

logTest('(3) Using Key (id=2), expected Ok!');
//processing
if(isset($response->success) && $response->success == true){
   logTest('Ok!');
   logTest('Response: ' . print_r($response->body, true)); 
} else {
   logTest('Error');
   logTest('Response: ' . print_r($response->body, true));
}

###################################################################################################################
# Test 4 -  3º Key access specific Controller/Method                                                                     #
################################################################################################################### 
$apikey = 'a4b5d7002911890ae82acc3e54392c5f';
    
//Consult
$response = Requests::get('http://localhost/cirs/index.php/Api/users', array('X-API-KEY' => $apikey), $options);

logTest('(4) Using Key (id=3), expected Ok!');
//processing
if(isset($response->success) && $response->success == true){
   logTest('Ok!');
   logTest('Response: ' . print_r($response->body, true)); 
} else {
   logTest('Error');
   logTest('Response: ' . print_r($response->body, true));
}


###################################################################################################################
# Test 5 -  Using root (id=1) Key                                                                                 #
################################################################################################################### 
$apikey = 'a50348e70dc84e99496db527055a65db';
    
//Consult
$response = Requests::get('http://localhost/cirs/index.php/Api/usersRestrict', array('X-API-KEY' => $apikey), $options);

logTest('(5) Using root (id=1) Key on usersRestrict, expected Ok!');
//processing
if(isset($response->success) && $response->success == true){
   logTest('Ok!');
   logTest('Response: ' . print_r($response->body, true)); 
} else {
   logTest('Error');
   logTest('Response: ' . print_r($response->body, true));
}

###################################################################################################################
# Test 6 -  2º Key access specific Controller                                                                     #
################################################################################################################### 
$apikey = 'c5ba6c0463e35622f9c89bbda027b9b9';
    
//Consult
$response = Requests::get('http://localhost/cirs/index.php/Api/usersRestrict', array('X-API-KEY' => $apikey), $options);

logTest('(6) Using Key (id=2) on usersRestrict, expected Ok!');
//processing
if(isset($response->success) && $response->success == true){
   logTest('Ok!');
   logTest('Response: ' . print_r($response->body, true)); 
} else {
   logTest('Error');
   logTest('Response: ' . print_r($response->body, true));
}

###################################################################################################################
# Test 7 -  3º Key access specific Controller/Method                                                                     #
################################################################################################################### 
$apikey = 'a4b5d7002911890ae82acc3e54392c5f';
    
//Consult
$response = Requests::get('http://localhost/cirs/index.php/Api/usersRestrict', array('X-API-KEY' => $apikey), $options);

logTest('(7) Using Key (id=3) on usersRestrict, expected {"status":false,"error":"This API key does not have access to the requested controller"}');
//processing
if(isset($response->success) && $response->success == true){
   logTest('Ok!');
   logTest('Response: ' . print_r($response->body, true)); 
} else {
   logTest('Error');
   logTest('Response: ' . print_r($response->body, true));
}

###################################################################################################################
# Test 8 -  Using root (id=1) Key                                                                                 #
################################################################################################################### 
$apikey = 'a50348e70dc84e99496db527055a65db';
    
//Consult
$response = Requests::get('http://localhost/cirs/index.php/Api/usersRestrict/id/1', array('X-API-KEY' => $apikey), $options);

logTest('(8) Using root (id=1) Key on usersRestrict, expected Ok!');
//processing
if(isset($response->success) && $response->success == true){
   logTest('Ok!');
   logTest('Response: ' . print_r($response->body, true)); 
} else {
   logTest('Error');
   logTest('Response: ' . print_r($response->body, true));
}

###################################################################################################################
# Test 9 -  2º Key access specific Controller                                                                     #
################################################################################################################### 
$apikey = 'c5ba6c0463e35622f9c89bbda027b9b9';
    
//Consult
$response = Requests::get('http://localhost/cirs/index.php/Api/usersRestrict/id/1', array('X-API-KEY' => $apikey), $options);

logTest('(9) Using Key (id=2) on usersRestrict, expected Ok!');
//processing
if(isset($response->success) && $response->success == true){
   logTest('Ok!');
   logTest('Response: ' . print_r($response->body, true)); 
} else {
   logTest('Error');
   logTest('Response: ' . print_r($response->body, true));
}

###################################################################################################################
# Test 10 -  3º Key access specific Controller/Method                                                                     #
################################################################################################################### 
$apikey = 'a4b5d7002911890ae82acc3e54392c5f';
    
//Consult
$response = Requests::get('http://localhost/cirs/index.php/Api/usersRestrict/id/1', array('X-API-KEY' => $apikey), $options);

logTest('(10) Using Key (id=3) on usersRestrict, expected {"status":false,"error":"This API key does not have access to the requested controller"}');
//processing
if(isset($response->success) && $response->success == true){
   logTest('Ok!');
   logTest('Response: ' . print_r($response->body, true)); 
} else {
   logTest('Error');
   logTest('Response: ' . print_r($response->body, true));
}

    
###################################################################################################################
# Test 11 -  Using root (id=1) Key                                                                                 #
################################################################################################################### 
$apikey = 'a50348e70dc84e99496db527055a65db';
    
//Consult
$response = Requests::get('http://localhost/cirs/index.php/Api/users/id/1', array('X-API-KEY' => $apikey), $options);

logTest('(2) Using root (id=1) Key, expected Ok!');
//processing
if(isset($response->success) && $response->success == true){
   logTest('Ok!');
   logTest('Response: ' . print_r($response->body, true)); 
} else {
   logTest('Error');
   logTest('Response: ' . print_r($response->body, true));
}

###################################################################################################################
# Test 12 -  2º Key access specific Controller                                                                     #
################################################################################################################### 
$apikey = 'c5ba6c0463e35622f9c89bbda027b9b9';
    
//Consult
$response = Requests::get('http://localhost/cirs/index.php/Api/users/id/1', array('X-API-KEY' => $apikey), $options);

logTest('(12) Using Key (id=2), expected Ok!');
//processing
if(isset($response->success) && $response->success == true){
   logTest('Ok!');
   logTest('Response: ' . print_r($response->body, true)); 
} else {
   logTest('Error');
   logTest('Response: ' . print_r($response->body, true));
}

###################################################################################################################
# Test 13 -  3º Key access specific Controller/Method                                                                     #
################################################################################################################### 
$apikey = 'a4b5d7002911890ae82acc3e54392c5f';
    
//Consult
$response = Requests::get('http://localhost/cirs/index.php/Api/users/id/1', array('X-API-KEY' => $apikey), $options);

logTest('(13) Using Key (id=3), expected Ok!');
//processing
if(isset($response->success) && $response->success == true){
   logTest('Ok!');
   logTest('Response: ' . print_r($response->body, true)); 
} else {
   logTest('Error');
   logTest('Response: ' . print_r($response->body, true));
}