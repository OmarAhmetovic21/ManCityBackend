<?php 
require_once 'databaseConnect.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: *");
//header("Access-Control-Allow-Headers: Authorization");

function deleteFixtures($conn){
    if($_SERVER["REQUEST_METHOD"] == "OPTIONS"){
        http_response_code(200);
        exit;
    }

    if($_SERVER["REQUEST_METHOD"] !== "DELETE"){
        http_response_code(405);
        exit;
    }

     /*$jwt = null;
    $headers = apache_request_headers();

    if (isset($headers['Authorization'])){
        $jwt = $headers['Authorization'];
        $token_parts = explode('.', $jwt);
        if (count($token_parts !=3)){
            http_response_code(401);
            exit;
        }

        
        $signature = hash_hmac('sha256', str_replace(['+', '/', '='], ['-', '_', ''], $token_parts[0]), ".", $token_parts[1], "." ,$token_parts[2]);
        $sig = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        if($sig !== $token_parts[2]){
            http_response_code(401);
            exit;
        }

    }else {
        http_response_code(401);
        exit;
    }*/

    $requestUri = $_SERVER['REQUEST_URI'];
    $uriParts = explode('/', $requestUri);
    $id = end($uriParts);

    $sql = "delete from fixtures where id = $id";

    if(mysqli_query($conn, $sql))
    {
        http_response_code(201);
    }
    else 
    {
        http_response_code(404);
    }
}

deleteFixtures($conn);

?>