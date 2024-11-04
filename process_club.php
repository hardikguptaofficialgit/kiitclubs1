<?php
session_start();

// Assuming the form method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $roll_number = $_POST['roll_number'];
    $message = $_POST['message'];

    // Database connection
    $conn = new mysqli("localhost", "root", "", "club_registrations");
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO club_inquiries (name, email, roll_number, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $roll_number, $message);
    
    if ($stmt->execute()) {
        // Show a success message before redirecting
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Success</title>
            <style>
                body {
                    background-color: #121212; /* Dark background */
                    color: #ffffff; /* White text color */
                    font-family: Arial, sans-serif;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                }

                .success-message {
                    background-color: #1e1e1e; /* Darker container for the message */
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
                    text-align: center;
                    font-size: 20px;
                }

                .success-message a {
                    color: #4caf50; /* Green color for the link */
                    text-decoration: none;
                    font-weight: bold;
                }

                .success-message a:hover {
                    text-decoration: underline;
                }
            </style>
        </head>
        <body>
            <div class="success-message">
                Message sent successfully! You will be redirected.
            </div>
        </body>
        </html>';
        
        header("refresh:3; url=club.html"); // Redirect back to the contact page after 3 seconds
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
