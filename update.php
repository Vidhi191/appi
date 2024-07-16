<?php


header('access-control-allow-origin:*');
header('Content-Type: application/json'); 
header('Access-Control-Allow-Methods: PUT');
header('access-control-allow-headers: content-type, access-control-allow-headers,authorization, x-request-with');






if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    // Parse the input data
    parse_str(file_get_contents("php://input"), $put_vars);

    // Validate input
    if (!isset($put_vars['id']) || !isset($put_vars['name']) || !isset($put_vars['email']) || !isset($put_vars['password'])) {
        echo json_encode(array("message" => "Missing required parameters."));
        exit();
    }

    $id = $conn->real_escape_string($put_vars['id']);
    $name = $conn->real_escape_string($put_vars['name']);
    $email = $conn->real_escape_string($put_vars['email']);
    $password = $conn->real_escape_string($put_vars['password']);

    // Update user in the database
    $sql = "UPDATE student SET name='$name', email='$email', password='$password' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "student updated successfully."));
    } else {
        echo json_encode(array("message" => "Error updating user: " . $conn->error));
    }
} else {
    echo json_encode(array("message" => "Invalid request method."));
}

?>