<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $delivery_id = $_POST['delivery_id'];
    $status = $_POST['status'];

    $query = $conn->prepare("UPDATE deliveries SET status = ? WHERE id = ?");
    $query->bind_param("si", $status, $delivery_id);

    if ($query->execute()) {
        echo "Status updated successfully!";
    } else {
        echo "Failed to update status.";
    }
}
?>
