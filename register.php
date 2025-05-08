<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $location = $_POST['location'];
    $phone_number = $_POST['phone_number'];
    $role = 'user'; // Default to user role

    // Check if email is unique
    $check_email = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $result = $check_email->get_result();

    if ($result->num_rows > 0) {
        echo "Email already exists";
    } else {
        $query = $conn->prepare("INSERT INTO users (name, email, password, location, phone_number, role) VALUES (?, ?, ?, ?, ?, ?)");
        $query->bind_param("ssssss", $name, $email, $password, $location, $phone_number, $role);

        if ($query->execute()) {
            echo "Registration successful!";
        } else {
            echo "Registration failed!";
        }
    }
}
?>
