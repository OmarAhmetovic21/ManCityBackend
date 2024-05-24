<?php 
require_once 'databaseConnect.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: PUT");
//header("Access-Control-Allow-Headers: Authorization");
header("Content-Type: application/json; charset-UTF-8");

function updateFixtures($conn){
    if($_SERVER["REQUEST_METHOD"] == "OPTIONS"){
        http_response_code(200);
        exit;
    }

    if($_SERVER["REQUEST_METHOD"] !== "PUT"){
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

    if(isset($postdata) && !empty($postdata)){
        $request = json_decode($postdata);

        $requestUri = $_SERVER['REQUEST_URI'];
        $uriParts = explode('/', $requestUri);
        $id = end($uriParts);

        if (trim($request -> team1) === '' || trim($request -> team2) === '' || trim($request -> date) === '' || trim($request -> time) === ''){
            return http_response_code(400);
        }
        $team1 = mysqli_real_escape_string($conn, trim($request->team1));
        $team2 = mysqli_real_escape_string($conn, trim($request->team2));
        $date = mysqli_real_escape_string($conn, trim($request->date));
        $time = mysqli_real_escape_string($conn, trim($request->time));

        $sql = "update fixtures SET = Team1=$team1, Team2=$team2, Date=$date, Time=$time where id = $id";

        if (mysqli_query($conn,$sql)){
            http_response_code(201);
            $fixture = [
                'team1' => $team1,
                'team2' => $team2,
                'date' => $date,
                'time' => $time
            ];
            echo json_encode(['data'=>$fixture]);
        }
        else {
            http_response_code(400);
        }
    }

}

updateFixtures($conn);


?>