
<?php
require_once 'databaseConnect.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Method: POST");
header("Access-Control-Allow-Headers: Authorization");
header("Content-Type: application/json; charset-UTF-8");
header("Access-Control-Allow-Headers: *");

function postFixtures($conn){
    if($_SERVER["REQUEST_METHOD"] == "OPTIONS"){
        http_response_code(200);
        exit;
    }

    if($_SERVER["REQUEST_METHOD"] !== "POST"){
        http_response_code(405);
        exit;
    }

    /*$jwt = null
    $headers = apache_request_headers();

    if (isset($headers['Authorization'])){
        $jwt = $headers['Authorization'];
        $token_parts = explode('.', $jwt);
        if (count($token_parts !=3)){
            http_response_code(401);
            exit;
        }

        $signature = hash_hmac('sha256', str_replace(['+', '/', '='], ['-', '_', ''], $token_parts[0]))
    }*/

    $sql = 'select * from highlights order by id desc';
    $result = mysqli_query($conn, $sql);

    if($result){
        header("Content-Type: JSON");
        $i = 0;
        $response = [];
        while($row = mysqli_fetch_assoc($result)){
            $response[$i]['id']=$row['id'];
            $response[$i]['Team1']=$row['Team1'];
            $response[$i]['Team2']=$row['Team2'];
            $response[$i]['Date']=$row['Date'];
            $response[$i]['Time']=$row['Time'];
            $i++;
        }

        echo json_encode($response, JSON_PRETTY_PRINT);
    }
}

postFixtures($conn);

?>