<?php
error_reporting(0);

header('Content-Type: application/json'); 
header('Access-Control-Allow-Methods: POST');

include('function.php'); 

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "POST") {
        $inputData = json_decode(file_get_contents("php://inputs"),true);
        

        if(empty($inputData)){
           $storestudent = storestudent($_POST);
}

    else{
        $storestudent= storestudent($inputData);
    }

    echo $storestudent;
}
else
{
    $data=[
        'message'=>$requestMethod. ' method not allowed'
    ];
    echo json_encode($data);

}


?>