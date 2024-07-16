<?php


header('access-control-allow-origin:*');
header('Content-Type: application/json'); 
header('Access-Control-Allow-Methods: GET');
header('access-control-allow-headers: content-type, access-control-allow-headers,authorization, x-request-with');

include('function.php'); 

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "GET") {

    if(isset($_GET['id'])){
        $student = getstudent($_GET);
        echo $student;

    }else{
        $studentlist =  getstudentlist();
        echo $studentlist;
    }

   
} else {
    $data = [
        'message' => $requestMethod . ' method not allowed'
    ];

    echo json_encode($data);
   
}

?>