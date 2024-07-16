<?php


header('access-control-allow-origin:*');
header('Content-Type: application/json'); 
header('Access-Control-Allow-Methods: DELETE');
header('access-control-allow-headers: content-type, access-control-allow-headers,authorization, x-request-with');

include('function.php'); 

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "DELETE") {

   
        $deletestudent =  deletestudent($_GET);
        echo $deletestudent;
    }

   
else {
    $data = [
        'status' =>405,
        'message' => $requestMethod . ' method not allowed'
    ];

    echo json_encode($data);
   
}

?>