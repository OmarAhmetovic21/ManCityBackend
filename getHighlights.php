<?php
require_once 'databaseConnect.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Method: GET");
header("Content-Type: application/json; charset-UTF-8");

function getHighlights($conn){
    if($_SERVER["REQUEST_METHOD"] == "OPTIONS"){
        http_response_code(200);
        exit;
    }

    if($_SERVER["REQUEST_METHOD"] !== "GET"){
        http_response_code(405);
        exit;
    }

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

getHighlights($conn);

?>