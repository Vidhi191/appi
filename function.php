<?php
require_once 'dbconfig.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

function error($message){
    $data=[
        'message'=>$message
    ];
    echo json_encode($data);
    exit();
}

function getstudentlist() {
    global $conn;

    $query = "SELECT * FROM student";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
            $data = [
                'message' => 'student list fetched successfully',
                'data' => $res
            ];
        } else {
            $data = [
                'message' => 'no student found'
            ];
        }
    } else {
        $data = [
            'message' => 'internal error',
        ];
       
    }
    return json_encode($data);
   
}

// create api for fetch single api from database

function getstudent($studentParams){

    global $conn;

    if($studentParams['id']==null){
        return error('enter your student id');
    }
   
    $studentid = mysqli_real_escape_string($conn, $studentParams['id']);

    $query = "SELECT * FROM student where id='$studentid' LIMIT 1";
    $result = mysqli_query($conn,$query);

    if($result){
        if(mysqli_num_rows($result)==1){
            $res = mysqli_fetch_assoc($result);

            $data = [
                'message' => 'student fetched successfully',
                'data' =>  $res
            ];
            return json_encode($data);


        }
        else{
            $data = [
                'message' => 'not found student',
            ];
            return json_encode($data);

        }

    }
    else{
        $data = [
            'message' => 'internal error',
        ];
        return json_encode($data);

    }



}//create api for insert data in database

function storestudent($studentinput){
    global $conn;

    $name = mysqli_real_escape_string($conn,$studentinput['name']);
    $password = mysqli_real_escape_string($conn,$studentinput['password']);
    $email = mysqli_real_escape_string($conn,$studentinput['email']);

        $query ="INSERT INTO student (name,email,password) values ('$name','$email','$password')";
        $result= mysqli_query($conn,$query);


        if($result){
            $data = [
                'message' => 'student created'
            ];
            return json_encode($data); 

        }
        else{
            $data = [
                'message' => 'internal error'
            ];
            return json_encode($data); 
        }
    }



    function updatestudent($studentInput , $userParams){
        global $conn;
    
        if(!isset($userParams['id'])){
    
            return error('student id is not found');
    
        }else{
    
            return error('enter the student id');
    
        }
    
        $id = mysqli_real_escape_string($conn,$userParams['id']);
    
        $name = mysqli_real_escape_string($conn,$studentInput['name']);
        $password = mysqli_real_escape_string($conn,$studentInput['password']);
        $email = mysqli_real_escape_string($conn,$studentInput['email']);
    
            $query ="UPDATE student SET name='$name',password='$password',email='$email' where id='$id'";
            $result= mysqli_query($conn,$query);
    
    
            if($result){
                $data = [
                    'message' => 'student updated'
                ];
                return json_encode($data); 
    
            }
            else{
                $data = [
                    'message' => 'internal error'
                ];
                return json_encode($data); 
            }
        }


        function deletestudent($studentParams) {
            global $conn;
            if(!isset($studentParams['id'])){
    
                return error('student id is not found');
        
            }else{
        
                return error('enter the student id');
        
            }
           
            
            $studentid = mysqli_real_escape_string($conn, $studentParams['id']);

            $query = "DELETE * FROM student where id='$studentid' ";
            $result = mysqli_query($conn,$query);

            if($result){
                $data = [
                    'message' => 'student DELETE'
                ];
                return json_encode($data); 
    
            }
            else{
                $data = [
                    'message' => 'internal error'
                ];
                return json_encode($data); 
            }
        }
            ?>