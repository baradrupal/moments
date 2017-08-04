<?php
include "payware.php";

// PayWare service URL
$service_url = 'http://testing.brightware.com.sa/api/PayWare/SetCheckout';

// Payware request
$request = new PayWareRequest();
$request->api_user_name= 'test_user';
$request->api_secret = 'test_secret';
$request->merchant_id = '1343';
$request->merchant_token = 'test_secret';
$request->transaction_number = '11111141';
$request->alias_id = 'olp100645';
$request->success_url = 'test';
$request->failure_url = 'test';
$request->lang = 'EN';
$request->is_testing = true;
$request->amount = 10;

// Init PayWare client class
$client = new PayWare();

// Call init checkout process
$response = $client->init_checkout($service_url, $request);

// If response code is 200, it means success
if($response->response_code == 200){
    // Redirect to PayWare checkout page
    echo $response->response;    
} else {
    // Display error
    echo $response->response;
}
?>
