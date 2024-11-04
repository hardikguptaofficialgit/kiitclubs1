<?php
// Database configuration
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "club_registrations"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO registrations (name, email, contact_number, roll_number, club, message) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $name, $email, $contact_number, $roll_number, $club, $message);

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$contact_number = $_POST['contact_number'];
$roll_number = $_POST['roll_number'];
$club = $_POST['club'];
$message = $_POST['message'];

// Execute the statement
if ($stmt->execute()) {
    // Success message with dark mode styling
    echo '<div style="
            background-color: #333;
            color: #fff;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin: 20px auto;
            width: 80%;
            max-width: 500px;
            font-family: Arial, sans-serif;
          ">
            <h2>Registration Successful!</h2>
            <p>You will be notified shortly about your club registration.</p>
            <p>You will be redirected in <span id="countdown">5</span> seconds...</p>
          </div>
          <script>
            // Redirect after 5 seconds
            let countdown = 5;
            const countdownElement = document.getElementById("countdown");
            const interval = setInterval(function() {
                countdown--;
                countdownElement.textContent = countdown;
                if (countdown <= 0) {
                    clearInterval(interval);
                    window.location.href = "register.html"; // Redirect to register.html
                }
            }, 1000);
          </script>';
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
