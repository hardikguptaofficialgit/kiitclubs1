<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit();
}

require 'db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM registrations WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact_number = $_POST['contact_number'];
    $roll_number = $_POST['roll_number'];
    $club = $_POST['club'];
    $message = $_POST['message'];

    $updateQuery = "UPDATE registrations SET name=?, email=?, contact_number=?, roll_number=?, club=?, message=? WHERE id=?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssssssi", $name, $email, $contact_number, $roll_number, $club, $message, $id);

    if ($stmt->execute()) {
        header("Location: admin_panel.php");
        exit();
    } else {
        echo "Error updating record.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Entry</title>
    
    <style>
        /* Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

/* Body styling */
body {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    background: linear-gradient(135deg, #4a90e2, #145d9c);
}

/* Container styling */
.edit-container {
    width: 90%;
    max-width: 600px;
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    text-align: center;
}

.edit-container h2 {
    font-size: 24px;
    color: #333;
    margin-bottom: 20px;
}

/* Form styling */
.form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 15px;
    text-align: left;
}

.form-group label {
    font-weight: bold;
    color: #333;
    margin-bottom: 5px;
}

.form-group input,
.form-group textarea {
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 5px;
    width: 100%;
}

.form-group textarea {
    resize: vertical;
    min-height: 80px;
}

/* Button styling */
.edit-btn {
    display: inline-block;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    padding: 12px 24px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 10px;
}

.edit-btn:hover {
    background-color: #388E3C;
}

        </style>
</head>
<body>
    <div class="edit-container">
        <h2>Edit Registration Details</h2>
        <form action="edit_entry.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($data['name']); ?>" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($data['email']); ?>" required>
            </div>
            <div class="form-group">
                <label>Contact Number:</label>
                <input type="text" name="contact_number" value="<?php echo htmlspecialchars($data['contact_number']); ?>" required>
            </div>
            <div class="form-group">
                <label>Roll Number:</label>
                <input type="text" name="roll_number" value="<?php echo htmlspecialchars($data['roll_number']); ?>">
            </div>
            <div class="form-group">
                <label>Club:</label>
                <input type="text" name="club" value="<?php echo htmlspecialchars($data['club']); ?>" required>
            </div>
            <div class="form-group">
                <label>Message:</label>
                <textarea name="message"><?php echo htmlspecialchars($data['message']); ?></textarea>
            </div>
            <button type="submit" class="edit-btn">Update</button>
        </form>
    </div>
</body>
</html>
