<?php
session_start();
include 'db_connect.php';

if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'courier') {
    $courier_id = $_SESSION['user_id'];

    $query = $conn->prepare("SELECT * FROM deliveries WHERE courier_id = ?");
    $query->bind_param("i", $courier_id);
    $query->execute();
    $result = $query->get_result();

    echo "<h2>Courier Dashboard</h2>";
    while ($row = $result->fetch_assoc()) {
        echo "<div>
                <p>Delivery ID: {$row['id']}</p>
                <p>Pickup Location: {$row['pickup_location']}</p>
                <p>Delivery Location: {$row['delivery_location']}</p>
                <p>Status: {$row['status']}</p>
                <p><button onclick='updateStatus({$row['id']})'>Update Status</button></p>
              </div>";
    }
} else {
    echo "Please login as a courier to view this page.";
}

?>

<script>
function updateStatus(deliveryId) {
    var status = prompt("Enter new status (waiting, in_progress, delivered):");
    if (status != null) {
        $.ajax({
            url: 'update_status.php',
            type: 'POST',
            data: { delivery_id: deliveryId, status: status },
            success: function(response) {
                alert(response);
                location.reload(); // Reload the page to see the updated status
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
}
</script>
