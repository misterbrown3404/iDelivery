<?php
session_start();
include 'db_connect.php';

if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'user') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user_id = $_SESSION['user_id'];
        $pickup_location = $_POST['pickup_location'];
        $delivery_location = $_POST['delivery_location'];
        $product_description = $_POST['product_description'];
        $quantity = $_POST['quantity'];
        $status = 'waiting'; // Default status
        $payment_status = 'pending'; // Default payment status

        $query = $conn->prepare("INSERT INTO deliveries (user_id, pickup_location, delivery_location, product_description, quantity, status, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param("isssiss", $user_id, $pickup_location, $delivery_location, $product_description, $quantity, $status, $payment_status);

        if ($query->execute()) {
            echo "Delivery order placed!";
        } else {
            echo "Failed to place order";
        }
    }
} else {
    echo "Please login as a user to place orders";
}
?>
