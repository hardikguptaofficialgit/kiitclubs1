<?php
session_start();

// Check if the user is logged in, if not redirect to the login page
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

// Include database connection
$conn = new mysqli("localhost", "root", "", "club_registrations");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete contact message functionality
if (isset($_GET['delete_contact_id'])) {
    $contact_id = $_GET['delete_contact_id'];
    $delete_sql = "DELETE FROM contact_messages WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $contact_id);
    $stmt->execute();
    $stmt->close();
    header("Location: admin_panel.php"); // Redirect back to the admin panel
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin_styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .admin-panel-container {
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            overflow-x: auto; /* Added to enable horizontal scrolling on small screens */
            display: flex;
            flex-direction: column; /* Allows for stacking elements vertically */
        }
        .header {
            display: flex;
            justify-content: space-between; /* Aligns logout button to the right */
            align-items: center;
        }
        h1 {
            color: #333;
            margin: 0; /* Remove default margin */
        }
        .logout-btn {
            background-color: #f44336; /* Red */
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .logout-btn:hover {
            background-color: #d32f2f; /* Darker red */
        }
        .registration-table, .contact-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .registration-table th, .contact-table th, .registration-table td, .contact-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .registration-table th, .contact-table th {
            background-color: #4CAF50;
            color: white;
        }
        .edit-btn, .delete-btn {
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
        }
        .edit-btn {
            background-color: #2196F3; /* Blue */
        }
        .edit-btn:hover {
            background-color: #1976D2; /* Darker blue */
        }
        .delete-btn {
            background-color: #f44336; /* Red */
        }
        .delete-btn:hover {
            background-color: #d32f2f; /* Darker red */
        }
    </style>
</head>
<body>
    <div class="admin-panel-container">
        <div class="header">
            <h1>Admin Panel</h1>
            <form method="post">
                <button type="submit" name="logout" class="logout-btn">Logout</button>
            </form>
        </div>

        <h2>Registrations</h2>
        <table class="registration-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Roll Number</th>
                    <th>Club</th>
                    <th>Message</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM registrations";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['contact_number']}</td>
                                <td>{$row['roll_number']}</td>
                                <td>{$row['club']}</td>
                                <td>{$row['message']}</td>
                                <td>
                                    <a href='edit_entry.php?id={$row['id']}' class='edit-btn'>Edit</a>
                                    <a href='delete_entry.php?id={$row['id']}' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this entry?\")'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No registrations found</td></tr>";
                }
                ?>
                
            </tbody>
        </table>
        <br>
      ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
      <br>
        <h2>Contact Messages</h2>
      
        <table class="contact-table">
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
                $contact_sql = "SELECT * FROM contact_messages";
                $contact_result = $conn->query($contact_sql);
                
                if ($contact_result->num_rows > 0) {
                    while ($row = $contact_result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['roll_number']}</td>
                                <td>{$row['message']}</td>
                                <td>
                                    <a href='admin_panel.php?delete_contact_id={$row['id']}' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this message?\")'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No contact messages found</td></tr>";
                }
                
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
