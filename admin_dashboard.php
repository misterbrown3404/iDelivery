<?php
session_start();
include 'db_connect.php';

if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin') {
    echo "<h2>Admin Dashboard</h2>";

    // View all deliveries
    $deliveries = $conn->query("SELECT * FROM deliveries");
    echo "<h3>All Deliveries</h3>";
    while ($row = $deliveries->fetch_assoc()) {
        echo "<div>
                <p>Delivery ID: {$row['id']}</p>
                <p>User ID: {$row['user_id']}</p>
                <p>Courier ID: {$row['courier_id']}</p>
                <p>Status: {$row['status']}</p>
              </div>";
    }

    // View all users
    $users = $conn->query("SELECT * FROM users WHERE role = 'user'");
    echo "<h3>All Users</h3>";
    while ($user = $users->fetch_assoc()) {
        echo "<div>
                <p>User ID: {$user['id']}</p>
              
                <p>Email: {$user['email']}</p>
              </div>";
    }

    // View all couriers
    $couriers = $conn->query("SELECT * FROM users WHERE role = 'courier'");
    echo "<h3>All Couriers</h3>";
    while ($courier = $couriers->fetch_assoc()) {
        echo "<div>
                <p>Courier ID: {$courier['id']}</p>
               
                <p>Email: {$courier['email']}</p>
              </div>";
    }

} else {
    echo "Please login as an admin to view this page.";
}
?>
