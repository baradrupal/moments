<?php
class PayWare{
    function init_checkout($service_url, $request){
        $service_url = 'http://localhost:19699/api/PayWare/SetCheckout';
        $data = json_encode($request);
        $curl = curl_init($service_url);
        $headers = array(
              'Content-Type: application/json',
        	  'Content-Length: '. strlen($data));
        
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, $service_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        
        $curl_response = curl_exec($curl);
        $http_status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            die('error occured during curl exec. Additioanl info: ' . var_export($info));
        }
        curl_close($curl);
        $decoded = json_decode($curl_response);
        
        // If status is not 200 (OK), throw error and kill process
        if ($http_status_code != 200) {
            die($curl_response);
        }
        
        $response = new PayWareResponse();
        $response->response_code = $http_status_code;
        $response->response = $decoded;
        
        return $response;
    }
}

class PayWareRequest{
    var $api_user_name;
    var $api_secret;
    var $merchant_id;
    var $merchant_token;
    var $transaction_number;
    var $alias_id;
    var $success_url;
    var $failure_url;
    var $lang;
    var $is_testing;
    var $amount;
}

class PayWareResponse{
    var $response_code;
    var $response;
}
?>
