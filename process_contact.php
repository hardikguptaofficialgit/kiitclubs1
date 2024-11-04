<?php
session_start(); // Start the session if you need to manage sessions

// Assuming the form method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the expected fields are set in the POST data
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $roll_number = isset($_POST['roll_number']) ? $_POST['roll_number'] : '';
    $message = isset($_POST['message']) ? $_POST['message'] : '';

    // Now you can safely use these variables
    // Example: Insert into the database
    $conn = new mysqli("localhost", "root", "", "club_registrations");
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, roll_number, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $roll_number, $message);
    
    if ($stmt->execute()) {
        $success_message = "Message sent successfully !";
    } else {
        $success_message = "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
} else {
    $success_message = "Invalid request method.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212; /* Dark background */
            color: #ffffff; /* Light text color */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .message-container {
            background-color: #1e1e1e; /* Darker box for message */
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            width: 90%; /* Responsive width */
            max-width: 400px; /* Maximum width */
            text-align: center;
        }

        .success-message {
            color: #76ff03; /* Light green for success */
            font-size: 20px; /* Larger font size */
            margin-bottom: 20px;
        }

        .error-message {
            color: #f44336; /* Red for error */
            font-size: 20px; /* Larger font size */
            margin-bottom: 20px;
        }

        .redirect-message {
            font-size: 18px;
            color: #cccccc; /* Lighter gray */
        }
    </style>
</head>
<body>
    <div class="message-container">
        <?php if (isset($success_message)): ?>
            <div class="success-message">
                <?php echo htmlspecialchars($success_message); ?>
            </div>
        <?php endif; ?>

        <div class="redirect-message">
            You will be redirected in <span id="countdown">5</span> seconds...
        </div>
    </div>

    <script>
        // Redirect after 5 seconds
        setTimeout(function() {
            window.location.href = "contact.html";
        }, 5000);

        // Countdown
        let countdownElement = document.getElementById("countdown");
        let countdown = 5;
        const countdownInterval = setInterval(function() {
            countdown--;
            countdownElement.textContent = countdown;
            if (countdown <= 0) {
                clearInterval(countdownInterval);
            }
        }, 1000);
    </script>
</body>
</html>
