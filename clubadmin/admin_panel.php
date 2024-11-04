<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

// Include the logout functionality
if (isset($_POST['logout'])) {
    session_destroy(); // Destroy the session
    header("Location: admin_login.php"); // Redirect to login page
    exit;
}

// Database connection
$conn = new mysqli("localhost", "root", "", "club_registrations");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM club_inquiries";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club Admin Panel</title>
    <link rel="stylesheet" href="admin_styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9; /* Light background color */
            color: #333; /* Dark text color for readability */
            margin: 0;
            padding: 20px;
        }

        .admin-panel-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff; /* White background for the panel */
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-bottom: 20px;
            color: #333; /* Darker color for the title */
        }

        .logout-btn {
            background-color: #ff4757; /* Red color for logout button */
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            float: right; /* Align logout button to the right */
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #ff6b81; /* Lighter red on hover */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dddddd; /* Light gray border */
        }

        th {
            background-color: #f2f2f2; /* Light gray header */
            color: #333; /* Dark text for header */
        }

        tr:hover {
            background-color: #f1f1f1; /* Highlight on row hover */
        }

        .delete-btn {
            background-color: #ff4757; /* Red background for delete button */
            color: white; /* White text color */
            padding: 8px 12px; /* Padding for better click area */
            border: none; /* No border */
            border-radius: 4px; /* Rounded corners */
            text-decoration: none; /* No underline */
            font-weight: bold; /* Bold text */
            transition: background-color 0.3s; /* Smooth transition */
        }

        .delete-btn:hover {
            background-color: #ff6b81; /* Lighter red on hover */
        }
    </style>
</head>
<body>
    <div class="admin-panel-container">
        <h1>Club Inquiries</h1>
        
        <form method="post">
            <button type="submit" name="logout" class="logout-btn">Logout</button>
        </form>
        
        <table class="registration-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roll Number</th>
                    <th>Message</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['roll_number']}</td>
                                <td>{$row['message']}</td>
                                <td>
                                    <a href='delete_entry.php?id={$row['id']}' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this inquiry?\")'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No inquiries found</td></tr>";
                }
                
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
