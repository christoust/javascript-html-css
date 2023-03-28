<?php

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Get the form data
    $name = $_POST['name'];
    $id = $_POST['id'];
    $location = $_POST['location'];
    $address = $_POST['address'];
    $blood_group = $_POST['blood_group'];
    $experience = $_POST['experience'];
    $skills = $_POST['skills'];

    // Insert the data into a database
    $host = 'localhost';
    $username = 'root';
    $password = 'pass@word1';
    $database = 'db';

    $conn = mysqli_connect($host, $username, $password, $database);

    // Check for errors
    if (mysqli_connect_errno()) {
        $response = [
            'success' => false,
            'message' => 'Failed to connect to MySQL: ' . mysqli_connect_error()
        ];

        echo json_encode($response);
        exit();
    }

    $sql = "INSERT INTO employees (name, id, location, address, blood_group, experience, skills) VALUES ('$name', '$id', '$location', '$address', '$blood_group', '$experience', '$skills')";

    if (mysqli_query($conn, $sql)) {
        $response = [
            'success' => true,
            'message' => 'Employee added successfully'
        ];

        echo json_encode($response);
    } else {
        $response = [
            'success' => false,
            'message' => 'Error: ' . mysqli_error($conn)
        ];

        echo json_encode($response);
    }

    mysqli_close($conn);

} else {
    // If the form was not submitted, return an error message
    $response = [
        'success' => false,
        'message' => 'Error: Method Not Allowed'
    ];

    echo json_encode($response);
}

?>
