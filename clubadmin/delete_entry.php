<?php
session_start();
$conn = new mysqli("localhost", "root", "", "club_registrations");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'] ?? 0;

if ($id) {
    $stmt = $conn->prepare("DELETE FROM club_inquiries WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    $stmt->execute(); // Execute the delete statement
    $stmt->close(); // Close the statement
}

// Close the database connection
$conn->close();

// Redirect back to the admin panel without any message
header("Location: admin_panel.php");
exit; // Ensure no further code is executed after the redirect
?>
